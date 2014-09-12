<?php
// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.

if (file_exists('test.xml')) {
    $xml = simplexml_load_file('test.xml');
 
    print_r($xml);
} else {
    exit('Failed to open test.xml.');
}
?>