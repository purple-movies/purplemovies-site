<?php

    $url = '..\private\test.xml';
    
    if ( file_exists($url) ) {   // If file exists load it in:
        $xml = simplexml_load_file( $url );
        
        echo $xml->asXML();
    }

?>