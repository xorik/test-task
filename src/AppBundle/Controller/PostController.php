<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PostController extends FOSRestController
{
    /**
     * @Rest\Post("/api/posts")
     * @Rest\View()
     */
    public function postPostAction(Request $request)
    {
        $post = new Post($this->getUser());
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $post;
        }
    }
}
