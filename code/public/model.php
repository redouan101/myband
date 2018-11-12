<?php

function make_connection() {
    $mysqli = new mysqli('localhost','root','root','myband_db') ;
    if ($mysqli->connect_errno){
        die('Connection error: ' . $mysqli->connect_errno . '<br>');
    }
    return $mysqli;
}

function get_articles() {

    $mysqli = make_connection();
    $query = "SELECT title FROM articles";
    $stmt = $mysqli->prepare($query) or die ('Error preparing 1.');
    $stmt->bind_result($title) or die ('Erro binding results 1.');
    $stmt->execute() or die ('Error executing 1.');
    $results = array();
    while ($stmt->fetch()) {
        $results[] = $title;
    }
    return $results;
}

function get_some_articles() {
        global $pageno, $searchterm;
        $mysqli = make_connection();
//        exit('Pageno: ' . $pageno . ', articles per page: ' . ARTICLES_PER_PAGE . '<br>');
        $firstrow = ($pageno -1) * ARTICLES_PER_PAGE;
        $per_page = ARTICLES_PER_PAGE;
        $query =    "SELECT title, content, imagelink ";
        $query .=   "FROM articles ";
        $query .=   "WHERE title LIKE ? OR ";
        $query .=   "content LIKE ? ";
        $query .=   "ORDER BY articles_id ";
        $query .=   "DESC LIMIT $firstrow,$per_page ";
        $stmt = $mysqli->prepare($query) or die ('Error preparing 2.');
        $stmt->bind_param('ss',$searchterm,$searchterm) or die('ERROR BINDING SEARCHTERM!');
        $stmt->bind_result($title,$content, $imagelink) or die ('Error binding results 1.');
        $stmt->execute() or die ('Error executing 1.');
        $result = array();
        while ($stmt->fetch()) {
            $article = array();
            $article[]= $title;
            $article[]= $content;
            $article[]= $imagelink;
            $result[] = $article;
        }
        return $result;

}

function get_number_of_pages() {
    $number_of_pages = calculate_pages() or die ('Error calculating.');
    return $number_of_pages;

}

function calculate_pages(){
    $mysqli = make_connection();
    $query = "SELECT * FROM articles";
    $result = $mysqli->query($query) or die ('ERROR querying 2.');
    $rows = $result->num_rows;
    $number_of_pages = ceil($rows/ ARTICLES_PER_PAGE);
    return $number_of_pages;
}

function check_login() {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'admin' )
        $_SESSION['loggedin'] = 'loggedin';
}
