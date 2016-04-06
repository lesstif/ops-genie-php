<?php

use Lesstif\OpsGenie\OpsGenieException;
use Lesstif\OpsGenie\OpsGenieHttpClient;


class AlertTest extends PHPUnit_Framework_TestCase
{
    public function testCreateAlert()
    {
        //$this->markTestIncomplete();
        try {
            $oc = new OpsGenieHttpClient;

            $oc->request('alert');

        } catch (OpsGenieException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testCreateIssue()
    {
        try {
            return true;
        } catch (OpsGenieException $e) {
            $this->assertTrue(false, 'Create Failed : '.$e->getMessage());
        }
    }

}
