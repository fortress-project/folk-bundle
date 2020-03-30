<?php


namespace Fortress\Folk\Model;


interface LocalUserInterface extends UserInterface
{
	/**
	 * Sets the user's password.
	 *
	 * @param string $password
	 */
	function setPassword(string $password) : void ;

	/**
	 * Sets the user's salt.
	 *
	 * @param string $salt
	 */
	function setSalt(string $salt) : void ;
}