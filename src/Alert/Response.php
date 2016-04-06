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
        $vars = array_filter(get_object_vars($this));

		return $vars;
    }
}
