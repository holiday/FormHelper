<?php

/*
 * This class represent Objects that can observe an Observable class.
 */

namespace FormHelper;

interface Observer {
    
    public function update(Observable $observable, $args=null);

}

?>
