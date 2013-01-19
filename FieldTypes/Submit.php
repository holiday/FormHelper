<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace FieldTypes;


class Submit extends AbstractFormField {
    
    /**
     *   Return the HTML representation of this FormField
    */
    public function getHtml() {
        return "<input type=\"submit\" name=\"$this->name\" " . $this->toHtml($this->attributes) . "/>";
    }

    public function isEmpty(){
        return isset($this->value);
    }

}
?>
