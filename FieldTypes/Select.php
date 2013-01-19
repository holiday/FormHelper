<?php

/*
 * Select FormField
 */

namespace FieldTypes;

require_once 'AbstractFormField.php';
require_once 'Option.php';

use \FieldTypes\Option as Option;
use \FormHelper\Observable as Observable;

class Select extends AbstractFormField {

    protected $options = array();
    protected $currentSelected = null;

    public function __construct($name, $attributes = array(), $options=array()) {
        parent::__construct($name, $attributes);
        $this->options[] = new Option('select', array('value' => ''), true);
        $this->currentSelected = $this->options[0]; //default selected item
        
        //if there are options, add them all
        foreach ($options as $option) {
            $this->option($option->getName(), $option->getAttributes(), $option->isSelected());
        }
    }
    
    /**
     *  Factory for new Options pertaining to this Select
     * @param type $description String 
     * @param type $attributes Array
     * @param type $selected Boolean
     * @return \FieldTypes\Select
     */
    public function option($description, $attributes, $selected = false) {
        $opt = new Option(trim($description), $attributes, $selected);
        $this->options[] = $opt;
        
        if($selected) {
            $this->toggleSelected($opt);
        }
        
        return $this;
    }

    /**
     *   Return the HTML representation of this field
     */
    public function getHtml() {
        $base = PHP_EOL . $this->getIndentStr() . "<select name=\"$this->name\" " . $this->toHtml($this->attributes) . ">" . PHP_EOL;
        foreach ($this->options as $option) {
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
    
    public function update(Observable $observable, $args=null){
        parent::update($observable, $args);
        $this->updateChildren();
    }
    
    private function updateChildren(){
        foreach($this->options as $k => $option) {
            if(!$this->isEmpty() && trim($option->getAttribute('value')) == trim($this->value)) {
                $option->setSelected();
                $this->toggleSelected($option);
                return true;
            }
        }
        return false;
    }
    
    public function toggleSelected($selected) {
        //Change the currentSelected Option IFF this is not a Multi-Select
        if(isset($this->currentSelected)) {
            $this->currentSelected->unSelect();
            $this->currentSelected = $selected;
        }
    }
    
    /**
     *  Return false i.e. this is a secondary field, it is always empty and only used within a Select FormField
     * @return boolean 
     */
    public function isEmpty() {
        return !isset($this->value);
    }
}

?>
