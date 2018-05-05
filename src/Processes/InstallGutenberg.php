<?php


namespace calderawp\gutenbergModules\Processes;


class InstallGutenberg extends Process
{
	/** @inheritdoc */
	public function commandLine(): string
	{
		if (! $this->installed()) {
			return implode(' && ', [
				'git clone git@github.com:WordPress/gutenberg.git',
				'cd gutenberg',
				'npm install',
				'npm update',
				'cd ../'
			]);
		}

		return "echo Installed already";
	}

	/**
	 * Is Gutenberg installed
	 *
	 * @return bool
	 */
	private function installed() : bool
	{
		return file_exists( dirname(__FILE__) . '/gutenberg' );
	}
}