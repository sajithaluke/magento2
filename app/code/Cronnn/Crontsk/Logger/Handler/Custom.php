<?php

namespace Cronnn\Crontsk\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;

class Custom extends Base
{
    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/custom_cron.log';
}
