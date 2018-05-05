<?php


namespace calderawp\gutenbergModules\Processes;


use calderawp\gutenbergModules\HasApp;

class Publish extends Process
{
	use HasApp;
	
	/** @inheritdoc */
	public function commandLine(): string
	{

			$tag = gutenbergModules()->getGutenbergTag();
			return $this->commandFromArray( [
				'git fetch --tags',
				'git add .',
				"git commit -m \"$tag\" ",
				"git tag \"$tag\" ",
				"git push origin master",
				"git push --tags"
			]);


	}
}