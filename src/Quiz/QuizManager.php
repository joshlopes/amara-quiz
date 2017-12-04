<?php

namespace LuisLopes\AmaraQuiz\Quiz;

use Symfony\Component\Yaml\Yaml;

class QuizManager
{
    /**
     * @var array
     */
    private $questions;

    public function __construct(string $file)
    {
        $this->questions = Yaml::parseFile($file);
    }

    public function createGame($questions = 10): Game
    {
        $game = new Game();
        $randomQuestions = $this->questions;
        shuffle($randomQuestions);
        $numQuestions = 0;
        foreach ($randomQuestions as $question) {
            $options = [];
            $isCorrect = true;
            foreach ($question['options'] as $option) {
                $options[] = new Option($option, $isCorrect);
                $isCorrect = false;
            }

            $game->addQuestion(new Question($question['title'], $options));
            $numQuestions++;
            if ($numQuestions >= $questions) {
                break;
            }
        }

        return $game;
    }

}
