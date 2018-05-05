<?php


namespace calderawp\gutenbergModules\Commands;
use calderawp\gutenbergModules\HasApp;
use calderawp\gutenbergModules\Processes\DeleteTag;
use calderawp\gutenbergModules\Processes\TagAlreadyExists;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupTags extends Command
{

	use HasApp;
	protected function configure()
	{
		$this
			->setDescription('Finds the Gutenberg Tag and deletes the tag if it already exists in this repo')
		;
		
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{

		$this
			->getApp()
			->getGutenbergTag();
		if( (new TagAlreadyExists())->getOutput() ){
			(new DeleteTag())->run();
		}

		$tag = $this
			->getApp()
			->getGutenbergTag();
		$output->writeln($tag.'!');

	}
	
}