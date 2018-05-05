<?php


namespace calderawp\gutenbergModules\Processes;



class FindGutenbergTag extends Process
{

	/** @inheritdoc */
	protected function commandLine(): string
	{
		return 'cd gutenberg && git describe --tags --abbrev=0';
	}
}