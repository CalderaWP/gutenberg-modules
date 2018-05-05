<?php


namespace calderawp\gutenbergModules\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HiRoy extends Command
{
	protected function configure()
	{
		$this
			->setDescription('Says hi to someone or Roy')
			->setHelp('This command prove Josh could use this component')
		;

		$this
			->addArgument('name',
				InputArgument::OPTIONAL,
				'Who do you want to greet?',
				'Roy'
			);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$text = 'Hi '.$input->getArgument('name');
		$output->writeln($text.'!');
	}
}