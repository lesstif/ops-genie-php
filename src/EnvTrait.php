<?php

namespace Lesstif\OpsGenie;

use Log;

trait EnvTrait {
	private $dotenv;

	// API HOST
	protected $host = 'https://api.opsgenie.com';

	// API URL
	protected $url = '/v1/json/';

	// API token
	protected $token;

	private $hookUrl;
	private $debug = false;
	private $verbose = false;

	public function envLoad($path = null)
	{
		if (empty($path))
			$path = base_path();

		$dotenv = \Dotenv::load($path);

        $this->host  = str_replace("\"", "", getenv('API_HOST'));
		$this->url  = str_replace("\"", "", getenv('API_URL'));
        $this->token = str_replace("\"", "", getenv('API_TOKEN'));

        $this->hookUrl = str_replace("\"", "", getenv('HOOK_URL'));

        $debug = str_replace("\"", "", getenv('APP_DEBUG'));

        if (strtolower($debug) === 'true') {
        	$this->debug = true;
        }

        $verbose = str_replace("\"", "", getenv('APP_VERBOSE'));

        if (strtolower($verbose) === 'true') {
        	$this->verbose = true;
        }
	}
 
 	public function isDebug()
 	{
 		return $this->debug;
 	}

 	public function isVerbose()
 	{
 		return $this->verbose;
 	}
}
