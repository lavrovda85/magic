<?php

class Sabbath {

	private  $Wizards  = array();
	private  $TrueNumbers =array();

	function __construct() {

	 	$this->Wizards[] = new Wizard('Дэвид Коперфильд');
	 	$this->Wizards[] = new Wizard('Амаяк Акапян');
	 	$this->Wizards[] = new Wizard('Дэвид Блэйн');
	 	$this->Wizards[] = new Wizard('Гарри Гуддини');
	 	$this->Wizards[] = new Wizard('Сын мамкиной подруги');
	 	$this->Wizards[] = new Wizard('Первый Встречный');
	 	$this->Wizards[] = new Wizard('Гудков');

	 }
	 public function setTrueNumber($num) {  // Передеть загананное число число
	 		$this->TrueNumbers[] = $num;
	 		$this->guessCheck();
	 }

	 public function guessCheck() {    //  Проверить все последние предсказания

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$this->Wizards[$i]->guessCheck($this->TrueNumbers[Count($this->TrueNumbers)-1]);
	 	}

	 }
	 public function guessAll() {    // Предсказать чтонибудь всем волшебникам

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$this->Wizards[$i]->guess();
	 	}
	 }
	 public function getLastResult() { // Получить все последние предсказания

	 	$this->guessAll();
	 	$arrayResult = array();
	 	//echo Count($this->Wizards);
	 	//var_dump($this);

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$arrayResult[] =  json_encode(array('name'=> $this->Wizards[$i]->getName(),'num' => $this->Wizards[$i]->getLastGuess()));
	 	}
	 	return $arrayResult;
	 }

	 public function getAllResult() { // Получить вообще все  предсказания вместе с загаданным числом


	 	$result[0][0] = array('col'=> "Загадали число");

	 	for ($i=0;$i<=Count($this->Wizards)-1;$i++) {

	 		$result[0][$i+1] = array('col'=> $this->Wizards[$i]->getName(). '(' . $this->Wizards[$i]->getRating() . ')' );
	 		
	 		for ($j=0;$j<=Count($this->TrueNumbers)-1;$j++) {

	 			//var_dump($this->Wizards[$i]->seasons);
	 			$result[$j+1][0] = array('col'=> $this->TrueNumbers[$j] );
	 			$result[$j+1][$i+1] = array('col'=> $this->Wizards[$i]->seasons[$j] );
	 			
	 		}
	 	}
	 	foreach ($result as $res) {
	 		$res_json[] = json_encode( $res);
	 	}
	 	return $res_json;
	}
}

?>