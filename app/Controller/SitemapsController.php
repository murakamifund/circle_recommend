<?php
class SitemapsController extends AppController{
	public $uses = array('Circle', 'Event');
	
	public function index(){
		$this->set('circles', $this->Circle->find('all'));
		$this->set('events',$this->Event->find('all'));
		$this->layout = "xml/default";
	}
}
?>