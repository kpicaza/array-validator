<?php

declare(strict_types=1);

namespace Validator;

class RuleParser
{
    const RULES = [
        'singleParam' => [
            'alnum', // (mixed $value);
            'base64', // (string $value);
            'boolean', // (mixed $value);
            'classExists', // (mixed $value);
            'defined', // (mixed $constant);
            'digit', // (mixed $value);
            'directory', // (string $value);
            'e164', // (string $value);
            'email', // (mixed $value); DOCUMENTED
            'extensionLoaded', // (mixed $value);
            'false', // (mixed $value);
            'file', // (string $value);
            'float', // (mixed $value);
            'integer', // (mixed $value);
            'integerish', // (mixed $value);
            'interfaceExists', // (mixed $value);
            'isArray', // (mixed $value);
            'isArrayAccessible', // (mixed $value);
            'isCallable', // (mixed $value);
            'isJsonString', // (mixed $value);
            'isObject', // (mixed $value);
            'isResource', // (mixed $value);
            'isTraversable', // (mixed $value);
            'noContent', // (mixed $value);
            'notBlank', // (mixed $value);
            'notEmpty', // (mixed $value); DOCUMENTED
            'notNull', // (mixed $value);
            'null', // (mixed $value);
            'numeric', // (mixed $value);
            'objectOrClass', // (mixed $value);
            'readable', // (string $value);
            'scalar', // (mixed $value);
            'string', // (mixed $value);
            'true', // (mixed $value);
            'url', // (mixed $value);
            'uuid', // (string $value);
            'writeable', // (string $value);
            'choice', // (mixed $value, array $choices); DOCUMENTED
            'choicesNotEmpty', // (array $values, array $choices);
            'contains', // (mixed $string, string $needle);
            'count', // (array|\Countable $countable, int $count);
            'date', // (string $value, string $format); DOCUMENTED
            'endsWith', // (mixed $string, string $needle);
            'eq', // (mixed $value, mixed $value2);
            'greaterOrEqualThan', // (mixed $value, mixed $limit);
            'greaterThan', // (mixed $value, mixed $limit);
            'implementsInterface', // (mixed $class, string $interfaceName);
            'inArray', // (mixed $value, array $choices);
            'ip', // (string $value, int $flag = null);
            'ipv4', // (string $value, int $flag = null);
            'ipv6', // (string $value, int $flag = null);
            'isInstanceOf', // (mixed $value, string $className);
            'keyExists', // (mixed $value, string|int $key);
            'keyIsset', // (mixed $value, string|int $key);
            'keyNotExists', // (mixed $value, string|int $key);
            'length', // (mixed $value, int $length);
            'lessOrEqualThan', // (mixed $value, mixed $limit);
            'lessThan', // (mixed $value, mixed $limit);
            'max', // (mixed $value, mixed $maxValue);
            'maxLength', // (mixed $value, int $maxLength); DOCUMENTED
            'methodExists', // (string $value, mixed $object);
            'min', // (mixed $value, mixed $minValue);
            'minLength', // (mixed $value, int $minLength); DOCUMENTED
            'notEmptyKey', // (mixed $value, string|int $key);
            'notEq', // (mixed $value1, mixed $value2);
            'notInArray', // (mixed $value, array $choices); DOCUMENTED
            'notIsInstanceOf', // (mixed $value, string $className);
            'notSame', // (mixed $value1, mixed $value2);
            'phpVersion', // (string $operator, mixed $version);
            'propertiesExist', // (mixed $value, array $properties);
            'propertyExists', // (mixed $value, string $property);
            'regex', // (mixed $value, string $pattern);
            'same', // (mixed $value, mixed $value2);
            'satisfy', // (mixed $value, callable $callback);
            'startsWith', // (mixed $string, string $needle);
            'subclassOf', // (mixed $value, string $className);
        ],
        'multipleParams' => [
            'between', // (mixed $value, mixed $lowerLimit, mixed $upperLimit);
            'betweenExclusive', // (mixed $value, mixed $lowerLimit, mixed $upperLimit);
            'betweenLength', // (mixed $value, int $minLength, int $maxLength); DOCUMENTED
            'extensionVersion', // (string $extension, string $operator, mixed $version);
            'range', // (mixed $value, mixed $minValue, mixed $maxValue);
            'version', // (string $version1, string $operator, string $version2);
        ]
    ];

    public static function getRule(string $rule, ?string $plainConstrains)
    {
        $method = key(array_filter(
            self::RULES,
            function (array $availableRules) use ($rule): bool {
                return in_array($rule, $availableRules);
            }
        ));

        return call_user_func_array([self::class, $method], [$plainConstrains]);
    }

    private static function singleParam(?string $validation)
    {
        if (preg_match_all("@\((.+)\)@", $validation, $matches)) {
            $validation = explode(',', $matches[1][0]);
        }

        return $validation;
    }

    private static function multipleParams(?string $validation): array
    {
        return array_map(function ($rule) {
            return call_user_func_array([self::class, 'singleParam'], [$rule]);
        }, explode(',', $validation));
    }
}
