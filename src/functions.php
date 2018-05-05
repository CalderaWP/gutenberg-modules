<?php
/**
 * @return \calderawp\gutenbergModules\App
 */
function gutenbergModules()
{
	static $gutenbergModules;
	if( ! $gutenbergModules ){
		$gutenbergModules = new \calderawp\gutenbergModules\App(
			dirname(__FILE__, 2)
		);
	}

	return $gutenbergModules;
}
