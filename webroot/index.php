<?php
define('WEBROOT', dirname(__FILE__));   // Dossier Webroot
define('ROOT', dirname(WEBROOT));   // Dossier Racine
define('DS', DIRECTORY_SEPARATOR);  // Separateur URL ('/')
define('CORE', ROOT.DS.'core');   // Moteur du site
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));  // URL de la racine

require CORE.DS.'includes.php';
new Dispatcher();
