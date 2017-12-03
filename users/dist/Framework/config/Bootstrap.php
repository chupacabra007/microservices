<?php

use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Config\Adapter\Ini as Config;

use users\Framework\BodyParser;
use users\Infrastructure\Service\JWTService;



class Bootstrap
{
    public function run()
    {

        $di = new Phalcon\DI\FactoryDefault();

        $this->loader($di);

        $this->service($di);

        $application = new Application($di);
        $response = $application->handle();
        $response->send();
    }

    private function loader($di)
    {

        $loader = new Phalcon\Loader();

        $loader->registerNamespaces([
            'users\Application\Controller' => '../../Application/Controller/',
            'users\Application\Service' => '../../Application/Service/',
            'users\Domain\Model' => '../../Domain/Model/',
            'users\Infrastructure\Persistence' => '../../Infrastructure/Persistence/',
            'users\Infrastructure\Model' => '../../Infrastructure/Model/',
            'users\Infrastructure\Service' => '../../Infrastructure/Service/',
            'users\Framework' => '../config/'
        ])->register();

    }

    private function service($di)
    {
        $config = $this->config();

        $di->setShared('url', $this->url($config));
        
        $di->set('eventsManager', function () {
            return new EventsManager();
        });
       
        $di->set('view', $this->view($di));

        $di->set('dispatcher', $this->dispatch($di));

        $di->set('entityManager', $this->entityManager($di, $config));

        $di->set('router', $this->router());

        $di->set('config', $config);

        $di->set('privateKey', $this->privateKey());

        $di->set('JWTService', $this->JWTService($config));

        $di->set(
            'cookies',
            function () {
                $cookies = new \Phalcon\Http\Response\Cookies();
                $cookies->useEncryption(false);
                return $cookies;
            }
        );

    }

    private function config()
    {
        $config = new Config(BASE_PATH . '/config/config.ini');
        return $config;
    }

    private function url($config)
    {
        $url = new UrlResolver();
        $url->setBaseUri($config->application->baseUri);
        return $url;
    }

    private function view()
    {
        $view = new View();
        $view->setViewsDir(BASE_PATH . '/views/');
        return $view;
    }

    private function dispatch($di)
    {
        $eventsManager = $di->get('eventsManager');
        $eventsManager->attach('dispatch:beforeExecuteRoute', new BodyParser());
        $dispatcher = new Dispatcher();
        $dispatcher->setDefaultNamespace('users\Application\Controller');
        $dispatcher->setEventsManager($eventsManager);
        return $dispatcher;       
    }

    private function privateKey($filePath)
    {
        if (strpos($filePath, 'file://') === 0) {
            $file = substr($filePath, 7);
            if (!is_readable($file) && (!file_exists($file))) {
                throw new \InvalidArgumentException('You must inform a valid key file');
            }
            return file_get_contents($file);
        }
    }

    private function JWTService($config)
    {
        $privateKey = $this->privateKey($config->jwt->private_key);
        $JWTService = new JWTService($privateKey);
        return $JWTService;
    }

    private function entityManager($di, $config)
    {

        $metadata = \Doctrine\ORM\Tools\Setup::createXMLMetadataConfiguration(
            array(__DIR__ . '/../../Database/Mapper'), $devMode = true
        );

        $db = $config->defaults->database;

        $params = $config->{$db};

        $conn = [
            'driver'   => $params->driver,
            'host'     => $params->host,
            'dbname'   => $params->dbname,
            'user'     => $params->user,
            'password' => $params->password
        ];

        $entityManager = Doctrine\ORM\EntityManager::create($conn, $metadata);

        return $entityManager;

    }

    private function router()
    {
        $router = new Phalcon\Mvc\Router(false);

        $router->add(
            '/',
            [
                'namespace'  => 'users\Application\Controller',
                'controller' => 'index',
                'action'     => 'index'
            ]
        );
        
        $router->add(
            '/authenticate',
            [
                'namespace'  => 'users\Application\Controller',
                'controller' => 'index',
                'action'     => 'authenticate'
            ]
        );
        
        return $router;
    }

}