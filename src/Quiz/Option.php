<?php

namespace LuisLopes\AmaraQuiz\Quiz;

class Option
{

    public $text, $isCorrect;

    public function __construct(string $text, bool $isCorrect = false)
    {
        $this->text = $text;
        $this->isCorrect = $isCorrect;
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'isCorrect' => $this->isCorrect,
        ];
    }

}
