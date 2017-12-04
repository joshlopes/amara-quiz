<?php

namespace LuisLopes\AmaraQuiz\Quiz;

class Question
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var Option[]
     */
    public $options;

    public function __construct(string $title, array $options)
    {
        $this->title = $title;
        $this->options = $options;
    }

    public function getCorrectOption(): Option
    {
        foreach ($this->options as $option) {
            if ($option->isCorrect) {
                return $option;
            }
        }

        return null;
    }

    public function toArray(): array
    {
        $options = [];
        $randomedOptions = $this->options;
        shuffle($randomedOptions);
        foreach ($randomedOptions as $option)
        {
            $options[] = $option->toArray();
        }

        return [
            'title' => $this->title,
            'options' => $options,
        ];
    }
}
