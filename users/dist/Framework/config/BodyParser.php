<?php

namespace users\Framework;

use Phalcon\Events\Event;
use Phalcon\Exception;
use Phalcon\Http\Request;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;



class BodyParser extends Plugin
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $contentType = strtolower($this->request->getHeader('CONTENT_TYPE'));
        switch ($contentType) {
            case 'application/json':
            case 'application/json;charset=utf-8':
                $jsonRawBody = $this->request->getJsonRawBody(true);
                if ($this->request->getRawBody() && !$jsonRawBody) {
                    throw new Exception("Invalid JSON syntax");
                }
                $_POST = $jsonRawBody;
                break;
        }
    }
}