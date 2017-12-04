<?php

namespace LuisLopes\AmaraQuiz\Quiz;

class Answer
{

    public $answer;

    public function __construct(bool $answer)
    {
        $this->answer = $answer;
    }

}
