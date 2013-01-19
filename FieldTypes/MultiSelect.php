<?php

/*
 * Select FormField
 */

namespace FieldTypes;
require_once 'Select.php';
require_once 'Option.php';
use \FieldTypes\Option as Option;
use \FieldTypes\Select as Select;

class MultiSelect extends Select {
    
    protected $options = array();


    /**
     *  Factory for new Options pertaining to this Select
     * @param type $description String 
     * @param type $attributes Array
     * @param type $selected Boolean
     * @return \FieldTypes\Select
     */
    public function option($description, $attributes, $selected=false) {
        $opt = new Option(trim($description), $attributes, $selected);
        $this->options[] = $opt;
        
        //Change the currentSelected Option IFF this is not a Multi-Select
        if($selected && $this->currentSelected != null) {
            $this->currentSelected->unSelect();
            $this->currentSelected = null;
        }else if($selected) {
            $opt->setSelected();
        }
        return $this;
    }
    
    /**
     *   Return the HTML representation of this field
    */
    public function getHtml() {
        $base = PHP_EOL . $this->getIndentStr() . "<select name=\"$this->name\" multiple=\"multiple\" " . $this->toHtml($this->attributes) . ">" . PHP_EOL;
        foreach($this->options as $option) {
            $base .= str_repeat("\t", $this->getIndent() + 1) . $option->getHtml() . PHP_EOL;
        }
        $base .= $this->getIndentStr() . "</select>" . PHP_EOL;
        return $base;
    }
    
    /**
     *  Return the array of Options
     * @return type Array
     */
    public function getOptions() {
        return $this->options;
    }
       
    /**
     *  Return false i.e. this is a secondary field, it is always empty and only used within a Select FormField
     * @return boolean 
     */
    public function isEmpty() {
        return (!isset($this->value) || $this->value == '');
    }

}

?>
