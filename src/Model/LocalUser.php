<?php


namespace Fortress\Folk\Model;


class LocalUser extends AbstractUser implements LocalUserInterface
{

	/**
	 * User's roles
	 *
	 * @var array
	 */
	protected $roles = [];

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

	/**
	 * @inheritDoc
	 */
	public function getRoles() : array
	{
		return $this->roles;
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
}