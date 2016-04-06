<?php

namespace Lesstif\OpsGenie;

use Monolog\Logger as Logger;
use Monolog\Handler\StreamHandler;

class HttpClient
{
	/**
	 * Monolog instance
	 *
	 * @var \Monolog\Logger
	 */
	protected $log;

	use EnvTrait;

	public function __construct($path = null)
	{
		$this->envLoad($path);

		// create logger
		$this->log = new Logger('OpsGenieClient');
		$this->log->pushHandler(new StreamHandler(
			"OpsGenieClient.txt",
				Logger::DEBUG)
		);
	}

	/**
	 * performing opsgenie api request
	 *
	 * @param $uri API uri
	 * @return type json response
	 */
	public function request($uri, $data = [])
	{
		$client = new \GuzzleHttp\Client([
            'base_uri' => $this->host,
            'timeout'  => 10.0,
            'verify' => false,
            ]);

        $response = $client->get($this->host . $this->url . $uri, [
            'query' => [
                'private_token' => $this->token,
                'per_page' => 10000
            ],
        ]);

        if ($response->getStatusCode() != 200)
        {
        	throw OpsGenieException("Http request failed. status code : "
        		. $response->getStatusCode() . " reason:" . $response->getReasonPhrase());
        }

        return json_decode($response->getBody());
	}

	/**
	 * performing opsgenie api request
	 *
	 * @param $uri API uri
	 * @param $body body data
	 * 
	 * @return type json response
	 */
	public function send($uri, $body, $method = 'POST', $extraHeader = [])
	{
		$client = new \GuzzleHttp\Client([
            'base_uri' => $this->host,
            'timeout'  => 10.0,
            'verify' => false,
            ]);

		$postData = $body;

		$postData['apiKey'] = $this->token;

		//$postData = json_encode($postData);

		if ($this->debug) {
			$this->log->addDebug("postData:", $postData);
		}

		Dumper::dump($postData);

		$request = new \GuzzleHttp\Psr7\Request($method, $this->host . $this->url . $uri);

		$response = null;
		try{
			$response = $client->send($request, [
				'json' => $postData,
			]);
		} catch (GuzzleHttp\Exception\ClientException $e) {
			dump($response);
		    echo $e->getRequest();
		    if ($e->hasResponse()) {
		        echo $e->getResponse();
		    }
		} 

        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201)
        {
        	throw new JiraIntegrationException("Http request failed. status code : "
        		. $response->getStatusCode() . " reason:" . $response->getReasonPhrase());
        }

        return json_decode($response->getBody());
	}

}
