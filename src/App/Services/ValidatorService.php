<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Contracts\RuleInterface;

class ValidatorService
{
    private array $rules = [];

    public function add(string $alias, RuleInterface $rule)
    {
        $this->rules[$alias] = $rule;
    }

    public function validate($formData)
    {
        dd($formData);
    }
}
