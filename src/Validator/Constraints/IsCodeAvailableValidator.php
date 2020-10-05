<?php

namespace App\Validator\Constraints;

use App\Entity\Code;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class IsCodeAvailableValidator extends ConstraintValidator
{
    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof IsCodeAvailable) {
            throw new UnexpectedTypeException($constraint, IsCodeAvailable::class);
        }

        if (is_null($value) || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $this->registry->getManager();
        $em = $this->registry->getManagerForClass(Code::class);

        if (!$em) {
            throw new ConstraintDefinitionException(sprintf('Impossible de trouver le gestionnaire d\'objets associé à une entité de class "%s".', Code::class));
        }

        $repository = $em->getRepository(Code::class);
        $code = $repository->findUnusedCode($value);

        if (null !== $code) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
