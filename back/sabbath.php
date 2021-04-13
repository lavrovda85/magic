<?php

class Sabbath { // Класс реализиут непосредственно битву )) колективное угадывание числа простым рандомом. Щас 8 человек всего так что придется потдаватся. Но если понадобится 5 сек допилить редактор волебников.

	private  $Wizards  = array(); // Хранилище магов
	private  $TrueNumbers =array(); // Хранилище загаданных чисел

	function __construct() {

	 	$Names = ['Дэвид Коперфильд',
					'Амаяк Акапян',
					'Дэвид Блэйн',
					'Гарри Гуддини',
					'Сын мамкиной подруги',
					'Первый Встречный',
					'Гудков'	
				];

		foreach ($Names as $Name ) {
			$this->addWizard($name);
		}
	 }
	public function addWizard($name) { // Добавить мага

				$this->Wizards[] = new Wizard($name);
	}	

	 public function setTrueNumber($num) {  // Передеть загаданное число
	 		$this->TrueNumbers[] = $num;
	 		$this->guessCheckAll();
	 }

	 private function guessCheckAll() {    //  Проверить все последние предсказания

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$this->Wizards[$i]->guessCheck($this->TrueNumbers[Count($this->TrueNumbers)-1]);
	 	}

	 }
	 private function guessAll() {    // Предсказать чтонибудь всем волшебникам

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$this->Wizards[$i]->guess();
	 	}
	 }
	 public function getLastResult() { // Получить все последние предсказания

	 	$this->guessAll();
	 	$arrayResult = array();

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$arrayResult[] =  json_encode(array('name'=> $this->Wizards[$i]->getName(),'num' => $this->Wizards[$i]->getLastGuess()));
	 	}
	 	return $arrayResult;
	 }

	 public function getAllResult() { // Получить вообще все  предсказания вместе с загаданными числами

	 	Function toColumn($str) { // Json Любит с ключиками
	 		return  array('col'=> $str);
	 	}
	 	$result[0][0] =  toColumn("Загаданное число");

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {
	 							// Таблица рисуется по китайски сверху вниз 
	 		$result[0][$i+1] = toColumn($this->Wizards[$i]->getName(). ' ур.(' . $this->Wizards[$i]->getRating() . ')' );  
	 							// Во внешнем цыкле заголовки в внутринеем столбцы к ним
	 		for ($j=0;$j<=Count($this->TrueNumbers)-1;$j++) {

	 			$result[$j+1][0] = toColumn($this->TrueNumbers[$j]);
	 			$result[$j+1][$i+1] = toColumn( $this->Wizards[$i]->seasons[$j] ); 			
	 		}
	 	}
	 	foreach ($result as $res) {   // Еще раз взболтать
	 		$res_json[] = json_encode($res);
	 	}
	 	return $res_json;
	}
}

?>