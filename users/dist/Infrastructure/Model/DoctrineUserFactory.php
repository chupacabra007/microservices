<?php

namespace users\Infrastructure\Model;


use users\Domain\Model\UserFactory;
use users\Domain\Model\ObjectId;

class DoctrineUserFactory implements UserFactory
{

    public function build(ObjectId $objectId, $request)
    {
        $user = new DoctrineUser($objectId, $request);
        return $user;
    }

}