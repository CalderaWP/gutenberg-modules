<?php


namespace calderawp\gutenbergModules;


trait HasApp
{

	/**
	 * @return App
	 */
	public function getApp()
	{
		return gutenbergModules();
	}
}