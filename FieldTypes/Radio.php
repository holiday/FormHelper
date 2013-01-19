<?php

/*
 * HTML Radio FormField representation
 */

namespace FieldTypes;

class Radio extends AbstractFormField {

    /**
     *  Return the HTML representation of this FormField
     */
    public function getHtml() {
        return PHP_EOL . $this->getIndentStr() . "<input type=\"radio\" name=\"$this->name\" " . $this->toHtml($this->attributes) . "/>";
    }
    
    /**
     *  Return whether this field is empty or not
     */
    public function isEmpty() {
        return isset($this->value);
    }
}
?>
