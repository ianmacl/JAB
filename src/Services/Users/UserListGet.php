<?php

namespace Prodigo\Services\Users;

use Prodigo\Services\BaseController;
use Prodigo\Users;

class UserListGet extends BaseController
{
	public function execute()
	{
		
		$this->getApplication()->setBody(json_encode('OK Users'));
	}
}

