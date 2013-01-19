<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FieldTypes;
require_once 'Radio.php';
use \FieldTypes\Radio as Radio;
use FormHelper\Observable as Observable;

class MultiRadio extends Radio {

    private $radios;
    
    public function __construct($name, $radios, $attributes=array()) {
        parent::__construct($name, $attributes);
        
        $this->radios = $radios;
        
        foreach($this->radios as $radio) {
            $radio->setName($this->getName() . '[]');
            $this->addObserver($radio);
        }
    }
    
    /**
     *  Return the HTML representation of this MultiRadio Field
     * @return string 
     */
    public function getHtml(){
        $base = "";
        foreach($this->radios as $k => $radio) {
            $this->radios[$k] = $radio;
            $base .= "\n" . $radio->getHtml();
        }
        
        return $base; 
    }
    
    public function getRadios() {
        return $this->radios;
    }
    
    public function getRadio($id) {
        if(!is_int($id)) {
            throw new \Exception('getRadio() requires that you specify an integer $id.');
        }
        return $this->radios[$id];
    }
    
    /**
     *  
     * @return boolean 
     */
    public function isEmpty(){
        return isset($this->value);
    }

}
?>
