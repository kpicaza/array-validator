<?php

declare(strict_types=1);

namespace Validator;

use InvalidArgumentException;

class ValidationException extends InvalidArgumentException
{

    private $error;

    public static function withField($field, $message): self
    {
        $self = new self($message);
        $self->error = [
            'field' => $field,
            'message' => $message
        ];

        return $self;
    }

    public function error(): array
    {
        return $this->error;
    }
}
