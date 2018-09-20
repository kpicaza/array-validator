<?php

declare(strict_types=1);

namespace Tests\Validator;

use PHPUnit\Framework\TestCase;
use Validator\ArrayValidator;

class ArrayValidatorWithMultiParamConstrainsTest extends TestCase
{
    const RULES_1 = [
        'has_work' => 'notEmpty|choice:(yes,no)',
        'date' => 'notEmpty|date:Y-m-d|inArray:(2018-09-23,2018-09-24,2018-09-25)',
        'name' => 'notEmpty|notInArray:(mike)|minLength:3|maxLength:75',
        'description' => 'notEmpty|betweenLength:40,100'
    ];

    const VALID_VALUES_1 = [
        'has_work' => 'yes',
        'date' => '2018-09-24',
        'name' => 'Mr Potato',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an.'
    ];

    const INVALID_VALUES_1 = [
        'has_work' => 'potato',
        'date' => '2018-09-24',
        'name' => 'Mr Potato',
        'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an.'
    ];

    function testShouldDoNothingWithValidParameters()
    {
        ArrayValidator::check(self::VALID_VALUES_1, self::RULES_1);
        $this->assertTrue(true);
    }

    function testShouldThrownAnExceptionWhenValueIsNotInGivenChoice()
    {
        $this->expectException(\Throwable::class);

        ArrayValidator::check(self::INVALID_VALUES_1, self::RULES_1);
    }
}
