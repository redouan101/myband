<?php

function homepage_action() {
    //MODEL
    global $smarty;
    $articles = get_articles();
//    var_dump($articles);
//    exit();
    $smarty->assign('articles', $articles);
    $smarty->display('header.tpl');
    $smarty->display('menu.tpl');
    $smarty->display('home.tpl');
    $smarty->display('footer.tpl');
}

function page_not_found_action() {
    global $smarty;
    $smarty->display('notfound.tpl');
}

function contact_action() {
    global $smarty;
    //MODEL

    //VIEWS
    $smarty->display('header.tpl');
    $smarty->display('menu.tpl');
    $smarty->display('contact.tpl');
    $smarty->display('footer.tpl');


}

function news_action() {
    global $smarty;
    global $pageno;
    global $searchterm;
    //MODEL
    $articles = get_some_articles();
    $number_of_pages = get_number_of_pages();
    $smarty->assign('current_page',$pageno);
    $smarty->assign('number_of_pages', $number_of_pages);
    $smarty->assign('articles', $articles);

    //VIEWS
    $smarty->display('header.tpl');
    $smarty->display('menu.tpl');
    $smarty->display('news.tpl');
    $smarty->display('footer.tpl');

}


function admin_action() {
    global $smarty;
    $smarty->display('inlogformulier.tpl');
}

function login_action() {
    check_login();
}