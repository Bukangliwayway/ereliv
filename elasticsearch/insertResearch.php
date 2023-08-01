
<?php

$query = filter_input(INPUT_POST, 'query', FILTER_SANITIZE_STRING);

try {


} catch (Exception $e) {

  echo 'Caught exception: ', $e->getMessage(), "\n";

}