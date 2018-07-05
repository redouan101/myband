<?php

if (isset($_POST['vullen'])) {
    for ($i = 1; $i <= 100 ; $i++) {
        insert_line($i);
    }
    echo    'Inserted 100 rows.';

}

if (isset($_POST['legen'])) {
    empty_table();
    echo 'DE tabel is leeg.';
}

function connect() {
    $mysqli = new mysqli('localhost', 'root','root','myband_db');
    if ($mysqli->connect_errno) {
        echo 'Connection error: ' . $mysqli->connect_errno;
    }
    return $mysqli;
}

function insert_line($i) {
    $mysqli = connect();
    $title = 'Title ' . $i;
    $content = 'Content ' . $i;
    $image = 'Image ' . $i;
    $query = "INSERT INTO articles VALUES (0,?,?,?)";
    $stmt = $mysqli->prepare($query) or die ('Error preparing.');
    $stmt->bind_param('sss',$title,$content,$image) or die ('Error binding params');
    $stmt->execute() or die ('Error executing.');

}

function empty_table() {
    $mysqli = connect();
    $query = "TRUNCATE articles";
    $stmt = $mysqli->prepare($query) or die ('Error preparing 2.');
    $stmt->execute() or die ('Error executing.');
}
