<?php
namespace MASCOTCOREAMISO\Lib;

/**
 * interface Mascot_Core_Amiso_Interface_PostType
 * @package MASCOTCOREAMISO\Lib;
 */
interface Mascot_Core_Amiso_Interface_PostType {
	/**
	 * Returns PT Key
	 * @return string
	 */
	public function getPTKey();

	/**
	 * It registers custom post type
	 */
	public function register();
}