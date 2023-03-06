<?php

namespace App\Controller\Site;

use App\Entity\ArticleComment;
use App\Service\ArticleService;
use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     */
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function listArticlesAction(ArticleService $articleService)
    {
        $articles = $articleService->getAll();

        return $this->render('article/list.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Link to this controller to start the "connect" process
     */
    #[Route(path: '/article/{articleId}', name: 'article_view', methods: ['GET'])]
    public function viewArticleAction(int $articleId, ArticleService $articleService, CommentService $commentService)
    {
        $article         = $articleService->getArticle($articleId);
        $articleComments = $commentService->getArticleComments($articleId);

        return $this->render('article/view.html.twig', [
            'article'  => $article,
            'comments' => $articleComments,
        ]);
    }
}