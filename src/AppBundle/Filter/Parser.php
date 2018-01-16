<?php

namespace AppBundle\Filter;

use AppBundle\Language\Context\ExpressionContext;
use Dark\DissectBundle\Builder\Language;

class Parser
{
    /** @var Language */
    private $languageParser;
    /** @var ExpressionContext */
    private $expressionContext;

    public function __construct(Language $languageParser, ExpressionContext $expressionContext)
    {
        $this->languageParser = $languageParser;
        $this->expressionContext = $expressionContext;
    }

    public function parse(string $filter): QueryFilter
    {
        return new QueryFilter(
            $this->languageParser->read($filter),
            $this->expressionContext->getParams()
        );
    }
}
