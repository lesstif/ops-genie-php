<?php

namespace Lesstif\OpsGenie\Alert;

class Alert implements \JsonSerializable
{
    /* @var string */
    public $message;

    /* @var string */
    public $alertId;

    /* @var string */
    public $status;

    /* @var string */
    public $code;

    public function jsonSerialize()
    {
        $vars = (get_object_vars($this));

		return $vars;
    }
}
