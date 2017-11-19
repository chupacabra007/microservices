<?php

namespace users\Infrastructure\Persistence;

use Doctrine\ORM\EntityManager;

use users\Domain\Model\ObjectId;
use users\Domain\Model\UserRepository;
use users\Domain\Model\User;

class DoctrineUserRepository implements UserRepository
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Creates object's Identity
     *
     * @return mixed - returns objects's Identity
     */
    public function nextIdentity()
    {
        return ObjectId::create();
    }

    public function list()
    {
        return $this->em->getRepository('users\Infrastructure\Model\DoctrineUser')->findAll();
    }

}