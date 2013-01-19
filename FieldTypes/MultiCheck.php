<?php

/*
 * Checkbox FormField
 */

namespace FieldTypes;
require_once 'AbstractFormField.php';
require_once 'Check.php';
use \FieldTypes\Check as Check;

class MultiCheck extends AbstractFormField {
    
    private $checkboxes = array();
    
    public function __construct($name, $attributes=array(), $checkboxes=array()) {

        parent::__construct($name, $attributes);
        
        //invoke check() to add each checkbox to the MultiCheck
        foreach($checkboxes as $checkbox) {
            $this->check($checkbox);
        } 
    }
    
    public function getHtml() {
        $base = "";
        foreach($this->checkboxes as $checkbox) {
            $base .= $checkbox->getHtml() . "\n";
        }
        return $base;
    }
    
    /**
     *  Return all checkboxes
     * @return type 
     */
    public function getCheckBoxes($id=null) {

        return $this->checkboxes;
    }
    
    public function getCheckBox($id=null){
        
        if(is_int($id) && $id >= 0 && isset($this->checkboxes[$id])) {
            return $this->checkboxes[$id];
        }
        return false;
    }
    
    public function check(Check $check) {
        $check->setName($this->name . '[]');
        $this->checkboxes[] = $check;
        return $this;
    }
    
    public function isEmpty(){
        return $this->value == null;
    }

}
?>