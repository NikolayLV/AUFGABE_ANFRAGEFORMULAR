<?php


namespace wfm;


class App
{

    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        session_start();
        self::$app = Registry::getInstance();
        Router::dispatch($query);
    }

}