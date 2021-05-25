<?php 
    function converteData($data, $formato){
        return date($formato, strtotime($data));
    }
?>