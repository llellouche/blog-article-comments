<?php

namespace App\DTO;

use App\Repository\CommentRepository;
use Cassandra\Date;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: EntityDTO::class)]
interface EntityDTO
{
    /**
     * * Return Entity without relations
     * @param $entity
     * @return array
     */
    public static function toJsonLight($entity): array;

    /**
     * Return Entity with relations
     * @param $entity
     * @return array
     */
    public static function toJsonFull($entity): array;

    /**
     * * Return Entity form Json
     * @param string $jsonData
     * @param ?string $typeClass
     * @return mixed $entity
     */
    public static function fromJson(string $jsonData, ?string $typeClass);

}