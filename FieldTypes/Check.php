<?php

/*
 * Checkbox FormField
 */

namespace FieldTypes;
use \FormHelper\Observable as Observable;

require_once 'AbstractFormField.php';

class Check extends AbstractFormField {
    
    public function getHtml() {
        return "<input type=\"checkbox\" name='$this->name' " . $this->toHtml($this->attributes) . "/>";
    }
    
    public function setChecked() {
        $this->attributes['checked'] = 'checked';
    }
    
    public function update(Observable $observable, $args=null) {
        parent::update($observable, $args);
        
        if(!$this->isEmpty()) {
            $this->setChecked();
        }
    }
    
    public function isEmpty(){
        return $this->value == null;
    }

}
?>