<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
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
    protected $orderNextStepRoute;

    public function __construct(HttpUtils $httpUtils, LoggerInterface $logger, $defaultRoute, $orderRoute)
    {
        $this->httpUtils = $httpUtils;
        $this->logger = $logger;
        $this->defaultPath = $defaultRoute;
        $this->orderNextStepRoute = $orderRoute;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $path = $this->defaultPath;
        if ($request->getSession()->has('order')) {
            $path = $this->orderNextStepRoute;
        }

        return $this->httpUtils->createRedirectResponse($request, $path);
    }

}
