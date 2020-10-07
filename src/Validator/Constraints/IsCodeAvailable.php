<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsCodeAvailable extends Constraint
{
    public string $message = 'code';
}
