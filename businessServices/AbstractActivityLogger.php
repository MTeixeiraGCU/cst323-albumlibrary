<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/autoloader.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * AbstractActivityLogger.php
 * This class is abstract. It is designed to use a logger API to create log entries for all of the classes and methods in a project
 *
 */
class AbstractActivityLogger {
    
    public $_object;
    public $_rootObject;
    
    public $logger;
    
    /**
     * constructor method for creating the intercepting logger. 
     * @param unknown $object
     */
    public function __construct($object) {
        $this->_object = $object;
        
        if (is_a($object, "ActivityLogger")){
            $this->_rootObject = $object->_rootObject;
        } else {
            $this->_rootObject = $object;
        }
        $object->intercepted = $this;
        
        //add in MonoLog support
        $this->logger = new Logger('activity_logger');
        $this->logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
        $this->logger->info("created intercepter for " . get_class($object) . "\n");
    }
    
    //interceptor methods
    public function callMethod($method, $args){
        return call_user_func_array(array($this->_object, $method), $args);
    }
    
    public function __isset($name) {
        return isset($this->_rootObject->$name);
    }
    
    public function __unset($name) {
        unset($this->_rootObject->$name);
    }
    
    public function __set($name, $value) {
        $this->_rootObject->$name = $value;
    }
    
    public function __get($name) {
        return $this->_rootObject->$name;
    }
    
    /**
     * This method will call all the necessary logging methods through a single method call process
     * @param unknown $method
     * @param unknown $args
     * @return unknown
     */
    public function __call($method, $args) {
        if ($method[0] == "_") {
            $method = substr($method, 1);
        }
        //call any before methods that exist
        if (method_exists($this, "before")){
            $this->before($this->_rootObject, $method, $args);
        }
        //call any around methods that exist
        if (method_exists($this, "around")) {
            $value = $this->around($this->_rootObject, $method, $args);
        } else {
            $value = $this->callMethod($method, $args);
        }
        //call any after methods that exist
        if (method_exists($this, "after")) {
            $this->after($this->_rootObject, $method, $args);
        }
                            
        return $value;
    }
}