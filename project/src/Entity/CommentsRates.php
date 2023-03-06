<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Cassandra\Date;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: CommentsRates::class)]
class CommentsRates
{
    #[ORM\Id, ORM\ManyToOne(targetEntity: Comment::class)]
    private Comment $comment;

    #[ORM\Id, ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\Column]
    private ?int $rate;

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }

    /**
     * @param Comment $comment
     */
    public function setComment(Comment $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return int|null
     */
    public function getRate(): ?int
    {
        return $this->rate;
    }

    /**
     * @param int|null $rate
     */
    public function setRate(?int $rate): void
    {
        $this->rate = $rate;
    }
}