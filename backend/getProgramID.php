<?php 
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    // do something with $content
    echo "Received content: " . $content;
}

?>