<?php

class WebSockerServer
{
    public static $instance;
    public $ws;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    private $application;

    public function __construct() {
        $ws = new swoole_websocket_server(
            '127.0.0.1',
            9501,
            SWOOLE_PROCESS,
            SWOOLE_SOCK_TCP
        );
        $ws->set([
            'worker_num' => 16,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 1
        ]);

        $ws->on('open', [$this, 'onOpen']);
        $ws->on('message', [$this, 'onMessage']);
        $ws->on('WorkerStart', [$this, 'onWorkerStart']);
        $ws->on('request', function ($request, $response) {
            self::$server = $request->server ?? [];
            self::$header = $request->header ?? [];
            self::$get    = $request->get ?? [];
            self::$post   = $request->post ?? [];

            ob_start();
            try {
                $yaf_request = new Yaf_Request_Http(self::$server['request_uri']);
                $this->application->getDispatcher()->dispatch($yaf_request);
            } catch (Yaf_Exception $e) {
                // TODO
            }

            $result = ob_get_contents();
            ob_end_clean();

            $response->end($result);
        });
        $ws->start();
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

    public function onOpen($ws, $request) {
        //
    }

    public function onMessage($ws, $frame) {
        //
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new WebSockerServer;
        }
        return self::$instance;
    }
}


WebSockerServer::getInstance();