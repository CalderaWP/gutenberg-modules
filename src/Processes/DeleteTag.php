<?php


namespace calderawp\gutenbergModules\Processes;


use calderawp\gutenbergModules\HasApp;

class DeleteTag extends Process
{

	use HasApp;
	/** @inheritdoc */
	protected function commandLine(): string
	{
		$tagToDelete = $this->getApp()->getGutenbergTag();
		return "cd gutenberg && git tag --delete $tagToDelete && git push --delete origin $tagToDelete";
	}
}