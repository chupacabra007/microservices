<?php

namespace users\Domain\Model;

interface UserRepository
{

    /**
     * @return ObjectId
     */
    public function nextIdentity();

    /**
     * @return list of users
     */
    public function list();

}