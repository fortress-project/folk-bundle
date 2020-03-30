<?php


namespace Fortress\Folk\Model;


abstract class AbstractUser implements UserInterface
{
	/**
	 * The username.
	 *
	 * @var string
	 */
	protected $username;

	/**
	 * The ID.
	 *
	 * @var int
	 */
	protected $id;

	/**
	 * @param string $username
	 */
	public function setUsername(string $username): void
	{
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getUsername() : string
	{
		return $this->username;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
}