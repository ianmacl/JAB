<?php

namespace Prodigo\Services;

use Prodigo\Services\BaseController;

class IndexGet extends BaseController
{
	public function execute()
	{
		$this->getApplication()->setBody(json_encode('OK'));
	}
}
