<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoginRolesSuscriberSubscriber implements EventSubscriberInterface
{
    private $urlGenerator;
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }
    public function onLoginSuccessEvent(LoginSuccessEvent $event)
    {
        $user  = $event->getUser();

        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $event->setResponse(new RedirectResponse($this->urlGenerator->generate('admin')));
        }else if(in_array('ROLE_PROFESSEUR', $user->getRoles())){
            $event->setResponse(new RedirectResponse($this->urlGenerator->generate('professeur_index')));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            LoginSuccessEvent::class => 'onLoginSuccessEvent',
        ];
    }
}