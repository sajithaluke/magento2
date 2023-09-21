<?php
namespace Event\Error404\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Custom404Log extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_404_log', 'id');
    }
}
