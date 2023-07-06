<?php
require_once '../vendor/autoload.php';
require_once '../php/common_function.php';

function route()
{
    // ルーティングのルールを指定する
    $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

        /* web ********************************************************************/
        // webpage login
        $r->addRoute('GET', '/login', 'web_login');
        // webpage dashboard
        $r->addRoute('GET', '/dashboard', 'web_dashboard');
        // webpage mypage
        $r->addRoute('GET', '/mypage', 'web_mypage');
        // webpage theme
        $r->addRoute('GET', '/theme/{id:\d+}', 'web_theme');

        /* admin ******************************************************************/
        $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
          // adminpage login
          $r->addRoute('GET', '/login', 'admin_login');
          // adminpage dashboard
          $r->addRoute('GET', '/dashboard', 'admin_dashboard');
          // adminpage user
          $r->addRoute('GET', '/user_list', 'admin_user_list');
          $r->addRoute('GET', '/user_input', 'admin_user_input');
          $r->addRoute('GET', '/user/{id:\d+}', 'admin_user');
          // adminpage admin
          $r->addRoute('GET', '/admin_list', 'admin_admin_list');
          $r->addRoute('GET', '/admin_input', 'admin_admin_input');
          $r->addRoute('GET', '/admin/{id:\d+}', 'admin_admin');
          // adminpage course
          $r->addRoute('GET', '/course_list', 'admin_course_list');
          $r->addRoute('GET', '/course_input', 'admin_course_input');
          $r->addRoute('GET', '/course/{id:\d+}', 'admin_course');
          // adminpage theme
          $r->addRoute('GET', '/theme_list', 'admin_theme_list');
          $r->addRoute('GET', '/theme_input', 'admin_theme_input');
          $r->addRoute('GET', '/theme/{id:\d+}', 'admin_theme');
          // adminpage submission
          $r->addRoute('GET', '/submission_list', 'admin_submission_list');
          $r->addRoute('GET', '/submission/{id:\d+}', 'admin_submission');
        });
    });

    // リクエストパラメータを取得する
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    // リクエストURLからクエリストリング(?foo=bar)を除去したうえで、URIデコードする
    $pos = strpos($uri, '?');
    if ($pos !== false) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    // ルーティングに従った処理を行う
    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::FOUND:
            // ルーティングに従って処理を実行
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            doAction($handler, $vars);
            break;

        case FastRoute\Dispatcher::NOT_FOUND:
            // Not Foundだった時
            echo "404 Not Found.";
            break;

        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            // Method Not Allowedだった時
            $allowedMethods = $routeInfo[1];
            echo "405 Method Not Allowed.  allow only=" . json_encode($allowedMethods);
            break;

        default:
            echo "500 Server Error.";
            break;
    }
}

function doAction($handler, $vars)
{
    switch ($handler) {
        case "get_all_users":
            echo "acition users called.";
            break;
        case "get_user":
            echo "action user called. param=" . json_encode($vars);
            break;
        case "get_bbs":
            echo "bbs. page=" . json_encode($vars);
            break;

        case "web_login":
            displayWebPage("login.php");
            break;

        case "web_dashboard":
            displayWebPage("dashboard.php");
            break;

        case "admin_login":
            displayAdminPage("login.php");
            break;

        case "admin_dashboard":
            displayAdminPage("dashboard.php");
            break;
    }
}

route();

?>
