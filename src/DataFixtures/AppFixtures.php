<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        QuestionFactory::createMany(20);

        QuestionFactory::new()
            ->unpublished()
            ->many(5)
            ->create()
        ;

        $answer = new Answer();
        $answer->setContent('This question is the best one! I wish I knew the asnwer to it.');
        $answer->setUsername('jorgesquared');

        $question = new Question();
        $question->setName('How to gain knowledge and experience in an instant?');
        $question->setQuestion('...I should have not done this...');

        $answer->setQuestion($question);

        $manager->persist($answer);
        $manager->persist($question);

        $manager->flush();
    }
}
