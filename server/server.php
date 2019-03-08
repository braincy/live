<?php

class HttpServer
{
    public static $instance;
    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    private $application;

    public function __construct() {
        $http = new swoole_http_server(
            '127.0.0.1',
            9501,
            SWOOLE_PROCESS,
            SWOOLE_SOCK_TCP
        );
        $http->set([
            'worker_num' => 3,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 1
        ]);
        $http->on('WorkerStart', [$this, 'onWorkerStart']);
        $http->on('request', function ($request, $response) {
            HttpServer::$server = $request->server ?? [];
            HttpServer::$header = $request->header ?? [];
            HttpServer::$get    = $request->get ?? [];
            HttpServer::$post   = $request->post ?? [];

            ob_start();
            try {
                $yaf_request = new Yaf_Request_Http(HttpServer::$server['request_uri']);
                $this->application->getDispatcher()->dispatch($yaf_request);
            } catch (Yaf_Exception $e) {
                // TODO
            }

            $result = ob_get_contents();
            ob_end_clean();

            $response->end($result);
        });
        $http->start();
    }

    public function onWorkerStart() {
        define('APPLICATION_PATH', dirname(__DIR__));
        $this->application = new Yaf_Application(
            APPLICATION_PATH . '/conf/application.ini'
        );

        ob_start();
        $this->application->bootstrap()->run();
        ob_end_clean();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
    }
}


HttpServer::getInstance();