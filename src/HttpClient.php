<?php

namespace Lesstif\OpsGenie;

use Log;

class HttpClient
{
	use EnvTrait;

	public function __construct($path = null)
	{
		$this->envLoad($path);
	}

	/**
	 * performing gitlab api request
	 *
	 * @param $uri API uri
	 * @return type json response
	 */
	public function request($uri)
	{
		$client = new \GuzzleHttp\Client([
            'base_uri' => $this->host,
            'timeout'  => 10.0,
            'verify' => false,
            ]);

        $response = $client->get($this->host . $this->url . $uri, [
            'query' => [
                'private_token' => $this->gitToken,
                'per_page' => 10000
            ],
        ]);

        if ($response->getStatusCode() != 200)
        {
        	throw GitlabException("Http request failed. status code : "
        		. $response->getStatusCode() . " reason:" . $response->getReasonPhrase());
        }

        return json_decode($response->getBody());
	}

	/**
	 * performing gitlab api request
	 *
	 * @param $uri API uri
	 * @param $body body data
	 * 
	 * @return type json response
	 */
	public function send($uri, $body, $method = 'POST')
	{
		$client = new \GuzzleHttp\Client([
            'base_uri' => $this->gitHost,
            'timeout'  => 10.0,
            'verify' => false,
            ]);
		
		$postData['headers'] = ['PRIVATE-TOKEN' => $this->gitToken];

		$postData['json'] = $body;

		if ($this->debug) {
			$postData['debug'] = fopen(base_path() . '/' . 'debug.txt', 'w');
		}		

		$request = new \GuzzleHttp\Psr7\Request($method, $this->gitHost . $this->url . $uri);

		try{
			$response = $client->send($request, $postData);
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
