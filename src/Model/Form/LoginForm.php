<?php


namespace Fortress\Folk\Model\Form;


class LoginForm
{
	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var bool
	 */
	private $rememberMe;

	/**
	 * @var string
	 */
	private $csrfToken;

	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

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
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	/**
	 * @return bool
	 */
	public function isRememberMe(): bool
	{
		return $this->rememberMe;
	}

	/**
	 * @param bool $rememberMe
	 */
	public function setRememberMe(bool $rememberMe): void
	{
		$this->rememberMe = $rememberMe;
	}

	/**
	 * @return string
	 */
	public function getCsrfToken(): string
	{
		return $this->csrfToken;
	}

	/**
	 * @param string $csrfToken
	 */
	public function setCsrfToken(string $csrfToken): void
	{
		$this->csrfToken = $csrfToken;
	}
}