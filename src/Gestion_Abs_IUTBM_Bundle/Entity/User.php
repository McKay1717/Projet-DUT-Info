<?php

namespace Gestion_Abs_IUTBM_Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity
 */
class User implements UserInterface, EquatableInterface {
	/**
	 *
	 * @var string @ORM\Column(name="uid", type="string", length=55, nullable=false)
	 */
	private $uid;
	
	/**
	 *
	 * @var string @ORM\Column(name="ine", type="string", length=50, nullable=false)
	 */
	private $ine;
	
	/**
	 *
	 * @var string @ORM\Column(name="EtuId", type="string", length=50, nullable=false)
	 */
	private $etuid;
	
	/**
	 *
	 * @var string @ORM\Column(name="email", type="string", length=180, nullable=false)
	 */
	private $email;
	
	/**
	 *
	 * @var array @ORM\Column(name="roles", type="array", nullable=false)
	 */
	private $roles = array("ROLE_ETU");
	
	/**
	 *
	 * @var string @ORM\Column(name="cn", type="string", length=255, nullable=false)
	 */
	private $cn;
	
	/**
	 *
	 * @var string @ORM\Column(name="ufcLibelleDiplome", type="string", length=255, nullable=false)
	 */
	private $ufclibellediplome;
	
	/**
	 *
	 * @var string @ORM\Column(name="ufcLibelleEtape", type="string", length=255, nullable=false)
	 */
	private $ufclibelleetape;
	
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer")
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string
	 */
	private $password;
	
	/**
	 * Set uid
	 *
	 * @param string $uid        	
	 *
	 * @return User
	 */
	public function setUid($uid) {
		$this->uid = $uid;
		
		return $this;
	}
	
	/**
	 * Get uid
	 *
	 * @return string
	 */
	public function getUid() {
		return $this->uid;
	}
	
	/**
	 * Set ine
	 *
	 * @param string $ine        	
	 *
	 * @return User
	 */
	public function setIne($ine) {
		$this->ine = $ine;
		
		return $this;
	}
	
	/**
	 * Get ine
	 *
	 * @return string
	 */
	public function getIne() {
		return $this->ine;
	}
	
	/**
	 * Set etuid
	 *
	 * @param string $etuid        	
	 *
	 * @return User
	 */
	public function setEtuid($etuid) {
		$this->etuid = $etuid;
		
		return $this;
	}
	
	/**
	 * Get etuid
	 *
	 * @return string
	 */
	public function getEtuid() {
		return $this->etuid;
	}
	
	/**
	 * Set email
	 *
	 * @param string $email        	
	 *
	 * @return User
	 */
	public function setEmail($email) {
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Set roles
	 *
	 * @param array $roles        	
	 *
	 * @return User
	 */
	public function setRoles($roles) {
		$this->roles = $roles;
		
		return $this;
	}
	
	/**
	 * Get roles
	 *
	 * @return array
	 */
	public function getRoles() {
		return $this->roles;
	}
	
	/**
	 * Set cn
	 *
	 * @param string $cn        	
	 *
	 * @return User
	 */
	public function setCn($cn) {
		$this->cn = $cn;
		
		return $this;
	}
	
	/**
	 * Get cn
	 *
	 * @return string
	 */
	public function getCn() {
		return $this->cn;
	}
	
	/**
	 * Set ufclibellediplome
	 *
	 * @param string $ufclibellediplome        	
	 *
	 * @return User
	 */
	public function setUfclibellediplome($ufclibellediplome) {
		$this->ufclibellediplome = $ufclibellediplome;
		
		return $this;
	}
	
	/**
	 * Get ufclibellediplome
	 *
	 * @return string
	 */
	public function getUfclibellediplome() {
		return $this->ufclibellediplome;
	}
	
	/**
	 * Set ufclibelleetape
	 *
	 * @param string $ufclibelleetape        	
	 *
	 * @return User
	 */
	public function setUfclibelleetape($ufclibelleetape) {
		$this->ufclibelleetape = $ufclibelleetape;
		
		return $this;
	}
	
	/**
	 * Get ufclibelleetape
	 *
	 * @return string
	 */
	public function getUfclibelleetape() {
		return $this->ufclibelleetape;
	}
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
	 */
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
	 */
	public function getSalt() {
		// TODO: Auto-generated method stub
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
	 */
	public function getUsername() {
		return $this->uid;
	}
	
	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
	 */
	public function eraseCredentials() {
		$this->setPassword(null);
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\EquatableInterface::isEqualTo()
	 */
	public function isEqualTo(UserInterface $user) {
		return $this->uid == $user->getUsername();

	}

}
