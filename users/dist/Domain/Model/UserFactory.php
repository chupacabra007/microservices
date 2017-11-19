<?php

namespace users\Domain\Model;


interface UserFactory
{
    public function build(ObjectId $objectId, $request);
}