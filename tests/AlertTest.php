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
        $req->teams = ['ops_team',];

        try {
            $oc = new OpsGenieHttpClient;

            $oc->createAlert('Wake up. Web Server 123 is down', $req);

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
