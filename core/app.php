<?php
require_once "config.php";
ob_start();
$uri = $_SERVER["REQUEST_URI"];
$cleaned = explode("?", $uri)[0];

route('/', 'homeController');
route('/price-list', 'priceListController');

route('/administ', 'adminController');
route('/addMobileSubmit', 'mobilePhonesSubmitController', "POST");
route('/administ/(?<id>[\d]+)/phoneDelete', 'phoneDeleteController', "POST");

list($view, $data) = dispatch($cleaned, 'notFoundController');
if (preg_match("%^redirect\:%", $view)) {
    $redirectTarget = substr($view, 9);
    header("Location:" . $redirectTarget);
    die;
}
extract($data);
ob_clean();
require_once "templates/layout.php";
