<?php


namespace calderawp\gutenbergModules\Processes;


use calderawp\gutenbergModules\HasApp;

class TagAlreadyExists extends Process
{

	use HasApp;


	/** @inheritdoc */
	public function commandLine(): string
	{

		$tagToFind = $this->getApp()->getGutenbergTag();
		$path = $this
			->getApp()
			->binPath( 'tag-exists.sh' );

		return "bash $path $tagToFind";
	}
}