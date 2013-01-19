<?php

namespace FormHelper;

class Bootstrapper {

    protected $includePath;

    public function __construct($includePath) {
        $this->includePath = $includePath;
    }

    public function setIncludePath($includePath) {
        $this->includePath = $this->convertPath($includePath);
    }

    /**
     *  Converts a path specific to the environment the framework is running in
     *  @param String path to be converted
     */
    public static function convertPath($path) {
        //convert path to current OS
        $properOsPath = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        return $properOsPath;
    }

    /**
     * Main autoloading method. Autoloading requests get made to this method.
     * @param $className String name of class
     */
    public function loadRules($className) {
        
        //build the file location path
        $class = $this->convertPath($this->includePath . DIRECTORY_SEPARATOR . $className) . '.php';
        
        if (file_exists($class)) {
            //require the file
            require $class;
            return true;
        }
        return false;
    }

    /**
     * Registers this instance on the autoload stack
     */
    public function register() {
        spl_autoload_register(array($this, 'loadRules'));
    }

    /**
     * Unregisters this instance from the autoload stack
     */
    public function unRegister() {
        spl_autoload_unregister(array($this, 'loadRules'));
    }

}

?>