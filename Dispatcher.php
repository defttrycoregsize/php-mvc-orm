<?php
    namespace MVC;

    use MVC\Request;
    use MVC\Router;
    use MVC\Core\Controller;

    class Dispatcher
    {
        private $request;

        public function dispatch()
        {
            $this->request = new Request(); // lấy URL hiện tại.

            Router::parse($this->request->url, $this->request); // phân tích URL , hàm static

            $controller = $this->loadController();

            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }

        public function loadController()
        {
            $name = ucfirst($this->request->controller) . "Controller"; // lấy được controller

            $file =  'MVC\Controllers\\' . $name ;

            $controller = new $file();

            return $controller;
        }
    }
?>
