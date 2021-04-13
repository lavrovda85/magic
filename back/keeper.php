<?php
class SessionKeeper { // Класс созывает шабаш по сессии и разгоняет его в конце 

	static function checkSession() { // Проверяем есть ли сессия и тот ли клиент с ней пришел. Всмысле неплохо было бы проверять клиентов но не в этот раз 
		return (!isset($_SESSION['Sabbath']) ) ? false : true;
	}
	static function getSabbath() {  // Получаем Экземпляр шабаша. Здесь можно отключится от сессии если чтото пошло не так 

		return self::checkSession() ? $_SESSION['Sabbath'] : new Sabbath();
		//return new Sabbath();
	 } 
	 static function setSabbath(Sabbath $sabath) { // Записываем экземпляр и метаданные для проверки 

	 	$_SESSION['Sabbath'] = $sabath;
	 	$_SESSION['ClientIP'] = $_SERVER['REMOTE_ADDR'];
	 	$_SESSION['ClientUA'] =  $_SERVER['HTTP_USER_AGENT'];
	  }
}  // А это какраз та проверка которая должна быть в начале 
//&&  $_SESSION['ClientIP'] != $_SERVER['REMOTE_ADDR'] && $_SESSION['ClientUA'] !=  $_SERVER['HTTP_USER_AGENT']
?>
