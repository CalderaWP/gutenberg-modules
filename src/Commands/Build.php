<?php


namespace calderawp\gutenbergModules\Commands;


use calderawp\gutenbergModules\HasApp;
use calderawp\gutenbergModules\Processes\DeleteTag;
use calderawp\gutenbergModules\Processes\MaybeInstallGutenberg;
use calderawp\gutenbergModules\Processes\Publish;
use calderawp\gutenbergModules\Processes\TagAlreadyExists;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{

	use HasApp;

	/** @inheritdoc */
	protected function configure()
	{
		$this
			->setDescription('Builds dist directory' );

		$this
			->addArgument('publish',
				InputArgument::OPTIONAL,
				'If true, the default, results are pushed to Github and NPM',
				true
			);
	}

	/** @inheritdoc */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		//Install and build Gutenberg
		(new MaybeInstallGutenberg() )->run();

		//Delete tag in this repo, if it exists already
		if( (new TagAlreadyExists())->getOutput() ){
			(new DeleteTag())->run();
		}

		//Copy files
		$this
			->getApp()
			->copyFiles();
		$output->writeln('Files copied');


		if( true == (bool) $input->getArgument('publish' ) ){
			var_dump((bool)$input->getArgument('publish' ));exit;
			//Publish
			$output->writeln(
				(new Publish() )->getOutput()
			);
		}

		$output->writeln('Completed');


	}

}