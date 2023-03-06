<?php

namespace App\Controller\Api;

use App\DTO\CommentDTO;
use App\Entity\ArticleComment;
use App\Entity\CommentAnswer;
use App\Entity\CommentsRates;
use App\Service\ArticleService;
use App\Service\CommentService;
use App\Service\CommentsRatesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentApiController extends AbstractController
{
    #[Route('/api/article/{articleId}/comment', name: 'api_get_article_comments', methods: ['GET'])]
    public function getArticleComments(int $articleId, CommentService $commentService): Response
    {
        $comments = $commentService->getArticleComments($articleId);

        $commentDTOs = [];
        foreach ($comments as $comment) {
            $commentDTOs[] = CommentDTO::toJsonLight($comment);
        }

        return new JsonResponse($commentDTOs, 200, ["Content-Type" => "application/json"]);
    }

    #[Route('/api/comment/{commentId}/answer', name: 'api_get_comment_answers', methods: ['GET'])]
    public function getCommentAnswers(int $commentId, CommentService $commentService): Response
    {
        $comments = $commentService->getCommentAnswers($commentId);

        $commentDTOs = [];
        foreach ($comments as $comment) {
            $commentDTOs[] = CommentDTO::toJsonLight($comment);
        }

        return new JsonResponse($commentDTOs, 200, ["Content-Type" => "application/json"]);
    }

    #[Route(path: '/api/article/{articleId}/comment', name: 'api_create_comment', methods: ['POST'])]
    public function createComment(Request $request, int $articleId, ArticleService $articleService, CommentService $commentService, Security $security): Response
    {
        if (! $article = $articleService->getArticle($articleId)) {
            return new JsonResponse(['error' => 'Article not found'], 404, ["Content-Type" => "application/json"]);
        }

        try {
            $comment = CommentDTO::fromJson($request->getContent(), ArticleComment::class);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => 'Fields content is missing'], 500, ["Content-Type" => "application/json"]);
        }

        $comment->setArticle($article);
        $comment->setUser($security->getUser());

        $commentService->save($comment);

        return new JsonResponse(CommentDTO::toJsonLight($comment), 200, ["Content-Type" => "application/json"]);
    }

    #[Route(path: '/api/comment/{commentId}/answer', name: 'api_create_answer', methods: ['POST'])]
    public function createAnswer(Request $request, int $commentId, CommentService $commentService, Security $security): Response
    {
        if (! $parentComment = $commentService->getComment($commentId)) {
            return new JsonResponse(['error' => 'Parent comment not found'], 404, ["Content-Type" => "application/json"]);
        }

        try {
            $comment = CommentDTO::fromJson($request->getContent(), CommentAnswer::class);
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => 'Fields content is missing'], 500, ["Content-Type" => "application/json"]);
        }

        $comment->setArticle($parentComment->getArticle());
        $comment->setUser($security->getUser());
        $comment->setParentComment($parentComment);

        $commentService->save($comment);
        return new JsonResponse(CommentDTO::toJsonLight($comment), 200, ["Content-Type" => "application/json"]);
    }

    #[Route(path: '/api/comment/{commentId}/rate', name: 'api_rate_comment', methods: ['POST'])]
    public function rateComment(Request $request, int $commentId, CommentsRatesService $commentsRatesService, CommentService $commentService, Security $security): Response
    {
        if (! $comment = $commentService->getComment($commentId)) {
            return new JsonResponse(['error' => 'Comment not found'], 404, ["Content-Type" => "application/json"]);
        }

        try {
            $rate = json_decode($request->getContent(), true)['rate'];
        } catch (\Exception $exception) {
            return new JsonResponse(['error' => 'Fields rate is missing'], 500, ["Content-Type" => "application/json"]);
        }

        if ($rate > 5 || $rate < 0) {
            return new JsonResponse(['error' => 'Fields rate should be float between 0 and 5'], 500, ["Content-Type" => "application/json"]);
        }

        $currentUser         = $security->getUser();
        $existingCommentRate = $commentsRatesService->getCommentRate($commentId,$currentUser->getId());
        $comment             = $commentService->getComment($commentId);

        if (! $existingCommentRate) {
            $existingCommentRate = new CommentsRates();
            $existingCommentRate->setComment($comment);
            $existingCommentRate->setUser($currentUser);
        }

        // Update rating
        $existingCommentRate->setRate($rate);
        $commentsRatesService->save($existingCommentRate);

        // Update comment rating
        $newCalculatedRating = $commentsRatesService->getCalculatedCommentRate($commentId);
        $comment->setRate($newCalculatedRating);
        $commentService->save($comment);

        return new JsonResponse(CommentDTO::toJsonLight($comment), 200, ["Content-Type" => "application/json"]);
    }
}