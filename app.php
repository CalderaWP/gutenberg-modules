<?php

require __DIR__.'/vendor/autoload.php';

gutenbergModules()->run();

function gutenbergModules()
{
	static $gutenbergModules;
	if( ! $gutenbergModules ){
		$gutenbergModules = new \calderawp\gutenbergModules\App();
	}

	return $gutenbergModules;
}
