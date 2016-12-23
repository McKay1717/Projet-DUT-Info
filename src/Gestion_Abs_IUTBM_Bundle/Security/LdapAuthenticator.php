<?php

namespace Gestion_Abs_IUTBM_Bundle\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\InMemoryUserProvider;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Ldap\LdapClient;
use Gestion_Abs_IUTBM_Bundle\Entity\User;

class LdapAuthenticator extends AbstractGuardAuthenticator {
	
	/**
	 *
	 * @var \Symfony\Component\Routing\RouterInterface
	 */
	private $router;
	
	/**
	 * Default message for authentication failure.
	 *
	 * @var string
	 */
	private $failMessage = 'Invalid credentials';
	
	/**
	 *
	 * @var Doctrine\ORM\EntityManager
	 */
	private $em;
	public function __construct(EntityManager $entityManager, RouterInterface $router) {
		$this->em = $entityManager;
		$this->router = $router;
	}
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getCredentials(Request $request) {
		if ($request->getPathInfo () != '/login' || ! $request->isMethod ( 'POST' )) {
			return;
		}
		
		return array (
				'username' => $request->request->get ( 'username' ),
				'password' => $request->request->get ( 'password' ) 
		);
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function getUser($credentials, UserProviderInterface $userProvider) {
		$ldap = new LdapClient ( '127.0.0.1', 9999, 3, false, false );
		try {
			return $userProvider->loadUserByUsername ( $credentials ['username'] );
		} catch ( UsernameNotFoundException $e ) {
			
			try {
				$ldap->bind ( "uid=" . $credentials ['username'] . ",ou=people,dc=univ-fcomte,dc=fr", $credentials ['password'] );
			} catch ( ConnectionException $e ) {
				throw new CustomUserMessageAuthenticationException ( $this->failMessage );
			}
			$query = $ldap->find ( "uid=" . $credentials ['username'] . ",ou=people,dc=univ-fcomte,dc=fr", '(&(objectclass=*))' ) [0];
			if (count ( $query ) <= 0)
				return;
			$user = new User ();
			$user->setEmail ( $query ["mail"] [0] );
			$user->setCn ( $query ["cn"] [0] );
			$user->setEtuid ( $query ['supannetuid'] [0] );
			$user->setIne ( $query ['supanncodeine'] [0] );
			$user->setUfclibellediplome ( $query ['ufclibellediplome'] [0] );
			$user->setUfclibelleetape ( $query ['ufclibelleetape'] [0] );
			$user->setPassword ( $credentials ['password'] );
			$user->setUid ( $credentials ['username'] );
			$this->em->persist ( $user );
			$this->em->flush ( $user );
			return $user;
		}
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function checkCredentials($credentials, UserInterface $user) {
		$ldap = new LdapClient ( '127.0.0.1', 9999, 3, false, false );
		try {
			$ldap->bind ( "uid=" . $credentials ['username'] . ",ou=people,dc=univ-fcomte,dc=fr", $credentials ['password'] );
		} catch ( ConnectionException $e ) {
			throw new CustomUserMessageAuthenticationException ( $this->failMessage );
		}
		//Check if one user
		$user = $this->em->getRepository ( 'Gestion_Abs_IUTBM_Bundle:User' )->findByUid ( $user->getUsername () )[0];
		$query = $ldap->find ( "uid=" . $credentials ['username'] . ",ou=people,dc=univ-fcomte,dc=fr", '(&(objectclass=*))' ) [0];
		if (count ( $query ) <= 0)
			return;
		$user->setEmail ( $query ["mail"] [0] );
		$user->setCn ( $query ["cn"] [0] );
		$user->setEtuid ( $query ['supannetuid'] [0] );
		$user->setIne ( $query ['supanncodeine'] [0] );
		$user->setUfclibellediplome ( $query ['ufclibellediplome'] [0] );
		$user->setUfclibelleetape ( $query ['ufclibelleetape'] [0] );
		$user->setPassword ( $credentials ['password'] );
		$this->em->flush ( $user );
		return true;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
		$url = $this->router->generate ( '/' );
		return new RedirectResponse ( $url );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
		$request->getSession ()->set ( Security::AUTHENTICATION_ERROR, $exception );
		$url = $this->router->generate ( 'login' );
		return new RedirectResponse ( $url );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function start(Request $request, AuthenticationException $authException = null) {
		$url = $this->router->generate ( 'login' );
		return new RedirectResponse ( $url );
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	public function supportsRememberMe() {
		return false;
	}
}