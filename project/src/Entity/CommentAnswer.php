<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class CommentAnswer extends Comment
{
    #[ORM\ManyToOne(targetEntity: Comment::class, inversedBy: 'answers')]
    private Comment $parentComment;

    /**
     * @return Comment
     */
    public function getParentComment(): Comment
    {
        return $this->parentComment;
    }

    /**
     * @param Comment $parentComment
     */
    public function setParentComment(Comment $parentComment): void
    {
        $this->parentComment = $parentComment;
    }
}
