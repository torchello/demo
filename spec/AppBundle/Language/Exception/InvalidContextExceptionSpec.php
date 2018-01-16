<?php

namespace spec\AppBundle\Language\Exception;

use AppBundle\Language\Exception\InvalidContextException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InvalidContextExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InvalidContextException::class);
    }
}
