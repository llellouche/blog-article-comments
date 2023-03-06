<?php

namespace App\Controller\Api;

use App\DTO\ArticleDTO;
use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleApiController extends AbstractController
{
    /**
     * Finally unused cause not asked
     * @param int $articleId
     * @param ArticleService $articleService
     * @return Response
     */
    #[Route('/api/article/{articleId}', name: 'api_get_article')]
    public function getArticle(int $articleId, ArticleService $articleService): Response
    {
        $article = $articleService->getArticle($articleId);

        if (! $article) {
            return new JsonResponse(['error' => 'Article not found'], 404, ["Content-Type" => "application/json"]);
        }

        return new JsonResponse(ArticleDTO::toJsonLight($article), 200, ["Content-Type" => "application/json"]);
    }
}