<?php

/*
 * Generic FormField 
 */
namespace FieldTypes;
use FormHelper\Observable as Observable;
use FormHelper\Observer as Observer;

abstract class AbstractFormField extends Observable implements Observer {
    
    protected $value;
    
    protected $attributes = array();
    
    protected $rules;
    
    protected $name='';
    
    protected $indent=1;

    function __construct($name, $attributes=array()) {
        $this->name = $name;
        
        if(is_array($attributes)) {
            $this->attributes = $attributes;
        }
    }
    
    public function validate(){
        
    }
    
    public function setIndent($indent) {
        $this->indent = $indent;
        $this->setChanged();
    }
    
    public function getIndent() {
        return $this->indent;
    }
    
    public function getIndentStr() {
        return str_repeat("\t", $this->getIndent());
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function setValue($value){
        $this->value = $value;
    }
    
    public function addAttribute($attribute){
        $this->attributes = array_merge($this->attributes, $attribute);
    }
    
    public function getAttributes(){
        return $this->attributes;
    }
    
    public function getAttribute($attribute) {
        if(isset($this->attributes[$attribute])) {
            return $this->attributes[$attribute];
        }
        return false;
    }
    
    public function addRule($rule) {
        return array_push($this->rules, $rule);
    }
    
    public function getRules() {
        return $this->rules;
    }
    
    protected function toHtml($items) {
        $base = "";
        foreach($items as $k => $v) {
            $k = trim($k);
            $v = trim($v);
            $base .= "$k=\"$v\" ";
        }
        return $base;
    }
    
    public function update(Observable $observable, $args=null) {
        //update the indentation
        $this->setIndent($observable->getIndent());
        
        //check if this field is set
        if(isset($args[$this->name])) {
            $this->setValue($args[$this->name]);
        }
    }
    
    abstract public function getHtml();
    
    abstract public function isEmpty();

}
?>
