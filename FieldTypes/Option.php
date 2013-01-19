<?php

/*
 * Option FormField to be used in Select FormField
 */

namespace FieldTypes;

require_once 'AbstractFormField.php';

class Option extends AbstractFormField {
    
    private $selected = false;
    
    /**
     *  Initialize a new FormField with $description, $attributes and optional
     * $selected. This Field is unique as it can only be used within a Select
     * Field. It also has no standard 'name' attribute and thus the 'name' acts
     * as the description.
     * @param type $description String
     * @param type $attributes Array
     * @param type $selected Boolean
     */
    public function __construct($description, $attributes=array(), $selected=false) {
        parent::__construct($description, $attributes);
        $this->selected = $selected;
        if($selected) {
            $this->attributes['selected'] = 'selected';
        }
    }
    
    /**
     *  Return True if Option was set as selected, False otherwise
     * @return boolean 
     */
    public function setSelected() {
        if(!$this->selected) {
            $this->attributes['selected'] = 'selected';
            $this->selected = true;
            return true;
        }
        return false;
    }
    
    /**
     *   Return True if this Option was successfully un-selected, False otherwise
     *  @return boolean
    */
    public function unSelect() {
        if($this->selected && isset($this->attributes['selected'])) {
            $this->selected = false;
            unset($this->attributes['selected']);
            return true;
        }
        return false;
    }
    
    /**
     *  Return True if this Option is selected
     * @return type 
     */
    public function isSelected() {
        return $this->selected;
    }
    
    /**
     *  Return the HTML representation of this FormField
     * @return type 
     */
    public function getHtml() {
        return "<option " . $this->toHtml($this->attributes) . ">" . $this->name . "</option>";
    }
    
    
    
    /**
     *  Return False
     * @return boolean 
     */
    public function isEmpty(){
        return isset($this->value);
    }

}
?>
