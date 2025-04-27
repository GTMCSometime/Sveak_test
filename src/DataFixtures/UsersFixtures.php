<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Services\CalculateScoreService;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ["Александр", "Ирина", "Сергей", "Варвара", "Олег",
         "Наталья", "Михаил", "Святослав", "Инна", "Виктория", "Николай"];
        $surnames = ["Иванов", "Юрьевна", "Сергеев", "Александровна", "Меньшиков",
         "Вихарькова", "Анатольевич", "Тверской", "Сдобина", "Швец", "Давыдов"];
        $domain = ['yandex', 'gmail', 'mail', 'somemail'];
        $postfix = ['ru', 'com', 'example']; 
        $education = ['higher', 'special', 'secondary'];
        $agree = [true, false];
         for($i = 0; $i < 11; $i++) {
            $user = new User();
            $user->setName($names[$i]);
            $user->setSurname($surnames[$i]);
            $user->setPhoneNumber('9' . random_int(100000000, 999999999));
            $user->setEmail('test' . $i . '@' . $domain[rand(0, 3)] . '.' . $postfix[rand(0, 2)]);
            $user->setEducation($education[rand(0,2)]);
            $user->setAgreeTerms($agree[rand(0,1)]);
            $score = new CalculateScoreService()->calculate($user);
            $user->setScore($score);
            $manager->persist($user);

        $manager->flush();
    }
}
}
