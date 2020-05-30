<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsInDatabase extends Constraint
{
    public $messsage = '{{ value }} n\'existe pas.';
    public $className = '';
    public $property = 'name';

    public function getDefaultOption()
    {
        return 'className';
    }

    public function getRequiredOptions()
    {
        return ['className'];
    }
}
