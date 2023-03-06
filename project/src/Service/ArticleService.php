<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(articleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAll(): array
    {
        return $this->articleRepository->findAll();
    }
    public function getArticle(int $articleId): ?Article
    {
        return $this->articleRepository->find($articleId);
    }
}