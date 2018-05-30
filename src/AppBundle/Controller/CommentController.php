<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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

    /**
     * @Rest\Delete("/api/comments/{comment}")
     */
    public function deleteCommentAction(Request $request, Comment $comment)
    {
        // Check comment author
        if ($comment->getAuthor()->getId() !== $this->getUser()->getId()) {
            throw new AccessDeniedHttpException();
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($comment);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
