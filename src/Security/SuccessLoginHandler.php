<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\HttpUtils;

/**
 * SuccessLoginHandler is a successful login handler
 */
class SuccessLoginHandler implements AuthenticationSuccessHandlerInterface
{

    /** @var HttpUtils */
    protected $httpUtils;

    /** @var LoggerInterface */
    protected $logger;

    /** @var UserRepo */
    protected $repository;
    protected $defaultPath;

    public function __construct(HttpUtils $httpUtils, LoggerInterface $logger)
    {
        $this->httpUtils = $httpUtils;
        $this->logger = $logger;
        $this->defaultPath = 'user_account';
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $path = $this->defaultPath;
        if ($request->getSession()->has('order')) {
            $path = 'order_pay';
        }

        return $this->httpUtils->createRedirectResponse($request, $path);
    }

}
