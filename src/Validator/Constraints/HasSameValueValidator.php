<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class HasSameValueValidator extends ConstraintValidator
{
    public function validate($entity, Constraint $constraint)
    {
        if (!$constraint instanceof HasSameValue) {
            throw new UnexpectedTypeException($constraint, HasSameValue::class);
        }

        if (!is_array($constraint->fields)) {
            throw new UnexpectedTypeException($constraint->fields, 'array');
        }

        if (null !== $constraint->errorPath && !\is_string($constraint->errorPath)) {
            throw new UnexpectedTypeException($constraint->errorPath, 'string or null');
        }

        $fields = (array) $constraint->fields;

        if (2 !== count($fields)) {
            throw new ConstraintDefinitionException('Au moins et seulement 2 champs doivent être comparés.');
        }

        if (null === $entity) {
            return;
        }

        $className = get_class($entity);

        $comparedValues = [];

        foreach ($fields as $fieldName) {
            try {
                $method = new \ReflectionMethod($className, 'get'.$fieldName);
                $comparedValues[$fieldName] = $method->invoke($entity);
            } catch (\ReflectionException $exception) {
                throw new ConstraintDefinitionException(sprintf('La classe "%s" ou le champ "%s" n\'existent pas, le champ ne peut donc pas être comparé.', get_class($entity), $fieldName));
            }
        }

        if (1 === count(array_unique($comparedValues))) {
            return;
        }

        $errorPath = $constraint->errorPath ? $constraint->errorPath : $fields[1];

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ field }}', $constraint->type)
            ->atPath($errorPath)
            ->addViolation();
    }
}
