<?php

/*
 * Text FormField
 */

namespace FieldTypes;
use FormHelper\Observable as Observable;
require_once 'AbstractFormField.php';

class Text extends AbstractFormField {
    
    public function __construct($name, $attributes=array()) {
        parent::__construct($name, $attributes);
        
        //default textfield value
        if(isset($attributes['value'])) {
            $this->setValue(trim($attributes['value']));
        }
    }
    
    public function getHtml() {
        $base = "<input type=\"text\" name=\"$this->name\" " . $this->toHtml($this->attributes) . "/>";
        return $base;
    }
    
    public function update(Observable $observable, $args=null) {
        parent::update($observable, $args);
        $this->attributes['value'] = $this->getValue();
    }
    
    public function isEmpty() {
        return empty($this->value);
    }
}
?>
