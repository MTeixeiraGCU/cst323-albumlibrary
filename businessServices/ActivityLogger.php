<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ActivityLogger extends AbstractActivityLogger {
    
    public function before($object, $method, $args) {
        $this->logger->info("Attempt to call: " . get_class($object)  . " method: ". $method . "\n");
    }
    
    public function around($object, $method, $args) {
        $this->logger->info("Running: " . get_class($object)  . " method: ". $method . "\n");
        $value = $this->callMethod($method, $args);
        return $value;
    }
    
    public function after($object, $method, $args) {
        $this->logger->info("Exiting: " . get_class($object)  . " method: ". $method . "\n");
    }
    
    public static function info($message) {
        $logger = new Logger('activity_logger');
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $logger->info($message . "\n");
    }
    
    public static function error($message) {
        $logger = new Logger('activity_logger');
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::ERROR));
        $logger->error($message . "\n");
    }
    
    public static function warning($message) {
        $logger = new Logger('activity_logger');
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
        $logger->warning($message . "\n");
    }
}
