<?php
namespace Event\Error404\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Response\Http;
use Event\Error404\Model\Custom404Log;



class Log404 implements ObserverInterface
{
    protected $logger;
    protected $custom404Log;
    protected $response;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        Custom404Log $custom404Log, Http $response
    ) {
        $this->logger = $logger;
        $this->custom404Log = $custom404Log;
        $this->response = $response;
    }

    public function execute(Observer $observer)
    {
        if ($this->response->getHttpResponseCode() == 404) {
            // ... (existing code)

            $request = $observer->getEvent()->getData('request');
           $url = $request->getRequestString();

            // Update or insert record using the model
            $this->custom404Log->incrementHitCount($url);
        }
    }
}
    //protected $db;
    //protected $response;


//     public function __construct(
//         \Psr\Log\LoggerInterface $logger,
//         \Magento\Framework\App\ResourceConnection $resource, Http $response
        
//     ) {
//         $this->logger = $logger;
//         $this->db = $resource->getConnection();
//         $this->response = $response;

//     }

//     public function execute(Observer $observer)
//     {
//         if ($this->response->getHttpResponseCode() == 404) {

//         $request = $observer->getEvent()->getData('request');
//         $url = $request->getRequestString();
        
//         // Log 404 request
//         $this->logger->info('404 Page Not Found: ' . $url);

//         // Update or insert record in custom database table
//         $tableName = $this->db->getTableName('custom_404_log');

//         //$sql = "INSERT INTO $tableName (url, count) VALUES (?, 1) ON DUPLICATE KEY UPDATE count = count + 1";

//      //  $this->logger->info('SQL Query: ' . $sql);

//        // $this->db->query($sql, [$url]);



//        $existingRecord = $this->db->fetchRow("SELECT * FROM $tableName WHERE url = ?", [$url]);

//         if ($existingRecord) {
//             // URL already exists, increment hit count
//             $this->db->query("UPDATE $tableName SET count = count + 1 WHERE url = ?", [$url]);
//         } else {
//             // URL doesn't exist, insert a new row
//             $this->db->query("INSERT INTO $tableName (url, count) VALUES (?, 1)", [$url]);
//         }
// }

// }}



