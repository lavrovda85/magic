<?php
class Controller {

        private function __construct() {}

        static function run() {
                require("wizard.php"); // Сущность мага
                require("sabbath.php");  // Колдунство
                require("keeper.php");  // Писарчук. Прикрытие для $_SESSION 
                session_start();
                $instance = new Controller();
                $instance->handleRequest();
        }

        function handleRequest() {
                
                $request = new ControllerRequest();  //Парсер запросов. Прикрытие для $_SERVER    
                $cmd_r   = new CommandResolver(); // Обработчик комманд
                $cmd     = $cmd_r->getCommand($request); //Вызов Коммманды класса из файла  
                $cmd->execute($request);               
        }
}

class CommandResolver {
        private static $base_cmd;
        private static $default_cmd;

        function __construct() {
                if (!self::$base_cmd) {
                        self::$base_cmd  = new ReflectionClass("Command");
                        require("client.php");
                        self::$default_cmd = new client();
                }
        }
        function getCommand(ControllerRequest $request) {
                $cmd = $request->getProperty('cmd');
                $sep = DIRECTORY_SEPARATOR;
                if (!$cmd) {
                        
                        return self::$default_cmd;
                }
                $cmd=str_replace(array('.',$sep),"",$cmd);
                $filepatch ="./back/{$cmd}.php";
                $classname =$cmd;
                if (file_exists($filepatch)) {

                        @require_once("$filepatch");
                        if (class_exists($classname)) {
                        $cmd_class = new ReflectionClass($classname);
                                if ($cmd_class->isSubClassOf(self::$base_cmd)) {
                                        return $cmd_class->newInstance();
                                } 
                        }
                }
                return clone self::$default_cmd;
        }
}

class ControllerRequest {
        
        private $properties;

        function __construct() {
                $this->init();
        }

        function init() {
                if (isset($_SERVER['REQUEST_METHOD'])) {
                        $this->properties = $_REQUEST;
                }
        }

        function getProperty($key) {
                if (isset($this->properties[$key])) {
                        return $this->properties[$key];
                }
        }
    
}

abstract class Command {


        function __construct()
                        {

                        }

                function execute(ControllerRequest $request) {
                        $this->doExecute($request);
                }

                abstract function doExecute(ControllerRequest $request);
        }

