<?php


namespace Fortress\Folk\Security;

use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{

	private $manager;
	private $userClass;
	private $fields;

	public function __construct(EntityManagerInterface $manager, $userClass, $fields)
	{
		$this->manager = $manager;
		$this->userClass = $userClass;
		$this->fields = $fields;
	}

	/**
	 * @inheritDoc
	 */
	public function loadUserByUsername(string $username)
	{
		foreach ($this->fields as $field)
		{
			if (null !== $user = $this->manager->getRepository($this->userClass)->findOneBy([$field => $username]))
			{
				return $user;
			}
		}

		throw new UsernameNotFoundException(sprintf('Username "%s" not found.', $username));
	}

	/**
	 * @inheritDoc
	 * @throws ReflectionException
	 */
	public function refreshUser(UserInterface $user)
	{
		if (!(new ReflectionClass($this->userClass))->isInstance($user))
		{
			throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
		}

		if (null !== $refreshedUser = $this->manager->getRepository($this->userClass)->findOneBy(['username' =>
				$user->getUsername()]))
		{
			return $refreshedUser;
		}

		throw new UsernameNotFoundException(sprintf('Username "%s" not found.', $user->getUsername()));
	}

	/**
	 * @inheritDoc
	 */
	public function supportsClass(string $class)
	{
		return $this->userClass === $class;
	}
}