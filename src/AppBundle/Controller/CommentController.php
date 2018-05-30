<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends FOSRestController
{
    /**
     * @Rest\Post("/api/posts/{post}/comments")
     * @Rest\View()
     */
    public function postCommentAction(Request $request, Post $post)
    {
        $comment = new Comment($post, $this->getUser());
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            return $comment;
        }

        return $form;
    }
}
