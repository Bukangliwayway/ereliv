<?php
include '../db/db.php';
include '../db/queries.php';

if(checkElasticsearchConnection()){
    echo 'naks naks';
} else echo 'nankuu';