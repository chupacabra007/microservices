<?php

namespace users\Domain\Model;

/**
 * Class User
 * @package users\Domain\Model
 */
class User implements \JsonSerializable
{
    protected $objectId;
    protected $name;
    protected $login;
    protected $password;

    public function __construct(ObjectId $objectId, $name)
    {
        $this->objectId = $objectId;
        $this->name = $name;
    }

    /**
     * Sets user name
     *
     * @param $name - user name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Sets user login
     *
     * @param $login - user login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Sets user password
     *
     * @param $password - user password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function Password()
    {
        return $this->password;
    }
    
    public function jsonSerialize()
    {
        return [
            'id' => $this->objectId instanceof ObjectId ? $this->objectId->id() : $this->objectId,
            'name' => $this->name,            
            'login' => $this->login
        ];
    }

}