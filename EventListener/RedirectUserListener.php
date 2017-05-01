<?php

namespace YS\UserBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class RedirectUserListener {
  private $router;
  private $tokenStorage;

  public function __construct(RouterInterface $router, TokenStorage $tokenStorage)
  {
    $this->router = $router;
    $this->tokenStorage = $tokenStorage;
  }

  public function onKernelRequest(GetResponseEvent $event)
  {
    $currentRoute = $event->getRequest()->attributes->get('_route');

    if($this->isUserLogged() && self::isAuthenticatedUserOnAnonymousPage($currentRoute) && $event->isMasterRequest()) {
        $response = new RedirectResponse($this->router->generate('homepage'));
        $event->setResponse($response);
    }
  }

  private function isUserLogged()
  {
    $return = false;
    if($this->tokenStorage->getToken() && is_object($this->tokenStorage->getToken()->getUser())){
      $return = true;
    }

    return $return;
  }

  private static function isAuthenticatedUserOnAnonymousPage($currentRoute)
  {
    return in_array(
      $currentRoute,
      ['fos_user_security_login', 'fos_user_resetting_request', 'fos_user_registration_register']
    );
  }
}