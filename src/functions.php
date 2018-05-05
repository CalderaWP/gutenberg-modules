<?php
/**
 * @return \calderawp\gutenbergModules\App
 */
function gutenbergModules()
{
	static $gutenbergModules;
	if( ! $gutenbergModules ){
		$gutenbergModules = new \calderawp\gutenbergModules\App(
			dirname(__FILE__, 2),
			//@TODO read from Gutenberg's package.json
			'2.8.0'
		);
	}

	return $gutenbergModules;
}
