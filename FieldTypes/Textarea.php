<?php

namespace FieldTypes;
require_once 'AbstractFormField.php';

/*
 * Textarea form field
 */
class Textarea extends AbstractFormField {
    
    private $defaultText = '';
    
    public function __construct($name, $attributes=array(), $defaultText=''){
        parent::__construct($name, $attributes);
        $this->defaultText = $defaultText;
    }
    
    /**
     *   Return the HTML representation of this Form Field
    */
    public function getHtml() {
        return "<textarea name=\"$this->name\" " . $this->toHtml($this->attributes) . ">$this->defaultText</textarea>";
    }
    
    public function isEmpty(){
        return empty($this->value);
    }
    

}
?>
