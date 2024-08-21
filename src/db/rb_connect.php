<?php

if (env("DB_TYPE") != "dev") {
    R::setup("" . env("DB_DRIVER") . ":host=" .  env("DB_HOST") . ";dbname=" . env("DB_NAME") . "", env("DB_USER"), env("DB_PASS"));
    R::debug(false);
    R::ext("xdispense", function ($type) {
        return R::getRedBean()->dispense($type);
    });
}
