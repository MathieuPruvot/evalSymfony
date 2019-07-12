<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogPostController extends AbstractController
{

    /**
     * @Route("/liste", name="blog_post_liste", methods={"GET"})
     */
    public function listPostsAction (BlogPostRepository $blogPostRepository): Response
    {
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);

        $blog_posts = $repository -> findAll();

        return $this->render('blog_post/index.html.twig', [
            'controller_name' => 'blogPostController',
            'blog_posts' => $blog_posts,
        ]);
    }

    /**
     * @Route("/", name="blog_post_index", methods={"GET"})
     */
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog_post/index.html.twig', [
            'blog_posts' => $blogPostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_post_show", requirements={"id"="\d"}, methods={"GET"})
     */
    public function showPostAction (BlogPost $blogPost): Response
    {
        return $this->render('blog_post/show.html.twig', [
            'blog_post' => $blogPost,
        ]);
    }

    /**
     * @Route("/{slug}", name="blog_post_show_slug",  requirements={"slug"="[a-zA-Z0-9_]*"}, methods={"GET"})
     * @param $slug
     * @return Response
     */
    public function showSlugPostAction ($slug): Response
    {
        $blogPost = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->findBy(
                ['slug' => $slug]
            );

        return $this->render('blog_post/show.html.twig', [
            'blog_post' => $blogPost,
        ]);
    }

    /**
     * @Route("/{date}/{slug}", name="blog_post_show_date_slug",  requirements={"date"="[0-9]{4}", "slug"="[a-zA-Z0-9_]*"}, methods={"GET"})
     */
    public function showDateSlugPostAction ($date, $slug): Response
    {
        $blogPost = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->findBy(
                ['date' => $date],
                ['slug' => $slug]
            );

        return $this->render('blog_post/show.html.twig', [
            'blog_post' => $blogPost,
        ]);
    }


    /**
     * @Route("/{id}", name="blog_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BlogPost $blogPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_post_index');
    }

}
