<?php

namespace AppBundle\Language\Context;

use AppBundle\Entity\UserInfo;
use Dark\DissectBundle\Context\ContextInterface;
use Dissect\Lexer\CommonToken;

class ExpressionContext implements ContextInterface
{
    const AND = 'AND';
    const OR = 'OR';

    const IS_EQUAL = '=';
    const IS_NOT_EQUAL = '!=';

    const ATTRIBUTE_ID = 'ID';
    const ATTRIBUTE_COUNTRY = 'Country';
    const ATTRIBUTE_STATE = 'State';
    const ATTRIBUTE_EMAIL = 'Email';

    /** @var string */
    protected $lastItem;
    /** @var array */
    private $params = [];
    /** @var int */
    private $counter = 1;

    public function evaluate(CommonToken $left, $expression, CommonToken $right)
    {
        return sprintf('(%s)', $expression);
    }

    /**
     * @param CommonToken|mixed $left
     * @param CommonToken $conjunction
     * @param CommonToken|mixed $right
     * @return string
     */
    public function evaluateConjunction($left, CommonToken $conjunction, $right): string
    {
        $left = $left instanceof CommonToken ? $left->getValue() : $left;
        $right = $right instanceof CommonToken ? $right->getValue() : $right;

        switch ($conjunction->getValue()) {
            case self::AND:
                return sprintf('%s AND %s', $left, $right);
            case self::OR:
                return sprintf('%s OR %s', $left, $right);
        }
    }

    /**
     * @param CommonToken|mixed $left
     * @param CommonToken $operation
     * @param CommonToken|mixed $right
     * @return string
     * @throws \Exception
     */
    public function evaluateOperation($left, CommonToken $operation, $right): string
    {
        $left = $left instanceof CommonToken ? $left->getValue() : $left;
        $right = $right instanceof CommonToken ? $right->getValue() : $right;

        switch ($operation->getValue()) {
            case self::IS_EQUAL:
                $result = sprintf('%s = %s', $left, $right);
                break;
            case self::IS_NOT_EQUAL:
                $result = sprintf('%s <> %s', $left, $right);
                break;
            default:
                throw new \Exception('Unknown operation token: "'. $operation->getValue().'""');
        }

        return $result;
    }

    /**
     * @param CommonToken $value
     * @return string
     */
    public function prepareValue(CommonToken $value): string
    {
        $this->params[] = trim($value instanceof CommonToken ? $value->getValue() : $value, '"');

        return '?';
    }

    /**
     * @param CommonToken $attribute
     * @return string
     * @throws \Exception
     */
    public function prepareAttribute(CommonToken $attribute): string
    {
        switch ($attribute->getValue()) {
            case self::ATTRIBUTE_ID:
                return 'data.id';
            case self::ATTRIBUTE_COUNTRY:
                return 'data.country';
            case self::ATTRIBUTE_STATE:
                return 'data.state';
            case self::ATTRIBUTE_EMAIL:
                return 'data.email';
        }

        throw new \Exception('Unknown attribute token: "'. $attribute->getValue().'""');
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getName() : string
    {
        return 'expression_context';
    }
}
