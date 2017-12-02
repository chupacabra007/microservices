<?php

namespace users\Application\Controller;

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;

use users\Application\Service\Queries;



class IndexController extends Controller {
    private $em;
    private $JWTService;
    
    
    public function initialize() 
    {
        $this->em = $this->di->get('entityManager');
        $this->JWTService = $this->di->get('JWTService');    
    }
    
    
    public function indexAction() 
    {
        $query = new Queries($this->em);
        $users = $query->listUsers();
        $response = new Response();
        $response->setJsonContent($users);
        return $response;
    }
    
    
    public function authenticateAction() 
    {
        echo json_encode($_REQUEST);
    }
    
}