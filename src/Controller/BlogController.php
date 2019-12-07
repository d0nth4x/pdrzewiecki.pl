<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/microblog", name="blog")
     */
    public function index()
    {
        $posts = $this->getDoctrine()->getRepository(BlogPost::class)->findAll();

        return $this->render('blog/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
