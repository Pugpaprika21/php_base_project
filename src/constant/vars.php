<?php

define("APP_NAMESPACE", "App\\Controllers\\");
define("APP_DI", "App\\DI\\");
define("APP_REPOSITORY", "App\\Repository\\");
define("APP_HELPERS", "App\\Helpers\\");

define("ARR_UPPER_CASE", false);

define("URL_SCHEME", $_SERVER["REQUEST_SCHEME"] . "://" .  $_SERVER["SERVER_NAME"] . ":"  . $_SERVER["SERVER_PORT"] . "/");