<?php

namespace users\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;
use users\Application\Service\TransactionalSession;

class DoctrineSession implements TransactionalSession
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function executeAtomically(callable $operation)
    {
        return $this->entityManager->transactional($operation);
    }

}