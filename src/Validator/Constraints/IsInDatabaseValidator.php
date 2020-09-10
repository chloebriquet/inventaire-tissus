<?php

namespace App\Validator\Constraints;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class IsInDatabaseValidator extends ConstraintValidator
{
    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof IsInDatabase) {
            throw new UnexpectedTypeException($constraint, IsInDatabase::class);
        }

        if (is_null($value) || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $em = $this->registry->getManagerForClass($constraint->className);

        if (!$em) {
            throw new ConstraintDefinitionException(sprintf('Impossible de trouver le gestionnaire d\'objets associé à une entité de class "%s".', $constraint->className));
        }

        $repository = $em->getRepository($constraint->className);
        $result = $repository->findBy([$constraint->property => $value]);

        if ($result) {
            return;
        }

        $this->context->buildViolation($constraint->messsage)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
