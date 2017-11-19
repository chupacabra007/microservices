<?php
namespace users\Infrastructure\Model;

use users\Domain\Model\ObjectId;
use users\Domain\Model\User;

class DoctrineUser extends User
{
    private $surrogateId;

    public function __construct(ObjectId $objectId, $request)
    {
        parent::__construct($objectId, $request);
    }
}