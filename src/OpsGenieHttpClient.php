<?php

namespace Lesstif\OpsGenie;

use Lesstif\OpsGenie\Alert\Request;
use Log;

class OpsGenieHttpClient extends HttpClient
{
	public function __construct($path = null)
	{
		parent::__construct($path);
	}

	/**
	 * fetch users list from gitlab.
	 *
	 * @return type
	 */
	public function createAlert($message, Request $request)
	{
		$json = $request->toArray();
		$json['message'] = $message;

		return $this->send('alert', $json);
	}
}
