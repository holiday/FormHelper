<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FieldTypes;

class Button extends AbstractFormField {

    
    /**
     *  Return the HTML representation of this FormField
    */
    public function getHtml() {
        return "<input type=\"button\" name=\"$this->name\" " . $this->toHtml($this->attributes) . "/>";
    }
    
    /**
     *  Return false
    */
    public function isEmpty() {
        return isset($this->value);
    }

}
?>
