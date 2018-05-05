<?php


namespace calderawp\gutenbergModules\Tests;
use PHPUnit\Framework\TestCase as FrameworkTestCase;


class OutputTest extends FrameworkTestCase
{


	public function tearDown()/* The :void return type declaration that should be here would cause a BC issue */
	{
		foreach (gutenbergModules()->modulesMap() as $module => $moduleFiles) {
			foreach ($moduleFiles as $file) {
				unlink(gutenbergModules()
					->distFilePath(
						$this->mockDistPath(),
						$module,
						$file
					));
			}
		}
		parent::tearDown();
	}

	public function testTests()
	{
		$this->assertTrue(true);
	}

	public function testFilesExist()
	{

		$distPath = $this->mockDistPath();
		gutenbergModules()->copyFiles($distPath);
		$modulesChecked = 0;
		$filesChecked = 0;
		$filesTotal = 0;
		foreach (gutenbergModules()->modulesMap() as $module => $moduleFiles) {
			$filesTotal += count( $moduleFiles);
			foreach ($moduleFiles as $file) {
				$this->assertTrue(
					file_exists(
						gutenbergModules()
							->distFilePath(
								$distPath,
								$module,
								$file
							)
					)
				);
				$filesChecked++;

			}
			$modulesChecked++;

		}

		$this->assertSame( count( gutenbergModules()->modulesMap() ), $modulesChecked );
		$this->assertSame( $filesTotal, $filesChecked );


	}

	/**
	 * @return string
	 */
	protected function mockDistPath(): string
	{
		return dirname(__FILE__) . '/mock-dist';
	}
}