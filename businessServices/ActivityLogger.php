<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ActivityLogger extends AbstractActivityLogger {
    
    public function before($object, $method, $args) {
        $this->logger->info("Attempt to call: " . get_class($object)  . " method: ". $method . "\n");
        $value = $this->callMethod($method, $args);
        return $value;
    }
    
    public function around($object, $method, $args) {
        $this->logger->info("Running: " . get_class($object)  . " method: ". $method . "\n");
        $value = $this->callMethod($method, $args);
        return $value;
    }
    
    public function after($object, $method, $args) {
        $this->logger->info("Exiting: " . get_class($object)  . " method: ". $method . "\n");
        $value = $this->callMethod($method, $args);
        return $value;
    }
    
    public static function error($message) {
        $this->logger = new Logger('activity_logger');
        $this->logger->pushHandler(new StreamHandler('php://stderr', Logger::ERROR));
        $this->logger->error($message . "\n");
    }
    
    public static function warning($message) {
        $this->logger = new Logger('activity_logger');
        $this->logger->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
        $this->logger->warning($message . "\n");
    }
}
