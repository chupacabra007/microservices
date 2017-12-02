<?php

namespace users\Application\Service;

use users\Infrastructure\Persistence\DoctrineUserRepository;

class Queries {
	
    private $em;
	
	 public function __construct($entityManager) 
	 {
        $this->em = $entityManager;	 
	 }
	
    public function listUsers() 
    {
        $repo = new DoctrineUserRepository($this->em);
        $users = $repo->listUsers();
        return $users;
    }
    
    public function userExists($username, $password) 
    {
    	  $repo = new DoctrineUserRepository($this->em);
    	  $user = $repo->byCredentials($username, $password);
        return count($user) == 1;
    }
    
}