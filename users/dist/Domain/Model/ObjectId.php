<?php

namespace users\Domain\Model;

use Ramsey\Uuid\Uuid;

/**
 * Class ObjectId
 * @package users\Domain\Model
 */
class ObjectId
{

    private $id;

    /**
     * ObjectId constructor.
     * @param null $id - id of the object
     */
    private function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    /**
     * Creates and id of the object
     *
     * @param null $id - id of the object
     *
     * @return static - returns id of the object
     */
    public static function create($id = null)
    {
        return new static($id);
    }

    /**
     * Converts ObjectId to string value
     *
     * @return string - returns ObjectId string value
     */
    public function __toString(){
        return $this->id;
    }

}