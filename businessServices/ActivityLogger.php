<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * ActivityLogger.php
 * This class enables loggin to either the console or stderr channel. It can be implemented as an interceptor or used from its static methods.
 *
 */
class ActivityLogger extends AbstractActivityLogger {
    
    /**
     * This mehtod activates before a log before the given obejct method is called
     * @param unknown $object
     * @param unknown $method
     * @param unknown $args
     */
    public function before($object, $method, $args) {
        $this->logger->info("Attempt to call: " . get_class($object)  . " method: ". $method . "\n");
    }
    
    /**
     * This method activates log entries during the given obejcts method call 
     * @param unknown $object
     * @param unknown $method
     * @param unknown $args
     * @return unknown
     */
    public function around($object, $method, $args) {
        $this->logger->info("Running: " . get_class($object)  . " method: ". $method . "\n");
        $value = $this->callMethod($method, $args);
        return $value;
    }
    
    /**
     * This method activates a log entry after the given object method is called
     * @param unknown $object
     * @param unknown $method
     * @param unknown $args
     */
    public function after($object, $method, $args) {
        $this->logger->info("Exiting: " . get_class($object)  . " method: ". $method . "\n");
    }
    
    /**
     * This is a static method for sending information to the logs
     * @param unknown $message
     */
    public static function info($message) {
        $logger = new Logger('activity_logger');
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $logger->info($message . "\n");
    }
    
    /**
     * This is a static method for sending error messages to the logs
     * @param unknown $message
     */
    public static function error($message) {
        $logger = new Logger('activity_logger');
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::ERROR));
        $logger->error($message . "\n");
    }
    
    /**
     * This is a static method for sending warnings to the logs
     * @param unknown $message
     */
    public static function warning($message) {
        $logger = new Logger('activity_logger');
        $logger->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
        $logger->warning($message . "\n");
    }
}
