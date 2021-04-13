<?php

class sendNumber extends Command { 

       	function doExecute(ControllerRequest $request){

       		try {

	       		$sabath = SessionKeeper::getSabbath(); // Получаем из сессии Шабаш с калдунами

	       		$sabath->setTrueNumber($request->getProperty('num')); // Передаем им наше число

	       		echo '['.implode(',',$sabath->getAllResult()).']'; // Получаем и выводим всю статистику

	       		SessionKeeper::setSabbath($sabath); // Записываем шабаш обратно в сессию

	       	} catch (Throwable $e) {
	    		echo "Апшибки: " . $e->getMessage() . PHP_EOL;
			}

       }

}

?>