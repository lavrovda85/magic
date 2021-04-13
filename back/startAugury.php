<?php

class startAugury extends Command { 

       	function doExecute(ControllerRequest $request){

       		try {

	       		$sabath = SessionKeeper::getSabbath(); // Получаем из сессии Шабаш с калдунами

	       		echo '['.implode(',',$sabath->getLastResult()).']'; // Запускаем гадание и получаем его результат
	
				SessionKeeper::setSabbath($sabath); // Записываем шабаш обратно в сессию

			} catch (Throwable $e) {
    		echo "Апшибки: " . $e->getMessage() . PHP_EOL;
			}
		}
	}

?>