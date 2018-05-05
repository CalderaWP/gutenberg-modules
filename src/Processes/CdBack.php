<?php


namespace calderawp\gutenbergModules\Processes;

/**
 * Class CdBack
 *
 * Used to cd out of gutenberg sub dir
 */
class CdBack extends Process
{

	/** @inheritdoc */
	protected function commandLine(): string
	{
		return 'cd ../';
	}
}