<?php
if(!isset($_SESSION)){session_start();echo "ng";}
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class EggsController extends AppController {
	
	public function example1(){
		var_dump($_SESSION);
		$_SESSION['abc']='def';
//		header('Location: http://localhost/circle_recommend/Eggs/example2');
//		exit();
	}
	
	public function example2(){
		echo $_SESSION['abc'];
		$_SESSION['abcde']='fghij';
	}
}
	

?>