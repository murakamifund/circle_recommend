<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $uses = array('Circle','Event');

//homeページのコントローラー
  public function home() {
	
    $this->modelClass = null;
    $this->layout = "layout";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
   
	}
	
	//aboutページのコントローラー
	public function about() {
	
    $this->modelClass = null;
    $this->layout = "layout";
    $this->set("header_for_layout","circlr recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
   
	}
	
	
	//studentページのコントローラー
	public function student() {
	
    $this->modelClass = null;
    $this->layout = "layout";
    $this->set("header_for_layout","circlr recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
    $check1 = isset($this -> data["check1"]) ?
	 "On" : "Off";
	$check2 = isset($this -> data["check2"]) ?
	 "On" : "Off";
	$check3 = isset($this -> data["check3"]) ?
	 "On" : "Off";
	$check4 = isset($this -> data["check4"]) ?
	 "On" : "Off";
	$check5 = isset($this -> data["check5"]) ?
	 "On" : "Off";
	$check6 = isset($this -> data["check6"]) ?
	 "On" : "Off";
	$check7 = isset($this -> data["check7"]) ?
	 "On" : "Off";
	$check8 = isset($this -> data["check8"]) ?
	 "On" : "Off";
	$check9 = isset($this -> data["check9"]) ?
	 "On" : "Off";
	$check10 = isset($this -> data["check10"]) ?
	 "On" : "Off";
	$check11 = isset($this -> data["check11"]) ?
	 "On" : "Off";
	$check12 = isset($this -> data["check12"]) ?
	 "On" : "Off";
	$check13 = isset($this -> data["check13"]) ?
	 "On" : "Off";
	$check14 = isset($this -> data["check14"]) ?
	 "On" : "Off";
	$check15 = isset($this -> data["check15"]) ?
	 "On" : "Off";
	$check31 = isset($this -> data["check31"]) ?
	 "On" : "Off";
	$check32 = isset($this -> data["check32"]) ?
	 "On" : "Off";
	$check33 = isset($this -> data["check33"]) ?
	 "On" : "Off";
	$check34 = isset($this -> data["check34"]) ?
	 "On" : "Off";
	$check35 = isset($this -> data["check35"]) ?
	 "On" : "Off";
	$check36 = isset($this -> data["check36"]) ?
	 "On" : "Off";
	$check37 = isset($this -> data["check37"]) ?
	 "On" : "Off";
	$check38 = isset($this -> data["check38"]) ?
	 "On" : "Off";
	$check51 = isset($this -> data["check51"]) ?
	 "On" : "Off";
	$check52 = isset($this -> data["check52"]) ?
	 "On" : "Off";
	$check53 = isset($this -> data["check53"]) ?
	 "On" : "Off";
	$check54 = isset($this -> data["check54"]) ?
	 "On" : "Off";
	$check61 = isset($this -> data["check61"]) ?
	 "On" : "Off";
	$check62 = isset($this -> data["check62"]) ?
	 "On" : "Off";
	$check63 = isset($this -> data["check63"]) ?
	 "On" : "Off";
	$check64 = isset($this -> data["check64"]) ?
	 "On" : "Off";
	$check71 = isset($this -> data["check71"]) ?
	 "On" : "Off";
	$check72 = isset($this -> data["check72"]) ?
	 "On" : "Off";
	$check73 = isset($this -> data["check73"]) ?
	 "On" : "Off";
	$check74 = isset($this -> data["check74"]) ?
	 "On" : "Off";
	$check75 = isset($this -> data["check75"]) ?
	 "On" : "Off";
	$check81 = isset($this -> data["check81"]) ?
	 "On" : "Off";
	if ($this -> request -> data){
		if($this -> data["keyword"]){
			$word = $this -> data["keyword"];
		}
		$place = $this -> data["radio1"];
		$nomi = $this -> data["radio3"];
		$mazime = $this ->data["radio4"];
	}
	if (isset($data)):
		$day =array(
			Circle.day1,
			Circle.day2,
			Circle.day3,
			Circle.day4,
			Circle.day5,
			Circle.day6,
			Circle.day7
		);
		$day2=array(
			"月",
			"火",
			"水",
			"木",
			"金",
			"土",
			"日"
		);
		$c=0;
		for ($i=0;$i<7;$i++):
			if ($day[$i]=="1"):
				if ($c==0):
					echo $day2[$i];
					$c=$c+1;
				else:
					echo ",";
					echo $day2[$i];
				endif;
			endif;
		endfor;
	endif;
	$activity = array(
		$check1,
		$check2,
		$check3,
		$check4,
		$check5,
		$check6,
		$check7,
		$check8,
		$check9,
		$check10,
		$check11,
		$check12,
		$check13,
		$check14,
		$check15,
		$check31,
		$check32,
		$check33,
		$check34,
		$check35,
		$check36,
		$check37,
		$check38,
		$check51,
		$check52,
		$check53,
		$check54,
		$check61,
		$check62,
		$check63,
		$check64,
		$check71,
		$check72,
		$check73,
		$check74,
		$check75,
		$check81,
	);
	$activity2 = array();
	$a = 0;
	for($i=0;$i<37;$i++):
		if($activity[$i]=="On"):
			$activity2[$a]=$i;
			$a = $a+1;
		endif;
	endfor;
	$p=array("駒場","本郷","");
	$in=array("学内","インカレ","");
	if ($this -> request -> data){
		if($this -> data["keyword"] != ""){
			$opt = array(
				'OR' => array(
					'OR' => array(
						'Circle.circle_name' => $word,
						'Circle.pr' => $word
					),
					array(
						in_array(Circle.activity,$activity2),
						'OR' => array(
							'Circle.place' => $place,
							'Circle.place' => "その他",
						),
						'Circle.nomi <=' => $nomi+1,
						'Circle.nomi >=' => $nomi-1,
						'Circle.mazime <=' => $mazime+1,
						'Circle.mazime >=' => $mazime-1,
					)
				),
			);
		}
		else{
			$opt = array(
				'Circle.activity' => $activity2,
				'OR' => array(
					'Circle.place' => $place,
					'Circle.place' => "その他",
				),
				'Circle.nomi <=' => $nomi+1,
				'Circle.nomi >=' => $nomi-1,
				'Circle.mazime <=' => $mazime+1,
				'Circle.mazime >=' => $mazime-1,
			);
		}
		if($place == "任意"){
			$opt = array(
				'Circle.activity' => $activity2,
				'Circle.nomi <=' => $nomi+1,
				'Circle.nomi >=' => $nomi-1,
				'Circle.mazime <=' => $mazime+1,
				'Circle.mazime >=' => $mazime-1,
			);
		}
		$data = $this->Circle->find('all' , array('conditions' => $opt));
		/*$count_data = $this->Circle2->find('all');
		$activity3=array(
			$count_data[0]['Circle2']['activity1'],
			$count_data[0]['Circle2']['activity2'],
			$count_data[0]['Circle2']['activity3'],
			$count_data[0]['Circle2']['activity4'],
			$count_data[0]['Circle2']['activity5'],
		);
		$komaba=$count_data[0]['Circle2']['komaba'];
		$honngou=$count_data[0]['Circle2']['honngou'];
		$anyplace=$count_data[0]['Circle2']['anyplace'];
		$gakunai=$count_data[0]['Circle2']['gakunai'];
		$inter=$count_data[0]['Circle2']['inter'];
		$man2=$count_data[0]['Circle2']['man'];
		$mancount=$count_data[0]['Circle2']['mancount'];
		$woman2=$count_data[0]['Circle2']['woman'];
		$womancount=$count_data[0]['Circle2']['womancount'];
		$cost2=$count_data[0]['Circle2']['cost'];
		$costcount=$count_data[0]['Circle2']['costcount'];
		$nomi2=$count_data[0]['Circle2']['nomi'];
		$nomicount=$count_data[0]['Circle2']['nomicount'];
		$mazime2=$count_data[0]['Circle2']['mazime'];
		$mazimecount=$count_data[0]['Circle2']['mazime'];
		if ($this->request->is('post') || $this->request->is('put')) {
			for ($i=0;$i<5;$i++):
				if ($activity[$i]=="On"):
					$activity3[$i]=$activity3[$i]+1;
				endif;
			endfor;
			if ($radio1==0):
				$komaba=$komaba+1;
			endif;
			if ($radio1==1):
				$honngou=$honngou+1;
			endif;
			if ($radio1==2):
				$anyplace=$anyplace+1;
			endif;
			if ($radio2==0):
				$gakunai=$gakunai+1;
			endif;
			if ($radio2==1):
				$inter=$inter+1;
			endif;
			if (isset($man)):
				$man2=$man2+$man;
				$mancount=$mancount+1;
			endif;
			if (isset($woman)):
				$woman2=$woman2+$man;
				$womancount=$womancount+1;
			endif;
			if (isset($cost)):
				$cost2=$cost2+$cost;
				$costcount=$costcount+1;
			endif;
			if (isset($nomi)):
				$nomi2=$nomi2+$nomi;
				$nomicount=$nomicount+1;
			endif;
			if (isset($mazime)):
				$mazime2=$mazime2+$mazime;
				$mazimecount=$mazimecount+1;
			endif;
			$data2=array(
				'id'=>1,
				'activity1'=>$activity3[0],
				'activity2'=>$activity3[1],
				'activity3'=>$activity3[2],
				'activity4'=>$activity3[3],
				'activity5'=>$activity3[4],
				'komaba'=>$komaba,
				'honngou'=>$honngou,
				'anyplace'=>$anyplace,
				'gakunai'=>$gakunai,
				'inter'=>$inter,
				'man'=>$man2,
				'mancount'=>$mancount,
				'woman'=>$woman2,
				'womancount'=>$womancount,
				'cost'=>$cost2,
				'costcount'=>$costcount,
				'nomi'=>$nomi2,
				'nomicount'=>$nomicount,
				'mazime'=>$mazime2,
				'mazimecount'=>$mazimecount,
			);
			$this->Circle2->save($data2);
		}*/
		$this -> set('data',$data);
		//$this -> set('count_data',$count_data);
		$this -> set("check1",$check1);
		$this -> set("check2",$check2);
		$this -> set("check3",$check3);
		$this -> set("check4",$check4);
		$this -> set("check5",$check5);
		$this -> set("activity",$activity);
		if (isset($day)):
			$this -> set("day",$day);
			$this -> set("day2",$day2);
		endif;
		$this -> set("nomi",$nomi);
		$this -> set("mazime",$mazime);
		$this -> set("p",$p);
		$this -> set("in",$in);
		/*$this -> set("activity3",$activity3);
		$this -> set("komaba",$komaba);
		$this -> set("honngou",$honngou);
		$this -> set("anyplace",$anyplace);
		$this -> set("gakunai",$gakunai);
		$this -> set("inter",$inter);
		$this -> set("man2",$man2);
		$this -> set("mancount",$mancount);
		$this -> set("woman2",$woman2);
		$this -> set("womancount",$womancount);
		$this -> set("cost2",$cost2);
		$this -> set("costcount",$costcount);
		$this -> set("nomi2",$nomi2);
		$this -> set("nomicount",$nomicount);
		$this -> set("mazime2",$mazime2);
		$this -> set("mazimecount",$mazimecount);*/
	}
   
	}
	

}

?>


