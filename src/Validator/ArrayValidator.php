<?php

declare(strict_types=1);

namespace Validator;

use Assert\Assertion;

class ArrayValidator
{
    public static function check(array $fields, array $rules): void
    {
        array_walk($fields, function ($value, $field) use ($rules) : void {
            Assertion::keyExists($rules, $field);
            array_map(
                function ($validationRule) use ($value) : void {
                    $validation = explode(':', $validationRule);

                    list($method, $param) = array_key_exists(1, $validation)
                        ? (-1 === strpos($validation[1], '.')
                            ? $validation
                            : explode('.', $validation[1]))
                        : [$validation[0], null];

                    call_user_func_array([Assertion::class, $method], [$value, $param]);
                },
                explode('|', $rules[$field])
            );
        });
    }
}