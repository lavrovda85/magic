<?php

class Wizard {

	private $name;
	private $rating =0;
	public $seasons = array(); // Раунды отгадайки

	function __construct($name) {

			$this->name = $name;
	}
	public function guess() { // Гадание
		$this->seasons[] = random_int(1,80);
	}
	public function getRating(){ // Получить текущий рейтинг мага

		return $this->rating;
	}
	public function guessCheck($num){ // Проверить последнее гадание  и поправть рейтинг

			if ($this->getLastGuess() == $num) {
				$this->rating++;
			}else {
				$this->rating--;
			}
	}
	public function getName(){  // Получить имя мага

		return $this->name;
	}
	public function getLastGuess(){  // Получить результат последнего гадания 

		return $this->seasons[Count($this->seasons)-1];
	}
}

?>