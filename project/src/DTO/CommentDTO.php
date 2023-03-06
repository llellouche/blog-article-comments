<?php

namespace App\DTO;

use App\Entity\Comment;

class CommentDTO implements EntityDTO
{
    public static function toJsonLight($entity): array
    {
        return [
            'id'            => $entity->getId(),
            'content'       => $entity->getContent(),
            'rate'          => $entity->getRate(),
            'user_fullname' => $entity->getUser()->getFullname(),
            'user_picture'  => $entity->getUser()->getPicture(),
            'created_date'  => $entity->getCreateDate()->getTimestamp(),
        ];
    }

    public static function toJsonFull($entity): array
    {
        return self::toJsonLight($entity);
    }

    public static function fromJson(string $jsonData, ?string $typeClass = null): Comment
    {
        $jsonData = json_decode($jsonData);
        $comment  = $typeClass ? new $typeClass : new Comment();

        $comment->setContent($jsonData->content);

        return $comment;
    }
}