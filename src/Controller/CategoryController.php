<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{category}", name="productByCategory")
     */
    public function productByCategoryAction($category)
    {
        $blog_posts = $this->getDoctrine()
            ->getRepository(CategoryRepository::class)
            ->findByCategory($category);

        return $this->render('blog_post/index.html.twig', [
            'controller_name' => 'blogPostController',
            'blog_posts' => $blog_posts,
        ]);
    }

}
