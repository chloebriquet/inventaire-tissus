<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HasSameValue extends Constraint
{
    public $type = '';
    public $message = 'has_same_value';
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
