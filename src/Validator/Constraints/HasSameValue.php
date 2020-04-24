<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HasSameValue extends Constraint
{
    public $type = '';
    public $message = '{{ field }} ne correspond pas.';
    public $fields = [];
    public $errorPath = '';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getRequiredOptions()
    {
        return ['fields', 'type'];
    }
}
