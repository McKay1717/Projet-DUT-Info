<?php

namespace Gestion_Abs_IUTBM_Bundle\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Gestion_Abs_IUTBM_Bundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class LdapProviderInterface implements UserProviderInterface
{
	public function loadUserByUsername($username)
	{
		return new User($username);
	}
	public function refreshUser(UserInterface $user)
	{
		return $this->loadUserByUsername($user->getUid());
	}
	
	public function supportsClass($class)
	{
		return $class === 'Gestion_Abs_IUTBM_Bundle\Entity\User';
	}
}