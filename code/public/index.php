<?php

require ('../private/smarty/Smarty.class.php');
require ('../private/model.php');
require ('../private/controller.php');

$smarty = new Smarty();
$smarty->setCompileDir('../private/tmp');
$smarty->setTemplateDir('../private/views');

define('ARTICLES_PER_PAGE',5);

// TERNARY OPERATOR
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : '1';

//CHECKEN OP SUBMIT_LOGIN
if (isset($_POST['submit_login'])) {
    login_action();
}
if (isset($_SESSION['loggedin'])) {
    cms_action();
    exit();
}



switch ($page) {
    case 'admin' : admin_action(); break;
    case 'home' : homepage_action(); break;
    case 'news' : news_action(); break;
    case 'contact' : contact_action(); break;
    default : page_not_found_action(); break;
}
?>
<html>
<body>
    <form method="post" action="../private/views/procces.php">
        <link rel="stylesheet" href="css/style.css">
        <button name="vullen">VULLEN</button>
        <button name="legen">LEGEN</button>
    </form>
</body>
</html>


