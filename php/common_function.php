<?php

function displayWebPage($main){
  $controllerpath = "../controller/web/";
  require_once($controllerpath.$main);
}

function displayAdminPage($main){
  $controllerpath = "../controller/admin/";
  require_once($controllerpath.$main);
}

?>
