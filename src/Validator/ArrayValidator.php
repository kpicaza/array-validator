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

                    if (in_array($validation[0], RuleParser::RULES['multipleParams'])) {
                        $method = $validation[0];
                        list($param1, $param2) = RuleParser::getRule($validation[0], $validation[1]);
                    }

                    if (in_array($validation[0], RuleParser::RULES['singleParam'])) {
                        $method = $validation[0];

                        $param1 = array_key_exists(1, $validation)
                            ? RuleParser::getRule($validation[0], $validation[1])
                            : null;
                    }

                    call_user_func_array(
                        [Assertion::class, $method],
                        [$value, $param1, isset($param2) ? $param2 : null]
                    );
                },
                explode('|', $rules[$field])
            );
        });
    }
}
