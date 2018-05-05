<?php


namespace calderawp\gutenbergModules;

use calderawp\gutenbergModules\Commands\HiRoy;
use calderawp\gutenbergModules\Processes\DeleteTag;
use calderawp\gutenbergModules\Processes\FindGutenbergTag;
use calderawp\gutenbergModules\Processes\TagAlreadyExists;
use Symfony\Component\Console\Application;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class App
 *
 * The main app class, decorates Symfony's console Application object
 */
class App
{

	const APP_NAME = 'gbm';
	/**
	 * @var Application
	 */
	private $application;

	public function run()
	{

		$this->application = new Application(
			self::APP_NAME,
			'0.1.0'
		);
		$this->application->add(
			new HiRoy(
				$this->nameCommand('hi')
			)
		);


		$this->setUpTags();

		$this->application->run();

	}

	/**
	 * @var string
	 */
	private $gutenTag;

	public function setUpTags()
	{
		$this->getGutenbergTag();
		$this->prepareTag();
	}

	public function getGutenbergTag() :string
	{
		if ( ! $this->gutenTag ) {
			$this->gutenTag =
				(new FindGutenbergTag())
				->getOutput();
		}

		return $this->gutenTag;

	}

	public function prepareTag()
	{
		if( (new TagAlreadyExists())->getOutput() ){
			(new DeleteTag())->run();
		}
	}

	public function binPath(string $fileName = '' ) : string
	{
		return dirname(__FILE__,2 ) ."/bin/$fileName";

	}

	/**
	 * @param $name
	 * @return string
	 */
	protected function nameCommand($name): string
	{
		return self::APP_NAME . ":$name";
	}

}