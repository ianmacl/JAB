<?php

namespace Prodigo\Services;

use Joomla\Controller\AbstractController;
use Joomla\DI\ContainerAwareInterface;
use Joomla\DI\Container;

abstract class BaseController extends AbstractController implements ContainerAwareInterface
{
	private $container;

	public function getContainer()
	{
		return $container;
	}

	public function setContainer(Container $container)
	{
		$this->container = $container;
	}
}
