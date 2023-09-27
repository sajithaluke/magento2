<?php
namespace Event\Error404\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\ResourceConnection;

class Custom404Log extends AbstractModel
{
    protected $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    protected function _construct()
    {
        $this->_init('Event\Error404\Model\ResourceModel\Custom404Log');
    }

    public function incrementHitCount($url)
    {
        $tableName = $this->resource->getTableName('custom_404_log');
        $connection = $this->resource->getConnection();

        $existingRecord = $connection->fetchRow("SELECT * FROM $tableName WHERE url = ?", [$url]);

        if ($existingRecord) {
            // URL already exists, increment hit count
            $connection->query("UPDATE $tableName SET count = count + 1 WHERE url = ?", [$url]);
            $hitCount = $existingRecord['count'] + 1; // Increment the count

        } else {
            // URL doesn't exist, insert a new row
            $connection->query("INSERT INTO $tableName (url, count) VALUES (?, 1)", [$url]);
            $hitCount = 1; // Set hit count to 1 for new URL

        }
        return ['url' => $url, 'count' => $hitCount];

        
    }
}
