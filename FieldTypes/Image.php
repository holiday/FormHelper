<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FieldTypes;
require_once 'AbstractFormField.php';

class Image extends AbstractFormField {

    /**
     *   Return the HTML representation of this FormField
    */
    public function getHtml() {
        return "<input type=\"image\" name=\"$this->name\" " . $this->toHtml($this->attributes) . "/>";
    }
    
    /**
     *   Return True if this field is empty, false otherwise
    */
    public function isEmpty() {
        return false;
    }

}
?>
