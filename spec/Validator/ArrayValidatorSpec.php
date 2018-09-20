<?php

namespace spec\Validator;

use Validator\ArrayValidator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayValidatorSpec extends ObjectBehavior
{
    const VALID_VALUES_1 = [
        'user_id' => 'SomeId',
        'email' => 'example@example.com',
        'name' => 'Mr Potato',
        'descriptioarn' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
    ];

    const INVALID_VALUES_1 = [
        'user_id' => '',
        'email' => 'example@example.com',
        'name' => 'Mr Potato',
        'descriptioarn' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
    ];

    const INVALID_VALUES_1_2 = [
        'user_id' => 'someId',
        'email' => 'example.example.com',
        'name' => 'Mr Potato',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
    ];

    const INVALID_VALUES_1_3 = [
        'user_id' => 'someId',
        'email' => 'example@example.com',
        'name' => 'Mr',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
    ];

    const INVALID_VALUES_1_4 = [
        'user_id' => 'someId',
        'email' => 'example@example.com',
        'name' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
    ];

    const RULES_1 = [
        'user_id' => 'notEmpty',
        'email' => 'notEmpty|email',
        'name' => 'notEmpty|string|greaterThan:3|lessThan:120',
        'description' => 'notEmpty|greaterThan:40'
    ];

    function it_should_do_nothing_with_valid_parameters()
    {
        $this->beConstructedThrough('check', [
           self::VALID_VALUES_1,
           self::RULES_1
        ]);
    }

    function it_should_thrown_an_exception_when_user_id_is_empty()
    {
        $this->shouldThrow(
            \Throwable::class
        )->during('check', self::INVALID_VALUES_1, self::RULES_1);
    }

    function it_should_thrown_an_exception_when_email_is_not_well_formed()
    {
        $this->shouldThrow(
            \Throwable::class
        )->during('check', self::INVALID_VALUES_1_2, self::RULES_1);
    }

    function it_should_thrown_an_exception_when_name_is_less_than_2()
    {
        $this->shouldThrow(
            \Throwable::class
        )->during('check', self::INVALID_VALUES_1_3, self::RULES_1);
    }

    function it_should_thrown_an_exception_when_name_is_greater_than_120()
    {
        $this->shouldThrow(
            \Throwable::class
        )->during('check', self::INVALID_VALUES_1_4, self::RULES_1);
    }
}
