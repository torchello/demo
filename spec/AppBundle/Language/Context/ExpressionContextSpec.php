<?php

namespace spec\AppBundle\Language\Context;

use AppBundle\Language\Context\ExpressionContext;
use Dark\DissectBundle\Context\ContextInterface;
use Dissect\Lexer\CommonToken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExpressionContextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ExpressionContext::class);
        $this->shouldHaveType(ContextInterface::class);
    }

    function it_evaluates_expression_in_brackets(CommonToken $left, CommonToken $right)
    {
        $this->evaluate($left, 'abc', $right)->shouldBe('(abc)');
    }

    function it_evaluates_conjunction()
    {
        $and = new CommonToken('conjunction', ExpressionContext::AND, 1);
        $or = new CommonToken('conjunction', ExpressionContext::OR, 1);

        $this->evaluateConjunction('TRUE', $and, 'FALSE')->shouldBe('TRUE AND FALSE');
        $this->evaluateConjunction('TRUE', $or, 'FALSE')->shouldBe('TRUE OR FALSE');
    }

    function it_evaluates_operation()
    {
        $left = new CommonToken('attribute', 'Country', 1);
        $right = new CommonToken('valoue', '"Russia"', 1);
        $isEqual = new CommonToken('operation', ExpressionContext::IS_EQUAL, 1);
        $isNotEqual = new CommonToken('operation', ExpressionContext::IS_NOT_EQUAL, 1);

        $this->evaluateOperation($left, $isEqual, $right)->shouldBe('Country = "Russia"');
        $this->evaluateOperation($left, $isNotEqual, $right)->shouldBe('Country <> "Russia"');
    }
}
