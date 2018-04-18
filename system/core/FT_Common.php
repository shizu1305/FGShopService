<?php if (!defined('PATH_SYSTEM')) die('Bad requested');

  /**
   * Function run program
   */

  function FT_load() {
    //Get config original
    $config = include_once PATH_APPLICATION . '/config/init.php';

    //If you do not transmit the controller then get the default controller
    $controller = empty($_GET['controller']) ? $config['default_controller'] : $_GET['controller'];

    //If you do not transmit the action then get the default action
    $action = empty($_GET['action']) ? $config['default_action'] : $_GET['action'];

    //Convert name controller because format is {Name}_Controller
    $controller = ucfirst(($controller)) . '_Controller';

    //Convert name action because format is {name}Action
    $action = strtolower($action);

    //Check file controller is exists
    if (!file_exists(PATH_APPLICATION . '/controller/' . $controller . '.php')) {
      die('Not found controller');
    }

    //Include the main controller for its child controllers
    include_once PATH_SYSTEM . '/core/FT_Controller.php';

    //Load Base_Controller
    if (file_exists(PATH_APPLICATION . '/core/Base_Controller.php')) {
        include_once PATH_APPLICATION . '/core/Base_Controller.php';
    }

    //Call file controller
    require_once PATH_APPLICATION . '/controller/' . $controller . '.php';

    //Check class controller is exists ?
    if (!class_exists($controller)) {
      die('Not found controller');
    }

    //Create controller
    $controllerObject = new $controller();

    //Check action is exists ?
    if (!method_exists($controllerObject, $action)) {
        die('Not found action');
    }

    //Run program
    $controllerObject->{$action} ();
  }

 ?>
