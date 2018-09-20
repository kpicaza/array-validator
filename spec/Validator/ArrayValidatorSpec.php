<?php

namespace spec\Validator;

use Validator\ArrayValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayValidatorSpec extends ObjectBehavior
{
    const VALUES_1 = [

    ];
    const RULES_1 = [
        'user_id' => 'notEmpty',
        'email' => 'notEmpty|email',
        'name' => 'notEmpty|string|greaterThan:3|lessThan:120',
        'description' => 'notEmpty|greaterThan:40'
    ];

    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayValidator::class);
    }
}
