<?php
namespace AppBundle\EventListener;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SuccessfulLoginSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationCompleted',
        ];
    }

    public function onRegistrationCompleted(FormEvent $event)
    {
        $response = new RedirectResponse('/posts');
        $event->setResponse($response);
    }
}