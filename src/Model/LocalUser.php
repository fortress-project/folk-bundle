<?php


namespace Fortress\Folk\Model;


use Doctrine\Common\Collections\ArrayCollection;

class LocalUser extends AbstractUser implements LocalUserInterface
{

	/**
	 * User's roles
	 *
	 * @var ArrayCollection
	 */
	protected $roles;

	/**
	 * User's password
	 *
	 * @var string
	 */
	protected $password;

	/**
	 * User's salt
	 *
	 * @var string
	 */
	protected $salt;

	public function __construct()
	{
		$this->roles = new ArrayCollection();
	}

	/**
	 * @inheritDoc
	 */
	public function getRoles() : array
	{
		return $this->roles->toArray();
	}

	/**
	 * @inheritDoc
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @inheritDoc
	 */
	function setPassword(string $password): void
	{
		$this->password = $password;
	}

	/**
	 * @inheritDoc
	 */
	public function getSalt()
	{
		return $this->salt;
	}

	/**
	 * @inheritDoc
	 */
	function setSalt(string $salt): void
	{
		$this->salt = $salt;
	}

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials()
	{

	}

	/**
	 * @inheritDoc
	 */
	function addRole(string $role): void
	{
		$this->roles->add($role);
	}

	/**
	 * @inheritDoc
	 */
	function removeRole(string $role): void
	{
		$this->roles->removeElement($role);
	}
}