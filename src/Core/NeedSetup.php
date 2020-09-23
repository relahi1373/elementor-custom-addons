<?php

namespace ECA\Core;

/**
 * Implement this interface when a module need setup/ configuration before using.
 *
 * @package ECA\Core
 * @since 1.0.0
 */
interface NeedSetup {

	/**
	 * Setup module.
	 *
	 * @since 1.0.0
	 * @return bool true on success.
	 */
	public static function setup();
}