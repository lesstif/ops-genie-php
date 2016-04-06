<?php

namespace Lesstif\OpsGenie\Configuration;

/**
 * Class ArrayConfiguration
 *
 * @package JiraRestApi\Configuration
 */
class ArrayConfiguration extends AbstractConfiguration
{
    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        foreach ($configuration as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
