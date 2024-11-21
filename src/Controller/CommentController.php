<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{
    #[Route('comment', name: 'post_comment', methods: ['POST'])]
    public function postComment(EntityManagerInterface $entityManager, Request $request): Response {
        $newsRepository = $entityManager->getRepository(News::class);

        $comment = new Comment();
        $comment->setText($request->get('text'));
        $comment->setAuthorName($request->get('authorName'));
        $comment->setNews($newsRepository->find($request->get('newsId')));

        $entityManager->persist($comment);
        $entityManager->flush();

        return new Response(Response::HTTP_CREATED);
    }
}