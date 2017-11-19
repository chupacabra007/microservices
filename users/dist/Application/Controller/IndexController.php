<?php

namespace users\Application\Controller;

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;
use users\Application\Service\Transactions;

class IndexController extends Controller {
    private $em;
    private $JWTService;
    
    public function initialize(){
        $this->em = $this->di->get('entityManager');
        $this->JWTService = $this->di->get('JWTService');    
    }
    
    public function indexAction() {
        $tnx = new Transactions();
        $users = $tnx->list($this->em);
        echo json_encode($users);
    }
    
}