<?php

namespace Lesstif\OpsGenie\Alert;

/**
 * Alert Request Class
 *
 * @package Lesstif\OpsGenie
 */
class Request implements \JsonSerializable
{
    /* @var array */
    public $teams;

    /* @var string */
    public $alias;

    /* @var string */
    public $description;

    /**
     * Optional user, group, schedule or escalation names to calculate which users will receive the notifications of the alert.
     * Recipients which are exceeding the limit are ignored.
     *
     * @var array */
    public $recipients;

    /**
     * A comma separated list of actions that can be executed.
     *
     * @var array
     */
    public $actions;

    /**
     * Field to specify source of alert. By default, it will be assigned to IP address of incoming request
     *
     * @var string
     */
    public $source;

    /**
     * A comma separated list of labels attached to the alert.
     *
     * @var string
     */
    public $tags;

    /**
     * @var string
     */
    public $details;

    /**
     * The entity the alert is related to.
     *
     * @var string
     */
    public $entity;

    /**
     * Default owner of the execution. If user is not specified, owner of account will be used.
     *
     * @var string
     */
    public $user;

    /**
     * Additional alert note
     *
     * @var string
     */
    public $note;

    public function jsonSerialize()
    {
        $vars = (get_object_vars($this));

        return $vars;
    }
}