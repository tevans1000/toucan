<?php

class Alert {
    
    private $type;
    private $message;
    
    function __construct($message, $type = "default"){
        $this->message = $message;
        $this->type = $type;
    }
    
    function to_bootstrap(){
        $html_message = htmlspecialchars($this->message);
        $html_type = htmlspecialchars($this->type);
        return "<div class=\"alert alert-$html_type alert-dismissable\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"><span class=\"glyphicon glyphicon-remove\"></span></a>$html_message</div>";
    }
}

?>