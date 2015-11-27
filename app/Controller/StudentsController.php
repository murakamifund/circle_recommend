<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class StudentsController extends AppController {
	var $uses = array('Student');

	public $components = array(
        'Session',
		'Cookie',
        'Auth' => array(
			'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Student',
                    'fields' => array('username' => 'student_name','password' => 'password')
					//2つで認証する場合、usernameとpasswordに対応するものが何かを明示する必要がある
                )
            
			),
            // ログイン後にジャンプ
            'loginRedirect' => array('controller' => 'Students', 'action' => 'student_edit'),
			//array('action'=>'edit',$data['User']['id'])
            // ログアウト後に /circles/circle_login へジャンプ
            'logoutRedirect' => array('controller' => 'Students', 'action' => 'studnet_login'))
        );
 
    public function beforeFilter() {
        // 各コントローラーの index と login を有効にする
        $this->Auth->allow('circle','home','student','link','student_login','student_tw_callback','about','recruit','student_login','student_resister','student_edit','student_tw_logout');
		parent::beforeFilter();
		AuthComponent::$sessionKey = 'Auth.students';
    }
	public function student_tw_callback(){
		//ユーザー認証をする関数
		require_once('config.php');
		require_once('codebird.php');
		session_start();
		

		\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
		$cb = \Codebird\Codebird::getInstance();

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
			$user = $stmt->fetch(); //結果を返す 
			if(!$user){ //取得したユーザーの情報がデータベースになければ 
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
				$user = $stmt->fetch();
			}
    
			//ログイン処理をする。ユーザー情報をセッションに格納する。
			if(!empty($user) && !isset($_SESSION['tw_user'])){
				session_regenerate_id(true); //セキュリティのためのおまじない
				$_SESSION['tw_user'] = $user; //ユーザー情報をセッションに格納
			}
    
    
			// send to same URL, without oauth GET parameters
			//$this->redirect(array('action' => 'student_edit'));
			//die();
			$id = $me->id_str;

		}
		$this->redirect(array('action' => 'student_edit/'.$id.''));
	}
	
	public function student_tw_logout(){
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
			if (isset($_COOKIE["PHPSESSID"])) {
				setcookie("PHPSESSID", '', time() - 1800, '/');
			}
		$this->redirect(array('action' => 'student_resister'));
	}
	
	public function student_resister() {
	
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
	$id = $this->Auth->user('id');
	$this->set('id', $id);
	
	$this->modelClass = null;
	
    if ($this->request->is('post') || $this->request->is('put')) {
			//ここでサニタイズする
            $this->data = Sanitize::clean($this->data, array('encode' => false));
			//debug($this->request->data);
			
            if ($this->Student->save($this->request->data, array('validate' => false))) {
				// $this->redirect(array('action'=>'follow')); //twitter
                $this->Session->setFlash(__('更新完了しました。'));
            } else {
                $this->Session->setFlash(__('更新に失敗しました。'));
				
            }
            
    }
    else
    {
        $this->request->data=$this->Student->read(null,$id);//更新画面の表示
		
		
    }
	}
	
	//生徒のログイン
	//生徒のログインを別のコントローラーで扱う必要あり
	public function student_login() {

	$this->modelClass = null;	
	if ($this->request->is('post')) {
			$this->data = Sanitize::clean($this->data, array('encode' => false));
			if ($this->Auth->login()) {
				 $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('アカウント名かパスワードが間違っています。'));
			}
		}
	}
 
	//ログアウト_login
	public function student_logout() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'student_login'));
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