<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/new-post", name="blog_post_new")
     */
    public function newPostAction(Request $request)
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('admin/new.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/update-post/{id}", name="blog_post_edit", requirements={"id"="\d"},methods={"GET","POST"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function edit($id, Request $request): Response
    {
        $blogPost = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->find($id);

        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('admin/edit.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/delete-post/{id}", name="blog_post_delete_form", requirements={"id"="\d"}, methods={"GET","POST"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function deletePostAction($id, Request $request): Response
    {
        $blogPost = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->find($id);

        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('admin/_delete.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }


}
