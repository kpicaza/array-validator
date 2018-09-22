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
                    $method = $validation[0];
                    $params = array_key_exists(1, $validation) ? $validation[1] : null;
                    $ruleMethod = self::getRuleParams($method,  $params);

                    list($param1, $param2) = $ruleMethod[RuleParser::getRuleMethod($method)]($params);

                    call_user_func_array([Assertion::class, $method], [$value, $param1, $param2]);
                },
                explode('|', $rules[$field])
            );
        });
    }

    private static function getRuleParams(string $method, ?string $params): array {
        return [
            'singleParam' => function() use ($method, $params) {
                return [
                    $params ? RuleParser::getRule($method, $params) : null,
                    null
                ];
            },
            'multipleParams' => function() use ($method, $params) {
                return RuleParser::getRule($method, $params);
            },
        ];
    }
}
