<?php

namespace AppBundle\Filter;

class QueryFilter
{
    /** @var string */
    private $condition;
    /** @var array */
    private $params;

    public function __construct(string $condition, array $params)
    {
        $this->condition = $condition;
        $this->params = $params;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
