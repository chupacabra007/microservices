<?php

namespace users\Infrastructure\Persistence;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use users\Domain\Model\ObjectId;

/**
 * Class ObjectId
 * @package users\Infrastructure\Persistence
 */
class ObjectIdType extends GuidType
{

    /**
     * Returns Type name
     *
     * @return string - returns Type name
     */
    public function getName()
    {
        return 'ObjectId';
    }

    /**
     * Converts object to database value
     *
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed - returns database value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ObjectId::create($value);
    }

}