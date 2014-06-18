<?php

namespace Prodigo\Services\Articles;

use Prodigo\Services\BaseController;
use Joomla\Date\Date;

class ArticleListCreate extends BaseController
{
	public function execute()
	{
		$input = $this->getInput()->json;

		$article = (object) $input->getArray(
			array(
				'title' => 'string',
				'body' => 'string'
			)
		);

		$date = new Date;
		$article->created_date = $date->toRFC822();

		$database = $this->getApplication()->getDatabase();

		$database->insertObject('#__articles', $article, 'article_id');

		$this->getApplication()->setBody(json_encode($article));
	}
}
