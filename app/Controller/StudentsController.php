<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class StudentsController extends AppController {
	var $uses = array('Student');
	
    public function beforeFilter() {
        
		parent::beforeFilter();
    }
	public function student_tw_callback(){
		//ユーザー認証をする関数
		require_once('config.php');
		require_once('codebird.php');
		session_start();
		

		\Codebird\Codebird::setConsumerKey('CONSUMER_KEY', 'CONSUMER_SECRET');
		$cb = \Codebird\Codebird::getInstance();
		
	if(! isset($_SESSION['tw_user_id'])){
	
		if (! isset($_SESSION['oauth_token'])) { //まだデータが渡されていないときは（認証前）
		// get the request token
		$reply = $cb->oauth_requestToken([
			'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		]);
    
		// store the token
		$cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
		$_SESSION['oauth_token'] = $reply->oauth_token;
		$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		$_SESSION['oauth_verify'] = true;

		// redirect to auth website
		$auth_url = $cb->oauth_authorize(); //Twitterの認証画面に飛ばしている
		header('Location: ' . $auth_url);
		die();

		} elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
			// verify the token
			$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			unset($_SESSION['oauth_verify']);

			// get the access token
			$reply = $cb->oauth_accessToken([
				'oauth_verifier' => $_GET['oauth_verifier']
			]);
			// store the token (which is different from the request token!)
			//$_SESSION['oauth_token'] = $reply->oauth_token;
			//$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
			$cb->setToken($reply->oauth_token,$reply->oauth_token_secret);
			$me = $cb->account_verifyCredentials(); //$meの中にアカウントの情報を入れる

			//データベースにアカウント情報を格納
			try{ //まずはデータベースに接続
				$dbh = new PDO('mysql:host=127.0.0.1;dbname=circlerecommend;charset=utf8','root','');
			}catch(PDOException $e){
				echo $e->getMessage();
			exit;
			}
    
			$sql = "select * from students where tw_user_id = :tw_user_id limit 1"; 
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
			$local_user = $stmt->fetch(); //結果を返す 
			if(!$local_user){ //取得したユーザーの情報がデータベースになければ 
				$sql = "insert into students 
				(tw_user_id,tw_screen_name,tw_profile_image_url,tw_access_token,tw_access_token_secret) 
				values
				(:tw_user_id,:tw_screen_name,:tw_profile_image_url,:tw_access_token,:tw_access_token_secret)";
				$stmt = $dbh->prepare($sql);
				$params = array(
					":tw_user_id" => $me->id_str,
					":tw_screen_name" => $me->screen_name,
					":tw_profile_image_url" => $me->profile_image_url,
					":tw_access_token" => $reply->oauth_token,
					":tw_access_token_secret" => $reply->oauth_token_secret
				);
				$stmt->execute($params);

				$sql = "select * from students where tw_user_id = :tw_user_id limit 1"; 
				$stmt = $dbh->prepare($sql);
				$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
				$local_user = $stmt->fetch();
			}
			
			
			
			$tw_user_id = $me->id_str;
			$_SESSION['tw_user_id'] = $tw_user_id; //ユーザー情報をセッションに格納
			
			
			$this->redirect(array('action' => 'student_edit'));
		}
	}else{
		$this->redirect(array('action' => 'student_edit'));
	}	
	}
	
	
	public function student_tw_logout(){
       
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
			if (isset($_COOKIE["PHPSESSID"])) {
				setcookie("PHPSESSID", '', time() - 1800, '/');
			}
		$this->redirect(array('action' => 'student_resister'));
	}
	
	public function student_resister() {
	session_start();
    $this->modelClass = null;
	
	// post時の処理
	if ($this->request->is('post')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
            $this->Student->create();
            if ($this->Student->save($this->request->data)) {	//ここにfalseと入れればバリデーションを無視できる
                $this->Session->setFlash(__('登録完了しました。管理者ログインページからサークル情報を編集してください。'));
            } else {
                $this->Session->setFlash(__('登録に失敗しました。もう一度やり直してください。'));
				//debug($this->Circle->validationErrors);
            }
			
    }
   
	}
	
	public function student_edit(){
		session_start();
		if(isset($_SESSION['tw_user_id'])){
			//userを持っていたら
			$tw_user_id = $_SESSION['tw_user_id'];
			$this->set('tw_user_id', $tw_user_id);
			$local_user = $this->Student->find('first', array(
                'conditions' => array('tw_user_id' => $tw_user_id)
            ));
			$user_name = $local_user['Student']['tw_screen_name'];
			$this->set('user_name', $user_name);
			
		}else{
			$autoRender = false; 
			$this->redirect(array('action' => 'student_resister'));
		}
	}
	
	//生徒のログイン
	//生徒のログインを別のコントローラーで扱う必要あり
	public function student_login() {

	$this->modelClass = null;	
	/*
	if ($this->request->is('post')) {
			$this->data = Sanitize::clean($this->data, array('encode' => false));
			if ($this->Auth->login()) {
				 $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('アカウント名かパスワードが間違っています。'));
			}
		}
		*/
	}
 
	//ログアウト_login
	public function student_logout() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'student_resister'));
	}
	
	//ログアウト_home
	public function student_logout_home() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'home'));
	}
  
  
	//homeページのコントローラー
	public function home() {
	
    $this->modelClass = null;
    
	}
	
	//aboutページのコントローラー
	public function about() {
	
    $this->modelClass = null;
   
	}
	
	
	//studentページのコントローラー
	public function student() {
	
    $this->modelClass = null;
	
	
	
	//検索アルゴリズム
    
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
	$nochoice1 = isset($this -> data["nochoice1"]) ?
	 "On" : "Off";
	$nochoice2 = isset($this -> data["nochoice2"]) ?
	 "On" : "Off";
	if ($this -> request -> data){
		if($this -> data["keyword"]){
			$word = $this -> data["keyword"];
		}
		else{
			$word = "";
		}
		$place = $this -> data["radio1"];
		$nomi = $this -> data["radio3"];
		$mazime = $this ->data["radio4"];
	}
	else{
		$word = "";
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
	$this->set("word",$word);
	$counts = array(
		1,2,3,4,5,6,7,8,9,10,
		11,12,13,14,15,31,32,33,34,35,
		36,37,38,51,52,53,54,61,62,63,
		64,71,72,73,74,75,81);
	$activity2 = array();
	$a = 0;
	for($i=0;$i<37;$i++):
		if($activity[$i]=="On"):
			$activity2[$a]=$counts[$i];
			$a = $a+1;
		endif;
	endfor;
	$p=array("駒場","本郷","");
	$in=array("学内","インカレ","");
	if ($this -> request -> data){
		if($this -> data["keyword"] != "" && $place == "任意"){
			if($nochoice1 == "On" && $nochoice2 == "On"){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
							)
						),
					),
				);
			}
			else if($nochoice1 == "On"){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array('Circle.mazime <=' => $mazime+1),
								array('Circle.mazime >=' => $mazime-1),
							)
						),
					),
				);
			}
			else if($nochoice2 == "On"){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array('Circle.nomi <=' => $nomi+1),
								array('Circle.nomi >=' => $nomi-1),
							)
						),
					),
				);
			}
			else{
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array('Circle.nomi <=' => $nomi+1),
								array('Circle.nomi >=' => $nomi-1),
								array('Circle.mazime <=' => $mazime+1),
								array('Circle.mazime >=' => $mazime-1),
							)
						),
					),
				);
			}
		}
		else if($this -> data["keyword"] != ""){
			if($nochoice1 == "On" && $nochoice2 == "On"){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array(
									'OR' => array(
										array('Circle.place' => $place),
										array('Circle.place' => "その他"),
									)
								),
							)
						),
					),
				);
			}
			else if($nochoice1 == "On"){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array(
									'OR' => array(
										array('Circle.place' => $place),
										array('Circle.place' => "その他"),
									)
								),
								array('Circle.mazime <=' => $mazime+1),
								array('Circle.mazime >=' => $mazime-1),
							)
						),
					),
				);
			}
			else if($nochoice2 == "On"){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' =>'%'. $word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array(
									'OR' => array(
										array('Circle.place' => $place),
										array('Circle.place' => "その他"),
									)
								),
								array('Circle.nomi <=' => $nomi+1),
								array('Circle.nomi >=' => $nomi-1),
							)
						),
					),
				);
			}
			else{
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.pr LIKE' => '%'.$word.'%')
								)
							),
							array(
								array('Circle.activity' => $activity2),
								array(
									'OR' => array(
										array('Circle.place' => $place),
										array('Circle.place' => "その他"),
									)
								),
								array('Circle.nomi <=' => $nomi+1),
								array('Circle.nomi >=' => $nomi-1),
								array('Circle.mazime <=' => $mazime+1),
								array('Circle.mazime >=' => $mazime-1),
							)
						),
					),
				);
			}
		}
		else if($place == "任意"){
			if($nochoice1 == "On" && $nochoice2 == "On"){
				$opt = array(
					array('Circle.activity' => $activity2),
				);
			}
			else if($nochoice1 == "On"){
				$opt = array(
					array('Circle.activity' => $activity2),
					array('Circle.mazime <=' => $mazime+1),
					array('Circle.mazime >=' => $mazime-1),
				);
			}
			else if($nochoice2 == "On"){
				$opt = array(
					array('Circle.activity' => $activity2),
					array('Circle.nomi <=' => $nomi+1),
					array('Circle.nomi >=' => $nomi-1),
				);
			}
			else{
				$opt = array(
					array('Circle.activity' => $activity2),
					array('Circle.nomi <=' => $nomi+1),
					array('Circle.nomi >=' => $nomi-1),
					array('Circle.mazime <=' => $mazime+1),
					array('Circle.mazime >=' => $mazime-1),
				);
			}
		}
		else{
			if($nochoice1 == "On" && $nochoice2 == "On"){
				$opt = array(
					array('Circle.activity' => $activity2),
					array(
						'OR' => array(
							array('Circle.place' => $place),
							array('Circle.place' => "その他"),
						)
					),
				);
			}
			else if($nochoice1 == "On"){
				$opt = array(
					array('Circle.activity' => $activity2),
					array(
						'OR' => array(
							array('Circle.place' => $place),
							array('Circle.place' => "その他"),
						)
					),
					array('Circle.mazime <=' => $mazime+1),
					array('Circle.mazime >=' => $mazime-1),
				);
			}
			else if($nochoice2 == "On"){
				$opt = array(
					array('Circle.activity' => $activity2),
					array(
						'OR' => array(
							array('Circle.place' => $place),
							array('Circle.place' => "その他"),
						)
					),
					array('Circle.nomi <=' => $nomi+1),
					array('Circle.nomi >=' => $nomi-1),
				);
			}
			else{
				$opt = array(
					array('Circle.activity' => $activity2),
					array(
						'OR' => array(
							array('Circle.place' => $place),
							array('Circle.place' => "その他"),
						)
					),
					array('Circle.nomi <=' => $nomi+1),
					array('Circle.nomi >=' => $nomi-1),
					array('Circle.mazime <=' => $mazime+1),
					array('Circle.mazime >=' => $mazime-1),
				);
			}
		}
		$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value DESC', 'Circle.man + Circle.woman DESC')));
		
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
		
		
		//検索結果カレンダー
	
	//circleのIdに一致するイベントを列挙
	$count = 10;		//10このサークルの予定だけを表示
	$circles = $this->Circle->find( 'list', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value DESC', 'Circle.man + Circle.woman DESC')));
	//10個のサークルのidを配列に入れる
	
	
	
	//circleのIdに一致するイベントを列挙
	

	$events = $this->Event->find( 'all', array( 'conditions' => array('Event.circle_id' => $circles)));
	//var_dump($events);
	
	//$events = $this->Event->find('all');
	$title = array();
	$day = array();
	
	// SQLのレスポンスをもとにデータ作成
	$rows = array();
	for ( $a=0; count( $events) > $a; $a++) {
		
		$rows[] = array(
			'id' => $events[$a]['Event']['id'],
		//'circle_id' => $events[$a]['Event']['circle_id'],
		//'circle_name' => $events[$a]['Event']['circle_name'],
            'title' => $events[$a]['Event']['circle_name'].":".$events[$a]['Event']['title'],
            'start' => date('Y-m-d', strtotime($events[$a]['Event']['day'])),
            'end' => $events[$a]['Event']['day'],
			'url' => "../Circles/event_id/".$events[$a]['Event']['id'],
		
            //'allDay' => $events[$a]['Event']['allday'],
	);
	}
	//var_dump($rows);
	// JSONへ変換
	$this->set("json", json_encode($rows));
		
		
	}
	
	
	
   
	}
	



}//クラス
	

?>