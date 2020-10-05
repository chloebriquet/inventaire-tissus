<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsCodeAvailable extends Constraint
{
    public $message = 'Le code "{{ value }}" n\'est pas valide.';
}
