<?php


namespace calderawp\gutenbergModules;

use calderawp\gutenbergModules\Commands\Build;
use calderawp\gutenbergModules\Commands\HiRoy;
use calderawp\gutenbergModules\Commands\SetupTags;
use calderawp\gutenbergModules\Processes\FindGutenbergTag;
use Symfony\Component\Console\Application;


/**
 * Class App
 *
 * The main app class, decorates Symfony's console Application object
 */
class App
{
	private $modulesMap;

	/**
	 * @var string
	 */
	private $gutenTag;


	const APP_NAME = 'gbm';
	/**
	 * @var Application
	 */
	private $application;

	/**
	 * @var string
	 */
	private $rootPath;

	public function __construct(string $rootPath)
	{
		$this->rootPath = $rootPath;
		$this->modulesMap = [
			'data' => [
				'index.js',
			],
			'components' => [
				'index.js',
				'style.css',
				'style-rtl.css'
			]
		];
	}

	public function modulesMap( array  $newMap = []) : array
	{

		if (! empty( $newMap )) {
			$this->modulesMap = array_merge($this->modulesMap, $newMap);
		}
		return $this->modulesMap;
	}
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

		$this->application->add(
			new Build(
				$this->nameCommand('build')
			)
		);

		$this->application->run();

	}


	public function getGutenbergTag(): string
	{
		if (!$this->gutenTag) {
			$this->gutenTag =
				(new FindGutenbergTag())
					->getOutput();
		}

		return $this->gutenTag;

	}

	public function rootPath(string $file = ''): string
	{
		return empty( $file )
		 	? $this->rootPath
			: $this->rootPath . "/$file";
	}

	public function copyFiles($distPath = '')
	{

		$sourcePath = $this->rootPath('gutenberg' );
		$distPath =  !empty($distPath)
			? $distPath
			: $this->rootPath('dist' );

		foreach ($this->modulesMap as $module => $moduleFiles ){
			foreach ( $moduleFiles as $file ){
				$sourceFile = sprintf('%s/%s/build/%s',
					$sourcePath,
					$module,
					$file
				);


				$distFile = $this->distFilePath($distPath, $module, $file);


				if (!copy($sourceFile, $distFile )) {
					throw new \Exception( sprintf('Could not copy %s to %s', $sourceFile, $distFile ) );
				}
			}
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

	/**
	 * @param string $distPath
	 * @param string $module
	 * @param string $file
	 * @return string
	 */
	public function distFilePath(string $distPath, string$module,string $file): string
	{
		return  sprintf('%s/%s/%s',
			$distPath,
			$module,
			$file
		);
	}

}