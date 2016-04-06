<?php

use Lesstif\OpsGenie\OpsGenieException;
use Lesstif\OpsGenie\OpsGenieHttpClient;


class AlertTest extends PHPUnit_Framework_TestCase
{
    public function testCreateAlert()
    {
        //$this->markTestIncomplete();
        $req = new \Lesstif\OpsGenie\Alert\Request();

        $req->user = "lesstif@gmail.com";

        try {
            $oc = new OpsGenieHttpClient;

            $oc->createAlert('alert test', $req);

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
