<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FieldTypes;

class FieldSet extends AbstractFormField {

    private $innerFields = array();

    public function __construct($name, $attribute=array(), $innerFields=array()) {
        parent::__construct($name, $attribute);
        
        //This label houses a FormField
        if($innerFields != null) {
            $this->innerFields = $innerFields;
        }
    }

    /**
     *  Return the HTML representation of this FormField
     */
    public function getHtml() {
        $base = "<fieldset " . $this->toHtml($this->attributes) . ">";
        $base .= "\n\t<legend>" . ucfirst($this->name). "</legend>";
        
        foreach($this->innerFields as $field) {
            $base .= "\n\t" . $field->getHtml();
        }
        
        $base .= "\n</fieldset>";
        
        return $base;
    }
    
    public function getInnerFields() {
        return $this->innerFields;
    }

    /**
     *  Return false (redundant method for this field)
     */
    public function isEmpty() {
        return false;
    }

}

?>
