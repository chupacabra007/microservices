<?php

namespace users\Application\Service;

use users\Infrastructure\Persistence\DoctrineUserRepository;

class Transactions {
    public function list($em){
        $ur = new DoctrineUserRepository($em);
        $result = $ur->list();
        return $result;
    }
}