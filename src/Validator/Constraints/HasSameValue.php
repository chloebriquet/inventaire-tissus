<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HasSameValue extends Constraint
{
    public string $type = '';
    public string $message = 'has_same_value';
    /** @var array<string> */
    public array $fields = [];
    public string $errorPath = '';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getRequiredOptions(): array
    {
        return ['fields', 'type'];
    }
}
