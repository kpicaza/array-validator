<?php

declare(strict_types=1);

namespace Tests\Validator;

use PHPUnit\Framework\TestCase;
use Validator\ArrayValidator;

class ArrayValidatorTest extends TestCase
{
    const VALID_VALUES_1 = [
        'user_id' => 'SomeId',
        'email' => 'example@example.com',
        'name' => 'Mr Potato',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley.'
    ];

    const INVALID_VALUES_1 = [
        'user_id' => '',
        'email' => 'example@example.com',
        'name' => 'Mr Potato',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
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
        'name' => 'notEmpty|string|minLength:3|maxLength:120',
        'description' => 'notEmpty|minLength:40'
    ];

    function testShouldDoNothingWithValidParameters()
    {
        ArrayValidator::check(self::VALID_VALUES_1, self::RULES_1);
        $this->assertTrue(true);
    }

    function testShouldThrownAnExceptionWhenUserIdIsEmpty()
    {
        $this->expectException(\Throwable::class);

        ArrayValidator::check(self::INVALID_VALUES_1, self::RULES_1);
    }

    function testShouldThrownAnExceptionWhenEmailIsNotWellFormed()
    {
        $this->expectException(\Throwable::class);

        ArrayValidator::check(self::INVALID_VALUES_1_2, self::RULES_1);
    }

    function testShouldThrownAnExceptionWhenNameIsLessThan2()
    {
        $this->expectException(\Throwable::class);

        ArrayValidator::check(self::INVALID_VALUES_1_3, self::RULES_1);
    }

    function testShouldThrownAnExceptionWhenNameIsGreaterThan120()
    {
        $this->expectException(\Throwable::class);

        ArrayValidator::check(self::INVALID_VALUES_1_4, self::RULES_1);
    }

}
