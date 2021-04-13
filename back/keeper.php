<?php
class SessionKeeper {

	static function checkSession() { // Проверяем есть ли сессия и тот ли клиент с ней пришел 
		return (!isset($_SESSION['Sabbath']) ) ? false : true;
	}
	static function getSabbath() {  // Получаем Экземпляр шабаша 

		return self::checkSession() ? $_SESSION['Sabbath'] : new Sabbath();
		//return new Sabbath();
	 } 
	 static function setSabbath(Sabbath $sabath) { // Записываем экземпляр и метаданные для проверки 

	 	$_SESSION['Sabbath'] = $sabath;
	 	$_SESSION['ClientIP'] = $_SERVER['REMOTE_ADDR'];
	 	$_SESSION['ClientUA'] =  $_SERVER['HTTP_USER_AGENT'];
	  }
}
//&&  $_SESSION['ClientIP'] != $_SERVER['REMOTE_ADDR'] && $_SESSION['ClientUA'] !=  $_SERVER['HTTP_USER_AGENT']
?>
