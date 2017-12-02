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
    public function listUsers();
    
    
    /**
     * @return user as an array
     */
    public function byCredentials($login, $password);

}