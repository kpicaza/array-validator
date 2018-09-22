# Array validator

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kpicaza/array-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/array-validator/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kpicaza/array-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/array-validator/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/kpicaza/array-validator/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/array-validator/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kpicaza/array-validator/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Maintainability](https://api.codeclimate.com/v1/badges/656e9373cdf27ccf9c3b/maintainability)](https://codeclimate.com/github/kpicaza/array-validator/maintainability)

Array validation utility on top of [Beberley/Assert](https://github.com/beberlei/assert) using laravel request validation rules style.

## Installation

````
composer require kpicaza/validation-rules
````

## Usage

```php
<?php

use Validator\ArrayValidator;

$rules = [
    'user_id' => 'notEmpty',
    'email' => 'notEmpty|email',
    'name' => 'notEmpty|string|greaterThan:3|lessThan:120',
    'description' => 'notEmpty|greaterThan:40'
];

// This is the array we want to validate
$params = [
    'user_id' => 'SomeId',
    'email' => 'example@example.com',
    'name' => 'Mr Potato',
    'description' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'
];

// It should not do nothing, everything is correct here.
ArrayValidator::check($params, $rules);

// Now you can do something with known valid params.

// This is the array we want to validate
$params['email'] = 'I\'m no an email address';

// This throws an InvalidArgumentException instance
ArrayValidator::check($params, $rules);

```

See more examples and options inner [docs](docs/index.md).
