<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MaxRule implements RuleInterface
{
    public function validate(array $data, string $field, array $params): bool
    {
        if (empty($params[0])) {
            throw new InvalidArgumentException("Maximum Length Not Specified");
        }

        $length = (int) $params[0];
        return strlen($data[$field]) < $length;
    }

    public function getMessage(array $data, string $field, array $params): string
    {
        return "Exceeds Maximum Character Limit of {$params[0]} Characters";
    }
}
