<?php


namespace Fortress\Folk\Model;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
	/**
	 * Returns the user unique identifier.
	 *
	 * @return int the ID
	 */
	function getId() : int ;

	/**
	 * Sets the user's username.
	 *
	 * @param string $username the new username
	 */
	function setUsername(string $username) : void ;

	/**
	 * Adds a role to the user.
	 *
	 * @param string $role the role
	 */
	function addRole(string $role) : void ;

	/**
	 * Removes a role to the user.
	 *
	 * @param string $role the role
	 */
	function removeRole(string $role) : void ;
}