<?php

namespace Prodigo\Services\Articles;

use Prodigo\Services\BaseController;
use Prodigo\Users;

class ArticleListGet extends BaseController
{
	public function execute()
	{
		$database = $this->getApplication()->getDatabase();
		
		$query = $database->getQuery(true);
		$query->select('*')
			->from('#__articles');
		$database->setQuery($query);
		$articles = $database->loadObjectList();

		$this->getApplication()->setBody(json_encode($articles));
	}
}

