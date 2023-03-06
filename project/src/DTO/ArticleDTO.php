<?php

namespace App\DTO;

class ArticleDTO implements EntityDTO
{
    public static function toJsonLight($entity): array
    {
        return [
            'id'      => $entity->getId(),
            'title'   => $entity->getTitle(),
            'content' => $entity->getContent(),
        ];
    }

    public static function toJsonFull($entity): array
    {
        return self::toJsonLight($entity);
    }

    public static function fromJson(string $jsonData, ?string $typeClass)
    {
        // TODO: Implement fromJsonLight() method.
    }
}