<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ActivityLogger extends AbstractActivityLogger {
    
    public function around($object, $method, $args) {
        $this->logger->info("Running: " . get_class($object)  . " method: ". $method . "\n");
        $value = $this->callMethod($method, $args);
        return $value;
    }
    
    public static function error($message) {
        $this->logger->error("Error: " . $message . "\n");
    }
}
