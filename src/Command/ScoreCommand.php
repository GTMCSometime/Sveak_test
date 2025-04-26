<?php

namespace App\Command;


use App\Repository\UserRepository;
use App\Services\TotalScoreService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:score',
    description: 'Calculate the scoring! Without arguments shows overall scoring',
)]
class ScoreCommand extends Command
{
    public function __construct(private UserRepository $userRepository,
    private TotalScoreService $totalScore)
    {

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('user_id', null, InputOption::VALUE_OPTIONAL, 'Find out the scoring of a user by Id');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getOption('user_id');

        if ($userId) {
            $user = $this->userRepository->find($userId);

            if (!$user) {
                $output->writeln("<error>User with ID $userId not found.</error>");
                return Command::FAILURE;
            }

            $score = $user->getUserScore()->getScore();

            $io->note(sprintf("Score to %s witch id $userId: %s", $user->getName(), $score));
        } else {

            $io->note(sprintf("Sum: %s", $this->totalScore->getTotalScore()));
        }

        return Command::SUCCESS;
    }
}