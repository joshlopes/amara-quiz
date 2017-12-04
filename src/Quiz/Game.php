<?php

namespace LuisLopes\AmaraQuiz\Quiz;

class Game
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Question[]
     */
    private $questions;

    public function __construct()
    {
        $this->id = random_int(1, 1000000);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;
    }

    public function toArray(): array
    {
        $game = ['id' => $this->id];
        foreach ($this->questions as $question) {
            $game['questions'][] = $question->toArray();
        }

        return $game;
    }
}
