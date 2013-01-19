<?php

namespace FormHelper;

//Notice: Do not modify the order if these required files
require_once 'Bootstrapper.php';
require_once 'Observable.php';
require_once 'Observer.php';
require_once 'ObservableForm.php';
require_once 'FieldTypes/AbstractFormField.php';
use \FieldTypes\AbstractFormField as AbstractFormField;

class Form extends AbstractFormField implements ObservableForm {
    
    protected $name = '';
    
    protected $fields = array();
    
    protected $attributes = array();
    
    protected $indent = 1;
    
    protected $data= array(); //houses the data after a form submission
    
    function __construct($name, $attributes=array(), $indent=1) {
        // Initialize the bootstrapper
        $bootstrap = new Bootstrapper(dirname(__FILE__));
        $bootstrap->register();
        
        //initialize basic form variables 
        $this->name = $name;
        $this->attributes = $attributes;
        $this->indent = $indent;
    }
    
    public function setData($data) {
        if(is_array($data)) {
            $this->data = $data;
            $this->setChanged($this->data);
            return $this;
        }
        throw new \Exception('Invalid data supplied to Form->setData(), must be an array.');
    }
    
    public function getData() {
        return $this->data;
    }
    
    /**
     *  Return the integer number of indentation for this form
     */
    public function getIndent() {
        return $this->indent;
    }
    
    public function addField(AbstractFormField $field) {
        $this->addObserver($field);
        $field->setIndent($this->getIndent());
        $this->fields[] = $field;
        return $this;
    }
    
    /**
     *  Return the open Html Form tag with its attributes
     */
    public function open() {
        return $base =  "<form name=\"$this->name\" " . $this->toHtml($this->attributes) . ">";
    }
    
    /**
     *  Return the closing HTML Form tag
     */
    public function close() {
        return "</form>";
    }
    
    /**
     *  Return the FormField determined by $name
     * @param type $name String
     * @return boolean
     */
    public function getField($name) {
        foreach($this->fields as $field) {
            if ($field->getName() == trim($name)) {
                return $field;
            }
        }
        return false;
    }
    
    /**
     *   Return the HTML representation of this FormField
     */
    public function getHtml() {
        $base =  $this->open();
        foreach($this->fields as $field) {
            $base .= "\n" . $field->getHtml();
        }
        $base .= "\n" . $this->close();
        return $base;
    }
    
    public function getForm() {
        return $this->fields;
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
    
    /**
     *  Return True if this form contains no FormFields, false otherwise
    */
    public function isEmpty() {
        return empty($this->fields);
    }
    
    /**
     *   
    */
    public static function button($name, $attributes=array()) {
        return new \FieldTypes\Button($name, $attributes);
    }
    
    /**
     *   
    */
    public static function checkbox($param) {
        
    }
    
    /**
     *   
    */
    public static function file($name, $attributes=array()) {
        return new \FieldTypes\File($name, $attributes);
    }
    
    /**
     *   
    */
    public static function hidden($param) {
        
    }
    
    /**
     *   
    */
    public static function image($param) {
        
    }
    
    /**
     *   
    */
    public static function password($name, $attributes=array()) {
        return new \FieldTypes\Password($name, $attributes);
    }
    
    /**
     *   
    */
    public static function radio($name, $attributes=array()) {
        return new \FieldTypes\Radio($name, $attributes);
    }
    
    /**
     *   
    */
    public static function mradio($name, $attributes=array(), $radios=array()) {
        if($radios == null) {
            throw new \Exception('MultiRadio Form Field requires that atleast one Radio is added (Parameter 3 of mradio())');
        }
        return new \FieldTypes\MultiRadio($name, $radios, $attributes);
    }
    
    /**
     *   
    */
    public static function reset($param) {
        
    }
    
    /**
     * Factory for FormField Submit
    */
    public static function submit($name, $attributes=array()) {
        return new \FieldTypes\Submit($name, $attributes);
    }
    
    /**
     * Factory for FormField Text
    */
    public static function text($name, $attributes=array()) {
        return new \FieldTypes\Text($name, $attributes);
    }
    
    /**
     * Factory for FormField single Select
    */
    public static function select($name, $attributes=array(), $options=array()){
        $select = new \FieldTypes\Select($name, $attributes, $options);

        return $select;
    }
    
    /**
     * Factory for FormField multi Select
    */
    public static function mselect($name, $attributes=array(), $options=array()){
        return new \FieldTypes\MultiSelect($name, $attributes, $options);
    }
    
    /**
     * Factory for FormField multi Check
    */
    public static function mcheck($name, $attributes=array(), $checkboxes=array()) {
        return new \FieldTypes\MultiCheck($name, $attributes, $checkboxes);
    }
    
    /**
     * Factory for FormField select Option
    */
    public static function option($description, $attributes=array(), $selected=false) {
        return new \FieldTypes\Option($description, $attributes, $selected);
    }  
    
    /**
     * Factory for FormField single Check
    */
    public static function check($name, $attributes=array()){
        return new \FieldTypes\Check($name, $attributes);
    }
    
    /**
     * Factory for FormField Textarea
    */
    public static function textarea($name, $attributes=array(), $description=''){
        return new \FieldTypes\Textarea($name, $attributes, $description);
    }

    /**
     * Factory for FormField Fieldset
    */
    public static function fieldset($name, $attributes=array(), $fields=array()){
        return new \FieldTypes\Fieldset($name, $attributes, $fields);
    }
    
    /**
     * Factory for FormField Label
    */
    public static function label($name, $attributes, $formField=null){
        return new \FieldTypes\Label($name, $attributes, $formField);
    }

}
?>
