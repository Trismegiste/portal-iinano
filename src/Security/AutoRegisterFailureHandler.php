<?php

/*
 * portal-iinano
 */

namespace Trismegiste\PortalBundle\Security;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\HttpUtils;
use Trismegiste\OAuthBundle\Oauth\ThirdPartyAuthentication;
use Trismegiste\OAuthBundle\Security\Token;
use Trismegiste\PortalBundle\Repository\User as UserRepo;

/**
 * AutoRegisterFailureHandler is a handler for login failure when the the user is
 * validated by OAuth provider but not registered in the customer database
 */
class AutoRegisterFailureHandler implements AuthenticationFailureHandlerInterface
{

    /** @var RouterInterface */
    protected $httpUtils;

    /** @var LoggerInterface */
    protected $logger;

    /** @var UserRepo */
    protected $repository;

    /** @var SecurityContextInterface */
    protected $security;

    /** @var AuthenticationSuccessHandlerInterface */
    protected $successLoginHandler;

    public function __construct(HttpUtils $httpUtils, LoggerInterface $logger, UserRepo $repo, SecurityContextInterface $secu, AuthenticationSuccessHandlerInterface $successHandler)
    {
        $this->security = $secu;
        $this->httpUtils = $httpUtils;
        $this->logger = $logger;
        $this->failureDefault = 'trismegiste_oauth_connect';
        $this->repository = $repo;
        $this->successLoginHandler = $successHandler;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $targetPath = $this->failureDefault;

        $token = $exception->getToken();
        $this->logger->debug('Authentication failure handled by ' . __CLASS__, [
            $exception,
            $exception->getPrevious(),
            $token
        ]);

        if (($exception instanceof BadCredentialsException) &&
                ($exception->getPrevious() instanceof UsernameNotFoundException) &&
                ($token instanceof Token) &&
                ($token->getRoles()[0]->getRole() == ThirdPartyAuthentication::IDENTIFIED)) {

            $this->logger->info('Autoregister');

            // create new user, persist and authenticate
            $user = $this->repository->create($token->getUserUniqueIdentifier(), $token->getProviderKey(), $token->getAttribute('nickname'));
            $newToken = new Token($token->getFirewallName(), $token->getProviderKey(), $token->getUserUniqueIdentifier(), $user->getRoles());
            $this->repository->persist($user);
            $newToken->setUser($user);
            $this->security->setToken($newToken);

            return $this->successLoginHandler->onAuthenticationSuccess($request, $newToken);
        }

        $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);

        return $this->httpUtils->createRedirectResponse($request, $targetPath);
    }

}
