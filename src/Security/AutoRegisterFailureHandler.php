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
use Symfony\Component\Security\Http\HttpUtils;
use Trismegiste\OAuthBundle\Oauth\ThirdPartyAuthentication;
use Trismegiste\OAuthBundle\Security\Token;
use Trismegiste\PortalBundle\Model\User;
use Trismegiste\Yuurei\Persistence\RepositoryInterface;

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

    /** @var RepositoryInterface */
    protected $repository;

    /** @var SecurityContextInterface */
    protected $security;

    public function __construct(HttpUtils $httpUtils, LoggerInterface $logger, RepositoryInterface $repo, SecurityContextInterface $secu)
    {
        $this->security = $secu;
        $this->httpUtils = $httpUtils;
        $this->logger = $logger;
        $this->failureDefault = 'trismegiste_oauth_connect';
        $this->repository = $repo;
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

            // create new user and persist
            $newToken = new Token($token->getFirewallName(), $token->getProviderKey(), $token->getUserUniqueIdentifier(), ['ROLE_USER']);
            $user = new User();
            $user->uid = $token->getUserUniqueIdentifier();
            $user->provider = $token->getProviderKey();
            $user->nickname = $token->getAttribute('nickname');
            $this->repository->persist($user);
            $newToken->setUser($user);
            $this->security->setToken($newToken);

            $targetPath = 'front_index';
        } else {
            $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);
        }

        return $this->httpUtils->createRedirectResponse($request, $targetPath);
    }

}
