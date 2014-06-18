<?php

namespace Prodigo;

use Joomla\Application\AbstractWebApplication;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
use Joomla\Router\RestRouter;
use Joomla\DI\Container;
use Joomla\DI\ContainerAwareInterface;
use Joomla\Database\DatabaseFactory;

// Bootstrap the autoloader (adjust path as appropriate to your situation).
require_once __DIR__ . '/../vendor/autoload.php';

class ProdigoApplication extends AbstractWebApplication
{
	private $router;

	private $container;

	private $database;

    /**
     * Method to run the application routines.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function doExecute()
    {
        try
		{
			$controller = $this->router->getController($this->get('uri.route'));
			$controller->setApplication($this);
			$controller->execute();
        }
        catch(\Exception $e)
        {
            // Set status header of exception code and response body of exception message
            $this->setHeader('status', $e->getCode() ?: 500);
            $this->setBody($e->getMessage());
        }
	}

	protected function initialise()
	{
		$this->loadRoutes();
		$this->loadConfig();
		$this->loadDatabase();
	}

	public function getDatabase()
	{
		return $this->database;
	}


	private function loadRoutes()
	{
		$router = new RestRouter($this->input);
		$router->setControllerPrefix('\\Prodigo\\Services\\');

		$router->addMap('/api/users', 'Users\\UserList');
		$router->addMap('/api/users/:user_id', 'Users\\User');
		$router->addMap('/api/articles', 'Articles\\ArticleList');
		//$router->addMap('')
		$router->addMap('/api/', 'Index');

		$this->router = $router;
	}

	private function loadConfig()
	{
		$configDir = dirname(__DIR__) . '/etc/';
		if (file_exists($configDir . 'config.json'))
		{
			$config = json_decode(file_get_contents($configDir . 'config.json'));
		}
		elseif (file_exists($configDir . 'config.json.dist'))
		{
			$config = json_decode(file_get_contents($configDir . 'config.json.dist'));
		}

		$this->config->loadObject($config);
	}

	private function loadDatabase()
	{
        // Make the database driver.
        $dbFactory = new DatabaseFactory;

        $this->database = $dbFactory->getDriver(
            $this->get('database.driver'),
            array(
                'host' => $this->get('database.host'),
                'user' => $this->get('database.user'),
                'password' => $this->get('database.password'),
                'port' => $this->get('database.port'),
                'socket' => $this->get('database.socket'),
                'database' => $this->get('database.name'),
            )
		);

		$this->database->select('articles');
	}

	private function loadContainer()
	{
		$container = new Container;

		$this->container = $container;

		$container->set('database', $this->database);
		$container->set('application', $this);
		$container->set('config', $this->config);
	}
}

$app = new ProdigoApplication;
$app->execute();

