<?php

/*
 * Password FormField
 */

namespace FieldTypes;

require_once 'AbstractFormField.php';

class Password extends AbstractFormField {
    
    public function getHtml() {
        return "<input type=\"password\" name=\"$this->name\" " . $this->toHtml($this->attributes) . "/>";
    }
    
    public function isEmpty() {
        return empty($this->value);
    }
    
    

}
?>
