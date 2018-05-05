<?php


namespace calderawp\gutenbergModules\Processes;
use Symfony\Component\Process\Process as SymfonyProcess;
use Symfony\Component\Process\Exception\ProcessFailedException;

abstract class Process
{
	/**
	 * @var bool
	 */
	private $ran = false;
	/**
	 * @var string
	 */
	private $output;

	/**
	 * The command to run
	 *
	 * @return string
	 */
	abstract protected function commandLine(): string;

	/**
	 * Get output of command
	 *
	 * @return string
	 */
	public function getOutput() :string
	{
		if( ! $this->ran ){
			$this->run();
		}
		return $this->output;
	}

	/**
	 * Run command, setting output or error in output property.
	 */
	public function run()
	{
		try{
			$this->execute();
		}catch ( ProcessFailedException $e ){
			$this->output = $e->getMessage();
		}
		$this->ran = true;
		return $this;
	}

	/**
	 * Executes command
	 */
	protected function execute()
	{
		$process = new SymfonyProcess($this->commandLine());
		$process->setTimeout(15);

		$process->run();

		// executes after the command finishes
		if (!$process->isSuccessful()) {
			throw new ProcessFailedException($process);
		}

		$this->output = $process->getOutput();
	}


}