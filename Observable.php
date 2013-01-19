<?php

/*
 * Observable object that can be extended to objects that need to be observed. 
 * It is coupled with the Observers class.
 */

namespace FormHelper;

class Observable {

    protected $observers = array();
    
    protected $changed = false;
    
    public function __construct(){
        
    }
    
    /**
     *  Adds an Observer to this Observable
     * @param Observer $observer 
     */
    public function addObserver(Observer $observer) {
        $this->observers[] = $observer;
    }
    
    /**
     *  Removes an Observer from this Observable if present
     * @param Observer $observer
     * @return boolean 
     */
    public function removeObserver(Observer $observer) {
        foreach($this->observers as $key => $obs) {
            if($observer == $obs) {
                array_slice($this->observers, $key, 1);
                return true;
            }
        }
        return false;
    }
    
    /**
     *   Set observers attribute to an empty array 
    */
    public function removeObservers() {
        $this->observers = array();
    }
    
    /**
     *   Return the number of observers
    */
    public function countObservers() {
        return count($this->observers);
    }
    
    /**
     *  Return True if this Observable is changed, False otherwise
     * @return type Boolean
     */
    public function hasChanged(){
        return $this->changed;
    }
    
    /**
     * Set this Observable as changed 
     */
    public function setChanged($arg=null){
        $this->changed = true;
        $this->notifyObservers($arg);
    }
    
    /**
     *  Sets the state of this Observable to unChanged if all Observers have 
     *  been notified of the most recent change.
     */
    public function clearChanged() {
        $this->changed = false;
    }
    
    /**
     *  Invokes the update() method on all Observers on this Observable
     * @param type $arg 
     */
    public function notifyObservers($arg=null) {
        foreach($this->observers as $observer) {
            $observer->update($this, $arg);
        }
        //all observers have been notified, the state can return to unchanged
        $this->clearChanged();
    }

}
?>
