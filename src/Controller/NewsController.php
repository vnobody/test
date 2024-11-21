<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news', methods: ['GET'])]
    #[Template('news/index.html.twig')]
    public function newsList(EntityManagerInterface $entityManager): array {
        $news = $entityManager->getRepository(News::class)->findAll();

        return ['news' => $news];
    }

    #[Route('/news/{id}', name: 'news.show', requirements: ['id' => '\d+'])]
    #[Template('news/news.html.twig')]
    public function news(EntityManagerInterface $entityManager, int $id): array {
        $news = $entityManager->getRepository(News::class)->find($id);

        return ['item' => $news];
    }

    #[Route('/news', name: 'post_news', methods: ['POST'])]
    public function postNews(EntityManagerInterface $entityManager, Request $request) {
        $news = new News();
        $news->setTitle($request->get('title'));
        $news->setContent($request->get('content'));
        $news->setDescription($request->get('description'));
        $news->setAuthor($request->get('authorName'));
        $news->setInsertDate(date('d.m.Y'));
        $news->setPicturePath('');

        $entityManager->persist($news);
        $entityManager->flush();

        return new Response(Response::HTTP_CREATED);
    }

    #[Route('/news/{id}', name: 'news.delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, int $id): Response {
        $news = $entityManager->getRepository(News::class)->find($id);
        $entityManager->remove($news);
        $entityManager->flush();

        return $this->redirectToRoute('news');
    }
}