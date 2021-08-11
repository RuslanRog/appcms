<?php
session_start();

// use src\Controller;
use src\Template;
use src\DatabaseConnection;
// use src\Entity;
use src\Router;
use modules\contact\controllers\ContactController;
use modules\page\models\Page;




define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH .'modules' . DIRECTORY_SEPARATOR);


require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once MODULE_PATH . 'page/models/Page.php';
// include '../modules/contact/controllers/ContactController.php';
require_once MODULE_PATH . 'contact/controllers/ContactController.php';

// require_once MODULE_PATH . 'page/controllers/PageController.php';





DatabaseConnection::connect('localhost', 'applicable_cms', 'root', '');



// Routing
$action = $_GET['seo_name'] ?? 'home';

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);

$router->findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';
$moduleName = ucfirst($router->module) . 'Controller';
// print_r($moduleName);
// exit;
$controllerFile = MODULE_PATH . $router->module . '\controllers\\' . $moduleName . '.php';
// var_dump($controllerFile);
// exit;
if (file_exists($controllerFile)) {

    // include $controllerFile;
    // $controller = new $moduleName();
//     var_dump($controller);
// exit;
    $controller = new modules\contact\controllers\ContactController();
// $controller->text();
// exit;
    $controller->template = new src\Template('layout/default');
    $controller->setEntityId($router->entity_id);
    var_dump($action);
    $controller->runAction($action);
}
