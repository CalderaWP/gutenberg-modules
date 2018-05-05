<?php


namespace calderawp\gutenbergModules\Commands;


use calderawp\gutenbergModules\HasApp;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{

	use HasApp;
	protected function configure()
	{
		$this
			->setDescription('Builds dist directory' );
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{

		$this
			->getApp()
			->copyFiles();
		$output->writeln('Files copied');

	}

}