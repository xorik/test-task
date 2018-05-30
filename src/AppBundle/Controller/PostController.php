<?php

namespace AppBundle\Controller;

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
        $form = $this->createForm(PostType::class);
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
