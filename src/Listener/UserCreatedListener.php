<?php

namespace App\Listener;

use App\Entity\Code;
use App\Entity\User;
use App\Repository\CodeRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UserCreatedListener
{
    public function prePersist(User $user, LifecycleEventArgs $args): void
    {
        if (null === $user->code) {
            return;
        }

        /** @var CodeRepository $repository */
        $repository = $args->getEntityManager()->getRepository(Code::class);
        $code = $repository->findUnusedCode($user->code);

        if (null !== $code) {
            $code->usedAt = new \DateTimeImmutable();
        }
    }
}
