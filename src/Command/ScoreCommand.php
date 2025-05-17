<?php

namespace App\Command;


use App\Repository\UserRepository;
use App\Services\CalculateTotalScoreService;
use App\Services\ScoreDetailsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:score',
    description: "Calculate the scoring! Find out the total score, or specific client by ID",
)]
class ScoreCommand extends Command
{
    public function __construct(
    private UserRepository $userRepository,
    private CalculateTotalScoreService $calculateScoreService,
    private ScoreDetailsService $scoreDetailsService,
    private EntityManagerInterface $em,
    ){

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('userID', null, InputOption::VALUE_OPTIONAL, 'userID,
         by recount score');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getOption('userID');

        if ($userId) {
            $user = $this->userRepository->find($userId);

            if (!$user) {
                $output->writeln("<error>User with ID $userId not found.</error>");
                return Command::FAILURE;
            }

            $score = $this->calculateScoreService->calculate($user);
            $details = $this->scoreDetailsService->scoreDetails($user);
            $user->setScore($score);
            $this->em->flush();

            $io->note(sprintf("Score for %s with ID %d: %s...", $user->getName(),
             $userId, $score));
            $this->showDetails($io, $details);
        } else {

            $users = $this->userRepository->findAll();
            $totalUsersScore = 0;
            $personalScore = 0;
            foreach ($users as $user) {
                $personalScore = $this->calculateScoreService->calculate($user);
                $user->setScore($personalScore);
                $totalUsersScore += $this->calculateScoreService->calculate($user);    
            }
            $this->em->flush();
            $io->note(sprintf("Total score recount. Now its: %s",  $totalUsersScore));
        }

        return Command::SUCCESS;
    }

    private function showDetails(SymfonyStyle $io, array $data): void {
        $io->section("Scoring details:");
        $rows = [
            ['Operator', $data['phoneNumber']],
            ['Email', $data['email']],
            ['Education', $data['education']],
            ['Agree', $data['agree']],
            ['Total Score', $data['score']], 
        ];
        $io->table(
            ['property', 'score'],
            $rows,
        );
    }
}