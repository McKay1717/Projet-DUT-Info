<?php 
namespace Gestion_Abs_IUTBM_Bundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;
use Symfony\Component\Ldap\LdapClient;
use Gestion_Abs_IUTBM_Bundle\Entity\User;

class LdapAuthenticator implements SimpleFormAuthenticatorInterface
{
	private $encoder;

	public function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}

	public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
	{
		try {
			$user = new User($token->getUsername());
		} catch (UsernameNotFoundException $e) {
			// CAUTION: this message will be returned to the client
			// (so don't put any un-trusted messages / error strings here)
			throw new CustomUserMessageAuthenticationException('Invalid username or password');
		}
		$ldap = new LdapClient('127.0.0.1', 9999, 3, false, false);
		try {
			$ldap->bind("uid=".$token->getUsername().",ou=people,dc=univ-fcomte,dc=fr", $token->getCredentials());
			
		} catch (Exception $e) {
			throw new CustomUserMessageAuthenticationException('LDAP');
		}
		
		$passwordValid = true;
		

		if ($passwordValid) {
			

			return new UsernamePasswordToken(
					$user,
					$user->getPassword(),
					$providerKey,
					array($user->getRoles())
					);
		}

		// CAUTION: this message will be returned to the client
		// (so don't put any un-trusted messages / error strings here)
		throw new CustomUserMessageAuthenticationException('Invalid username or password');
	}

	public function supportsToken(TokenInterface $token, $providerKey)
	{
		return $token instanceof UsernamePasswordToken
		&& $token->getProviderKey() === $providerKey;
	}

	public function createToken(Request $request, $username, $password, $providerKey)
	{
		return new UsernamePasswordToken($username, $password, $providerKey);
	}
}