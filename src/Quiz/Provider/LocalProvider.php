<?php

namespace LuisLopes\AmaraQuiz\Quiz\Provider;

use LuisLopes\AmaraQuiz\Quiz\Game;
use LuisLopes\AmaraQuiz\Quiz\Option;
use LuisLopes\AmaraQuiz\Quiz\Question;
use Symfony\Component\Yaml\Yaml;

class LocalProvider implements QuizProviderInterface
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
            shuffle($options);
            $game->addQuestion(new Question($question['title'], $options));
            $numQuestions++;
            if ($numQuestions >= $questions) {
                break;
            }
        }

        return $game;
    }
}
