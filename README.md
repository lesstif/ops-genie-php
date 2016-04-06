# OpsGenie-PHP

PHP classes interact OpsGenie Notifier with the REST API.

# Requirements

- PHP >= 5.4
- [php JsonMapper](https://github.com/netresearch/jsonmapper)
- [phpdotenv](https://github.com/vlucas/phpdotenv)

# Installation

1. Download and Install PHP Composer.

	``` sh
	curl -sS https://getcomposer.org/installer | php
	```

2. Next, run the Composer command to install the latest version of php jira rest client.
	``` sh
	php composer.phar require lesstif/OpsGenie-php dev-master
	```
    or add the following to your composer.json file.
	```json
	{
	    "require": {
	        "lesstif/OpsGenie-php": "dev-master"
	    }
	}
	```

3. Then run Composer's install or update commands to complete installation. 

	```sh
	php composer.phar install
	```
	
4. After installing, you need to require Composer's autoloader:

	```php
	require 'vendor/autoload.php';
	```

# Configuration

copy .env.example file to .env on your project root.	
	
	API_HOST="https://api.opsgenie.com"
    API_URL="/v1/json/"
    API_TOKEN="your-token"

# Usage

## Table of Contents
- [Create Alert](#create-alert)

## Create Alert

````php
<?php
require 'vendor/autoload.php';

$req = new \Lesstif\OpsGenie\Alert\Request();

$req->user = "lesstif@gmail.com";

try {
    $oc = new OpsGenieHttpClient;

    $oc->createAlert('alert test', $req);

} catch (OpsGenieException $e) {
    $this->assertTrue(false, $e->getMessage());
}

````

# License

Apache V2 License

# Documents
* https://www.opsgenie.com/docs/dashboard/web-api
