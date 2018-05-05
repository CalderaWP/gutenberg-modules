<?php


namespace calderawp\gutenbergModules\Commands;


use calderawp\gutenbergModules\HasApp;
use calderawp\gutenbergModules\Processes\DeleteTag;
use calderawp\gutenbergModules\Processes\Publish;
use calderawp\gutenbergModules\Processes\TagAlreadyExists;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Build extends Command
{

	private $tag;
	use HasApp;
	protected function configure()
	{
		$this
			->setDescription('Builds dist directory' );
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$this->setUpTags();
		$this
			->getApp()
			->copyFiles();
		$output->writeln('Files copied');

		$output->writeln( (new Publish() )->getOutput() );


	}


	private function setUpTags()
	{
		$this->tag = $this
			->getApp()
			->getGutenbergTag();
		if( (new TagAlreadyExists())->getOutput() ){
			(new DeleteTag())->run();
		}

	}

}