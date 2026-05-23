<?php
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("myErrorHandler");

try {
   
} catch (Exception $e) {
 
    echo "Gabim: " . $e->getMessage();
}
?>
