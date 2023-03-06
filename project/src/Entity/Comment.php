<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['COMMENT' => ArticleComment::class, 'ANSWER' => CommentAnswer::class])]
#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column]
    private ?string $content;

    #[ORM\Column]
    private ?float $rate;

    #[ORM\Column]
    private ?DateTime $createDate;

    #[ORM\ManyToOne(targetEntity: Article::class)]
    private ?Article $article;

    #[ORM\OneToMany(mappedBy: 'comment', targetEntity: CommentAnswer::class)]
    private Collection $answers;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    public function __construct()
    {
        $this->createDate = new DateTime();
        $this->rate       = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return float|null
     */
    public function getRate(): ?float
    {
        return $this->rate;
    }

    /**
     * @param float|null $rate
     */
    public function setRate(?float $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return DateTime|null
     */
    public function getCreateDate(): ?DateTime
    {
        return $this->createDate;
    }

    /**
     * @param DateTime|null $createDate
     */
    public function setCreateDate(?DateTime $createDate): void
    {
        $this->createDate = $createDate;
    }

    /**
     * @return Collection
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    /**
     * @param Collection $answers
     */
    public function setAnswers(Collection $answers): void
    {
        $this->answers = $answers;
    }

    /**
     * @return Article|null
     */
    public function getArticle(): ?Article
    {
        return $this->article;
    }

    /**
     * @param Article|null $article
     */
    public function setArticle(?Article $article): void
    {
        $this->article = $article;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
    }
}