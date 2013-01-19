<?php

/*
 * File FormField
 */
namespace FieldTypes;
require_once 'AbstractFormField.php';

class File extends AbstractFormField {

    /**
     *   Return the HTML representation of this FormField
    */
    public function getHtml() {
        return "<input type=\"file\" name=\"$this->name[]\" " . $this->toHtml($this->attributes) . "/>";
    }
    
    public function isEmpty(){
        
        if (isset($this->value['error']) && $this->value['error'] == 4) {
            return true;
        }
        return false;
    }

}
?>
