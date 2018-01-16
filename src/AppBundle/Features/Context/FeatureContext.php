<?php

namespace AppBundle\Features\Context;

use AppBundle\Language\Context\ExpressionContext;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Dark\DissectBundle\Builder\Language;
use Dissect\Lexer\CommonToken;
use Behat\MinkExtension\Context\MinkContext;

class FeatureContext extends MinkContext
{
    use KernelDictionary;

    /** @var Language */
    protected $parser;
    /** @var ExpressionContext */
    protected $sprintContext;
    /** @var string|bool */
    private $lastResult;
    /** @var ExpressionContext */
    private $expressionContext;

    public function __construct(Language $parser, ExpressionContext $expressionContext)
    {
        $this->parser = $parser;
        $this->expressionContext = $expressionContext;
    }

    /**
     * @Given /^I parse '([^']*)'$/
     */
    public function iParse(string $expression)
    {
        $result = $this->parser->read($expression);
        $this->lastResult = $result instanceof CommonToken ? $result->getValue() : $result;
    }

    /**
     * @Then /^it should be "([^"]*)"$/
     */
    public function itShouldBe(string $value)
    {
        \PHPUnit_Framework_Assert::assertEquals($value, $this->lastResult);
    }

    /**
     * @Then /^it should be false$/
     */
    public function itShouldBeFalse()
    {
        \PHPUnit_Framework_Assert::assertFalse($this->lastResult);
    }

    /**
     * @Then /^it should be true$/
     */
    public function itShouldBeTrue()
    {
        \PHPUnit_Framework_Assert::assertTrue($this->lastResult);
    }

    /**
     * @Given /^parameters should be:$/
     */
    public function parametersShouldBe(TableNode $table)
    {
        $params = $this->expressionContext->getParams();

        foreach ($table->getTable() as $value) {
            \PHPUnit_Framework_Assert::assertSame($value[0], array_shift($params));
        }
    }

    /**
     * @Given /^I apply filter \'([^\']*)\'$/
     */
    public function iApplyFilter($filter)
    {
        $this->visit('/?filter='.urlencode($filter));
    }
}
