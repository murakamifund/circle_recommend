<?php session_start();?>
<?php
ini_set("memory_limit","512M");
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class StudentsController extends AppController {
	var $uses = array('Circle','Event','Favorite','Student');
	//public $components = array('Security');
	
    public function beforeFilter() {   
		parent::beforeFilter();
    }
	
	
	public function pre_student_tw_callback(){
		$this->Session->destroy();
		$this->redirect(array('action' => 'student_tw_callback'));
	}
	
	public function student_tw_callback(){
		//ユーザー認証をする関数
		
		require_once('config.php');
		require_once('codebird.php');
		
		try{ //例外処理

			\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
			$cb = \Codebird\Codebird::getInstance();
			
			//sessionを持っていない場合
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
				//基本はここ
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
						
						$dbh = new PDO(DSN,DB_USER,DB_PASSWORD);
						
					}catch(PDOException $e){
						echo $e->getMessage();
						exit;
					}
    
					$sql = "select * from students where tw_user_id = :tw_user_id limit 1"; 
					$stmt = $dbh->prepare($sql);
					$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
					$local_user = $stmt->fetch(); //結果を返す 
					if(isset($me->profile_banner_url)){
					}else{
						$me->profile_banner_url ="";
					}	
					if(!$local_user){ //取得したユーザーの情報がデータベースになければ 
						$sql = "insert into students 
						(tw_user_id,tw_name,tw_screen_name,tw_profile_image_url,tw_profile_banner_url,tw_description,tw_access_token) 
						values
						(:tw_user_id,:tw_name,:tw_screen_name,:tw_profile_image_url,:tw_profile_banner_url,:tw_description,:tw_access_token)";
						$stmt = $dbh->prepare($sql);
						$params = array(
							":tw_user_id" => $me->id_str,
							":tw_name" => $me->name,
							":tw_screen_name" => $me->screen_name,
							":tw_profile_image_url" => $me->profile_image_url,
							":tw_profile_banner_url" => $me->profile_banner_url,
							":tw_description" => $me->description,
							":tw_access_token" => $reply->oauth_token//,
							//":tw_access_token_secret" => $reply->oauth_token_secret
						);
						$stmt->execute($params);

						$sql = "select * from students where tw_user_id = :tw_user_id limit 1"; 
						$stmt = $dbh->prepare($sql);
						$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
						$local_user = $stmt->fetch();
					}
			
					$tw_user_id = $me->id_str;
					$_SESSION['tw_user_id'] = $tw_user_id; //ユーザー情報をセッションに格納
					$_SESSION['is_circle'] = false;
					$_SESSION['tw_screen_name'] = $me->screen_name;
					$_SESSION['tw_image_url'] = $me->profile_image_url;
					
					
					$this->redirect(array('action' => 'student_edit'));		//生徒編集ページに移動
				
				}else{
					$this->Session->destroy(); //セッションを完全削除
					$this->redirect(array('action' => 'student_resister'));
				}
			//sessionを持っている場合
			}else{
				$this->redirect(array('action' => 'student_edit'));
			}	
		}catch(Exception $e){
			//echo '捕捉した例外: ',  $e->getMessage(), "\n";
			$this->Session->setFlash(__('エラーが発生しました。もう一度お試しください。'));
			$this->redirect(array('action' => 'student_resister'));
		}
	}//student_tw_callback終わり

	
	public function pre_circle_tw_callback(){
		$this->Session->destroy();
		$this->redirect(array('action' => 'circle_tw_callback'));
	}//pre_circle_tw_callback終わり
	
	public function circle_tw_callback(){
		//ユーザー認証をする関数
		require_once('config.php');
		require_once('codebird.php');
		
		try{ //例外処理
		
		\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
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
				$_SESSION['is_circle'] = true;

			// redirect to auth website
				$auth_url = $cb->oauth_authorize(); //Twitterの認証画面に飛ばしている
				header('Location: ' . $auth_url);
				die();

			}elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
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
					
					$dbh = new PDO(DSN,DB_USER,DB_PASSWORD);
					
				}catch(PDOException $e){
					echo $e->getMessage();
					exit;
				}
    
				$sql = "select * from circles where tw_user_id = :tw_user_id limit 1"; 
				$stmt = $dbh->prepare($sql);
				$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
				$local_user = $stmt->fetch(); //結果を返す 
				if(isset($me->profile_banner_url)){
				}else{
					$me->profile_banner_url ="";
				}
				if(!$local_user){ //取得したユーザーの情報がデータベースになければ 
					$sql = "insert into circles 
					(tw_user_id,tw_screen_name,tw_profile_image_url,tw_profile_banner_url,tw_access_token,circle_name,pr) 
					values
					(:tw_user_id,:tw_screen_name,:tw_profile_image_url,:tw_profile_banner_url,:tw_access_token,:circle_name,:pr)";
					$stmt = $dbh->prepare($sql);
					$params = array(
					":tw_user_id" => $me->id_str,
					":tw_screen_name" => $me->screen_name,
					":tw_profile_image_url" => $me->profile_image_url,
					":tw_profile_banner_url" => $me->profile_banner_url,
					":tw_access_token" => $reply->oauth_token,
					":circle_name" => $me->name,
					":pr" => $me->description,
					);
					$stmt->execute($params);
					
					$sql = "select * from circles where tw_user_id = :tw_user_id limit 1"; 
					$stmt = $dbh->prepare($sql);
					$stmt->execute(array(":tw_user_id" => $me->id_str)); //prepareでsql文を入れ、executeで実行する
					$local_user = $stmt->fetch();
				
					$tw_user_id = $me->id_str;
					$_SESSION['tw_user_id'] = $tw_user_id; //ユーザー情報をセッションに格納
					$_SESSION['is_circle'] = true;
					$_SESSION['tw_screen_name'] = $me->screen_name; //サークルの場合は、tw_screen_nameも格納する。これでサークルかどうか判断
					$_SESSION['tw_image_url'] = $me->profile_image_url;
			
					$this->redirect(array('action' => 'circle_edit'));
				//データベースにすでに存在するがsessionはなかった時
				}else{
					
					//update
					$sql = "UPDATE circles SET tw_screen_name = :tw_screen_name, tw_profile_image_url = :tw_profile_image_url, tw_profile_banner_url = :tw_profile_banner_url, tw_access_token = :tw_access_token where tw_user_id = :tw_user_id";
					$stmt = $dbh->prepare($sql);
					$params = array(
					":tw_user_id" => $me->id_str,
					":tw_screen_name" => $me->screen_name,
					":tw_profile_image_url" => $me->profile_image_url,
					":tw_profile_banner_url" => $me->profile_banner_url,
					":tw_access_token" => $reply->oauth_token,
					);
					$stmt->execute($params);
					
					$tw_user_id = $me->id_str;
					$_SESSION['tw_user_id'] = $tw_user_id; //ユーザー情報をセッションに格納
					$_SESSION['is_circle'] = true;
					$_SESSION['tw_screen_name'] = $me->screen_name; //サークルの場合は、tw_screen_nameも格納する。これでサークルかどうか判断
					$_SESSION['tw_image_url'] = $me->profile_image_url;
					$this->redirect(array('action' => 'circle_edit_main'));
				}
		
			}else{
				$this->Session->destroy(); //セッションを完全削除
				$this->redirect(array('action' => 'student_resister'));
			}	
		}else{
			//ログイン済み
			$this->redirect(array('action' => 'circle_edit_main'));
		}
		
		}catch(Exception $e){
			$this->Session->setFlash(__('エラーが発生しました。もう一度お試しください。'));
			$this->redirect(array('action' => 'student_resister'));
		}
	}//circle_tw_callback終わり
	
	public function student_tw_logout(){
       
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
			if (isset($_COOKIE["PHPSESSID"])) {
				setcookie("PHPSESSID", '', time() - 1800, '/');
			}
		$this->redirect(array('action' => 'home'));
	}
	
	public function student_resister() {
		if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']==false){
			$this->redirect(array('action' => 'student_edit'));
		}else if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']==true){
			$this->redirect(array('action' => 'circle_edit_main'));
		}
	}
	
	public function student_edit(){
		if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']==false){
			//userを持っていたら
			$tw_user_id = $_SESSION['tw_user_id'];
			$this->set('tw_user_id', $tw_user_id);
			$local_user = $this->Student->find('first', array(
                'conditions' => array('tw_user_id' => $tw_user_id)
            ));
			$user_name = $local_user['Student']['tw_name'];
			$user_screen_name = $local_user['Student']['tw_screen_name'];
			$user_profile_image = $local_user['Student']['tw_profile_image_url'];
			$user_description = $local_user['Student']['tw_description'];
			$this->set('user_name', $user_name);
			$this->set('user_screen_name', $user_screen_name);
			$this->set('user_profile_image',$user_profile_image);
			$this->set('user_description', $user_description);
			
			//お気に入りのサークルidを検索
			$local_user_favorite = $this->Favorite->find('all', array(
                'conditions' => array('user_id' => $tw_user_id)
            ));
			
			
			$user_favorite_circle_id = array(); //お気に入りのサークルのidを格納する配列
			$user_favorite_circle = array();
			$local_circle = array();
			for ($i=0;$i<count($local_user_favorite);$i++){
				array_push($user_favorite_circle_id,$local_user_favorite[$i]['Favorite']['circle_id']);
			}
			for ($i=0;$i<count($user_favorite_circle_id);$i++){
				$local_circle = $this->Circle->find('first', array(
                'conditions' => array('id' => $user_favorite_circle_id[$i])
	            ));
				if($local_circle!=false){
					array_push($user_favorite_circle,$local_circle);
				}
				
			}
			$this->set('user_favorite_circle',$user_favorite_circle);
			$this->set('local_circle',$local_circle);
			$this->set('data',$user_favorite_circle);
			
		}else{
			$autoRender = false; 
			$this->redirect(array('action' => 'student_resister'));
		}
		
		//カレンダーの機能
	
	//circleのIdに一致するイベントを列挙
	
	$events = $this->Event->find( 'all', array( 'conditions' => array('Event.circle_id' => $user_favorite_circle_id)));
	$count = $this->Event->find( 'count', array( 'conditions' => array('Event.circle_id' => $user_favorite_circle_id)));
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
			'url' => "event_id/".$events[$a]['Event']['id'],
		
            //'allDay' => $events[$a]['Event']['allday'],
	);
	}
	
	// JSONへ変換
	$this->set("json", json_encode($rows));
	
	}
	
	//homeページのコントローラー
	public function home() {
	
		$this->modelClass = null;
		$total_user = $this->Student->find('count');
		$this->set("total_user",$total_user);//view側にデータをセット
		$total_circle = $this->Circle->find('count');
		$this->set("total_circle",$total_circle);//view側にデータをセット
		$suggest_circle = $this->Circle->find('all',array(
			'limit' => 30,
			'fields' => array('Circle.circle_name','Circle.tw_profile_image_url','Circle.id','Circle.tw_screen_name')
		));
		$suggest_circle[0] = $this->Circle->find('first',array(
			'conditions' => array(
				'Circle.circle_name' => 'UT-Circle'
			),
			'fields' => array('Circle.circle_name','Circle.tw_profile_image_url','Circle.id','Circle.tw_screen_name')
		));
		$this->set("suggest_circle",$suggest_circle);//view側にデータをセット
	}
	
	//aboutページのコントローラー
	public function about() {
		$this->modelClass = null;
	}
	
	
	//circleページのコントローラー
	public function circle() {
		$this->modelClass = null;
	}
	
	//circle個別ページのコントローラー
	public function circle_id($id) {
	
    $this->Circle->id = $id;
	$this->set("circle_id",$id);//view側にデータをセット
	
	$data = $this->Circle->find('first',array(
		'conditions' => array('Circle.id' => $id)));
	$circle_name = $data['Circle']['circle_name'];
	//名前のnull処理
	if(is_null($circle_name)){
		$circle_name = "サークルが存在していません";
	}
	$this->set("circle_name",$circle_name);//view側にデータをセット
	$tw_user_id = $data['Circle']['tw_user_id'];
	$this->set("tw_user_id",$tw_user_id);//view側にデータをセット
	$tw_profile_banner_url = $data['Circle']['tw_profile_banner_url'];
	$this->set("tw_profile_banner_url",$tw_profile_banner_url);//view側にデータをセット
	$tw_screen_name = $data['Circle']['tw_screen_name'];
	$this->set("tw_screen_name",$tw_screen_name);//view側にデータをセット
	$url = $data['Circle']['url'];
	$this->set("url",$url);//view側にデータをセット
	$activity = $data['Circle']['activity'];
	$this->set("activity",$activity);//view側にデータをセット
	$place = $data['Circle']['place'];
	$this->set("place",$place);//view側にデータをセット
	$placetext = $data['Circle']['placetext'];
	$this->set("placetext",$placetext);//view側にデータをセット
	$intercollege = $data['Circle']['intercollege'];
	$this->set("intercollege",$intercollege);//view側にデータをセット
	$man = $data['Circle']['man'];
	$this->set("man",$man);//view側にデータをセット
	$woman = $data['Circle']['woman'];
	$this->set("woman",$woman);//view側にデータをセット
	$cost_in = $data['Circle']['cost_in'];
	$this->set("cost_in",$cost_in);//view側にデータをセット
	$cost = $data['Circle']['cost'];
	$this->set("cost",$cost);//view側にデータをセット
	$cost = $data['Circle']['cost'];
	$this->set("cost",$cost);//view側にデータをセット
	$cost = $data['Circle']['cost'];
	$this->set("cost",$cost);//view側にデータをセット
	$nomi = $data['Circle']['nomi'];
	$this->set("nomi",$nomi);//view側にデータをセット
	$mazime = $data['Circle']['mazime'];
	$this->set("mazime",$mazime);//view側にデータをセット

	$day = array($data['Circle']['day1'],$data['Circle']['day2'],$data['Circle']['day3'],$data['Circle']['day4'],$data['Circle']['day5'],$data['Circle']['day6'],$data['Circle']['day7']);
	$this->set("day",$day);
	
	$pr = $data['Circle']['pr'];
	$this->set("pr",$pr);//view側にデータをセット
	
	//favされているか判定
	if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']!=true){
		$tw_user_id = $_SESSION['tw_user_id'];
		$fav_circles = $this->Favorite->find('all', array(
			'conditions' => array('user_id' => $tw_user_id,'circle_id' => $id)
		));		
		if (!empty($fav_circles)) {
			$this->set('favored', true );
		}else{
			$this->set('favored', false );
		}
	}else{
		$this->set('favored', false );
	}
	
	//カレンダーの機能
	
	//circleのIdに一致するイベントを列挙
	$events = $this->Event->find( 'all', array( 'conditions' => array('Event.circle_id' => $id)));
	$count = $this->Event->find( 'count', array( 'conditions' => array('Event.circle_id' => $id)));
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
			'url' => "../event_id/".$events[$a]['Event']['id'],
		
            //'allDay' => $events[$a]['Event']['allday'],
	);
	}
	
	// JSONへ変換
	$this->set("json", json_encode($rows));
	
	
	}//circle_idの終わり
	
	public function fav($id = null){
		if ($this->request->is('post') || $this->request->is('put')) {
			if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']!=true){
				//userを持っていたら
				$tw_user_id = $_SESSION['tw_user_id'];
				$this->set('tw_user_id', $tw_user_id );
				$fav_circles = $this->Favorite->find('all', array(
					'conditions' => array('user_id' => $tw_user_id,'circle_id' => $id)
				));
				$circle = $this->Circle->find('all', array(
					'conditions' => array('id' => $id)
				));
				
				if (!empty($fav_circles)) {
					$this->Session->setFlash(__('すでにお気に入り登録されています'));
				}else{
					//$this->Favorite->create();
					
					$this->Favorite->save([
					  'user_id' => $tw_user_id,
					  'circle_id' => $id,
					]);
					$circle_value = $circle[0]['Circle']['value'];
					$circle_value1 = $circle[0]['Circle']['value1'];
					$circle_value2 = $circle[0]['Circle']['value2'];
					$circle_value3 = $circle[0]['Circle']['value3'];
					$circle_value4 = $circle[0]['Circle']['value4'];
					$circle_value5 = $circle[0]['Circle']['value5'];
					$circle_value6 = $circle[0]['Circle']['value6'];
					$circle_value7 = $circle[0]['Circle']['value7'];
					$circle_value += 1;
					$circle_value1 += 1;
					$circle_value2 += 1;
					$circle_value3 += 1;
					$circle_value4 += 1;
					$circle_value5 += 1;
					$circle_value6 += 1;
					$circle_value7 += 1;
					$circle[0]['Circle']['value'] = $circle_value;
					$circle[0]['Circle']['value1'] = $circle_value1;
					$circle[0]['Circle']['value2'] = $circle_value2;
					$circle[0]['Circle']['value3'] = $circle_value3;
					$circle[0]['Circle']['value4'] = $circle_value4;
					$circle[0]['Circle']['value5'] = $circle_value5;
					$circle[0]['Circle']['value6'] = $circle_value6;
					$circle[0]['Circle']['value7'] = $circle_value7;
					$this->Circle->save($circle[0]['Circle']);
					
					$this->Session->setFlash(__('お気に入り登録しました'));
				}
				if($_POST['address']=="student_edit"){
					//$this->redirect(array('action'=>'student_edit/'));
				}else if($_POST['address']=="student" || $_POST['address']=="circle_id"){
					$this->redirect(array('action'=>'circle_id/'.$id));
				}else{
					$this->redirect(array('action'=>'student'));
				}
				
			}else{
				$this->redirect(array('action'=>'circle_id/'.$id));
				$this->Session->setFlash(__('Twitterでログインしてください'));
			}
		}else{
		
		}
	
	}//favの終わり
	
	public function unfav($id = null){
		if ($this->request->is('post') || $this->request->is('put')) {
			if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']!=true){
				//userを持っていたら
				$tw_user_id = $_SESSION['tw_user_id'];
				$fav_circles = $this->Favorite->deleteAll(array('user_id' => $tw_user_id,'circle_id' => $id));
				$circle = $this->Circle->find('all', array(
					'conditions' => array('id' => $id)
				));
				$circle_value = $circle[0]['Circle']['value'];
				$circle_value1 = $circle[0]['Circle']['value1'];
				$circle_value2 = $circle[0]['Circle']['value2'];
				$circle_value3 = $circle[0]['Circle']['value3'];
				$circle_value4 = $circle[0]['Circle']['value4'];
				$circle_value5 = $circle[0]['Circle']['value5'];
				$circle_value6 = $circle[0]['Circle']['value6'];
				$circle_value7 = $circle[0]['Circle']['value7'];
				$circle_value -= 1;
				$circle_value1 -= 1;
				$circle_value2 -= 1;
				$circle_value3 -= 1;
				$circle_value4 -= 1;
				$circle_value5 -= 1;
				$circle_value6 -= 1;
				$circle_value7 -= 1;
				$circle[0]['Circle']['value'] = $circle_value;
				$circle[0]['Circle']['value1'] = $circle_value1;
				$circle[0]['Circle']['value2'] = $circle_value2;
				$circle[0]['Circle']['value3'] = $circle_value3;
				$circle[0]['Circle']['value4'] = $circle_value4;
				$circle[0]['Circle']['value5'] = $circle_value5;
				$circle[0]['Circle']['value6'] = $circle_value6;
				$circle[0]['Circle']['value7'] = $circle_value7;
				$this->Circle->save($circle[0]['Circle']); 
				echo "<script>alert($tw_user_id);</script>"	;
				if($_POST['address']=="student_edit"){
					
					$this->redirect(array('action'=>'student_edit/'));
				}else if($_POST['address']=="student" || $_POST['address']=="circle_id"){
					$this->redirect(array('action'=>'circle_id/'.$id));
				}else{
					$this->redirect(array('action'=>'student'));
				}
			}else{
				$this->Session->setFlash(__('Twitterでログインしてください'));
				$this->redirect(array('action'=>'circle_id/'.$id));
			}
		}
	}//unfavの終わり
	
	//circle個別ページのコントローラー
	public function event_id($id) {
	
    $this->Event->id = $id;
	$this->set("event_id",$id);//view側にデータをセット
	
	$events = $this->Event->find('first',array(
		'conditions' => array('Event.id' => $id)));
	$circleid = $events['Event']['circle_id'];
	$this->set("circleid",$circleid);//view側にデータをセット
	$circle_name = $events['Event']['circle_name'];
	$this->set("circle_name",$circle_name);//view側にデータをセット
	$title = $events['Event']['title'];
	$this->set("title",$title);//view側にデータをセット
	$day= $events['Event']['day'];
	$this->set("day",$day);//view側にデータをセット
	
	$place= $events['Event']['place'];
	$this->set("place",$place);//view側にデータをセット
	$money= $events['Event']['money'];
	$this->set("money",$money);//view側にデータをセット
	$for_newcomer= $events['Event']['for_newcomer'];
	$this->set("for_newcomer",$for_newcomer);//view側にデータをセット
	$practice= $events['Event']['practice'];
	$this->set("practice",$practice);//view側にデータをセット
	$game= $events['Event']['game'];
	$this->set("game",$game);//view側にデータをセット
	$camp= $events['Event']['camp'];
	$this->set("camp",$camp);//view側にデータをセット
	$party= $events['Event']['party'];
	$this->set("party",$party);//view側にデータをセット
	$other= $events['Event']['other'];
	$this->set("other",$other);//view側にデータをセット
	if(isset($events['Event']['content'])){
		$contents= $events['Event']['content'];
		$this->set("contents",$contents);//view側にデータをセット
	}
	
    
    
  }//event_idの終わり
	/*
	public function circle_resister() {
	
		$this->modelClass = null;
		if(isset($_SESSION['tw_user_id'])){
			//userを持っていたら(ここにくる場合は基本持っているはず)
			if($_SESSION['is_circle']==true){
				//サークルかどうか
				$tw_user_id = $_SESSION['tw_user_id'];
				$local_user = $this->Circle->find('first', array(
					'conditions' => array('tw_user_id' => $tw_user_id)
				));
				$circleid = $local_user['Circle']['id'];
				$this->set('circleid', $circleid);
				// post時の処理
				if ($this->request->is('post')) {
					$this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
					$this->Circle->create();
					if ($this->Circle->save($this->request->data)) {	//ここにfalseと入れればバリデーションを無視できる
						$this->redirect(array('action' => 'circle_edit_main'));
				   
					} else {
						$this->Session->setFlash(__('登録に失敗しました。もう一度やり直してください。'));
						//debug($this->Circle->validationErrors);
					}
				}else{ //postのelse
					$this->request->data=Sanitize::clean($this->Circle->read(null,$circleid), array('remove_html' => true,'escape' =>false));		//更新画面の表示
				}
			}else{
				//サークルじゃなかったら
				$this->redirect(array('action'=>'student_resister'));
			}
			
		}else{
			$this->redirect(array('action'=>'student_resister'));
			$this->Session->setFlash(__('Twitterと連携してください'));
		}
		
	}//circle_resisterの終わり
	*/
	
	public function circle_edit_main(){
		if(isset($_SESSION['tw_user_id'])){
		//基本はsessionを持っているはず
			if($_SESSION['is_circle']){
				//サークルかどうか
				$tw_user_id = $_SESSION['tw_user_id'];
				$local_user = $this->Circle->find('first', array(
					'conditions' => array('tw_user_id' => $tw_user_id)
				));
				$circle_name = $local_user['Circle']['circle_name'];
				$this->set("circle_name",$circle_name);//view側にデータをセット
				$id = $local_user['Circle']['id'];
				$this->set("id",$id);//view側にデータをセット
			}else{
				//サークルじゃなかったら
				$this->Session->destroy();	//一旦ログアウト状態
				$this->redirect(array('action'=>'circle_tw_callback'));
			}
			
		}else{
			$this->redirect(array('action'=>'student_resister'));
			$this->Session->setFlash(__('Twitterでログインしてください'));
		}
		
		$data = $this->Circle->find('first',array(
		'conditions' => array('Circle.id' => $id)));
	$circle_name = $data['Circle']['circle_name'];
	$this->set("circle_name",$circle_name);//view側にデータをセット
	$tw_user_id = $data['Circle']['tw_user_id'];
	$this->set("tw_user_id",$tw_user_id);//view側にデータをセット
	$tw_profile_banner_url = $data['Circle']['tw_profile_banner_url'];
	$this->set("tw_profile_banner_url",$tw_profile_banner_url);//view側にデータをセット
	$tw_screen_name = $data['Circle']['tw_screen_name'];
	$this->set("tw_screen_name",$tw_screen_name);//view側にデータをセット
	$url = $data['Circle']['url'];
	$this->set("url",$url);//view側にデータをセット
	$activity = $data['Circle']['activity'];
	$this->set("activity",$activity);//view側にデータをセット
	$place = $data['Circle']['place'];
	$this->set("place",$place);//view側にデータをセット
	$placetext = $data['Circle']['placetext'];
	$this->set("placetext",$placetext);//view側にデータをセット
	$intercollege = $data['Circle']['intercollege'];
	$this->set("intercollege",$intercollege);//view側にデータをセット
	$man = $data['Circle']['man'];
	$this->set("man",$man);//view側にデータをセット
	$woman = $data['Circle']['woman'];
	$this->set("woman",$woman);//view側にデータをセット
	$cost_in = $data['Circle']['cost_in'];
	$this->set("cost_in",$cost_in);//view側にデータをセット
	$cost = $data['Circle']['cost'];
	$this->set("cost",$cost);//view側にデータをセット
	$cost = $data['Circle']['cost'];
	$this->set("cost",$cost);//view側にデータをセット
	$cost = $data['Circle']['cost'];
	$this->set("cost",$cost);//view側にデータをセット
	$nomi = $data['Circle']['nomi'];
	$this->set("nomi",$nomi);//view側にデータをセット
	$mazime = $data['Circle']['mazime'];
	$this->set("mazime",$mazime);//view側にデータをセット

	$day = array($data['Circle']['day1'],$data['Circle']['day2'],$data['Circle']['day3'],$data['Circle']['day4'],$data['Circle']['day5'],$data['Circle']['day6'],$data['Circle']['day7']);
	$this->set("day",$day);
	
	$pr = $data['Circle']['pr'];
	$this->set("pr",$pr);//view側にデータをセット
	
	//favされているか判定
	if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']!=true){
		$tw_user_id = $_SESSION['tw_user_id'];
		$fav_circles = $this->Favorite->find('all', array(
			'conditions' => array('user_id' => $tw_user_id,'circle_id' => $id)
		));		
		if (!empty($fav_circles)) {
			$this->set('favored', true );
		}else{
			$this->set('favored', false );
		}
	}else{
		$this->set('favored', false );
	}
	
	//circleのIdに一致するイベントを列挙
			$id = $local_user['Circle']['id'];
			$events = $this->Event->find( 'all', array( 'conditions' => array('Event.circle_id' => $id)));
			$count = $this->Event->find( 'count', array( 'conditions' => array('Event.circle_id' => $id)));
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
					'start' => date('Y-m-d H:i', strtotime($events[$a]['Event']['day'])),
					//'end' => $events[$a]['Event']['day'],
					'url' => "event_id/".$events[$a]['Event']['id'],
					//'allDay' => $events[$a]['Event']['allday'],
					);
			}
			// JSONへ変換
			$this->set("json", json_encode($rows));
			
	
	
		
	} //circle_edit_main終わり
	
	
	
	public function circle_edit_cal(){
		$this->modelClass = null;
		if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']){
		//基本はsessionを持っているはず
			$tw_user_id = $_SESSION['tw_user_id'];
			$local_user = $this->Circle->find('first', array(
                'conditions' => array('tw_user_id' => $tw_user_id)
            ));
			$circle_name = $local_user['Circle']['circle_name'];
			$this->set("circle_name",$circle_name);//view側にデータをセット
			$id = $local_user['Circle']['id'];
			$this->set("id",$id);//view側にデータをセット
			
			$data = $this->Event->find('all' , array('conditions' => array('Event.circle_id' => $id)));	
			//Eventのテーブルから、circle_idが一致するものを検索してデータを配列に入れる
	
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
				//debug($this->request->data);
				
					if ($this->Event->save($this->request->data)) {
					// $this->redirect(array('action'=>'follow')); //twitter
						$this->Session->setFlash(__('更新完了しました。'));
						//更新したらloginページに移動させる
						$this->redirect(array('action' => 'circle_edit_cal'));
					} else {
						$this->Session->setFlash(__('更新に失敗しました。'));
					}
			}
			
			//circleのIdに一致するイベントを列挙
			$events = $this->Event->find( 'all', array( 'conditions' => array('Event.circle_id' => $id)));
			$count = $this->Event->find( 'count', array( 'conditions' => array('Event.circle_id' => $id)));
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
					'start' => date('Y-m-d H:i', strtotime($events[$a]['Event']['day'])),
					//'end' => $events[$a]['Event']['day'],
					'url' => "edit_event/".$events[$a]['Event']['id'],
					//'allDay' => $events[$a]['Event']['allday'],
					);
			}
			// JSONへ変換
			$this->set("json", json_encode($rows));
					
			
		}else{
			//不正なアクセス
			$this->redirect(array('action'=>'student_resister'));
			$this->Session->setFlash(__('Twitterでログインしてください'));
		}
	}//circle_edit_calの終わり
	
	public function circle_edit(){
		$this->modelClass = null;
		if(isset($_SESSION['tw_user_id']) && $_SESSION['is_circle']){
		//基本はsessionを持っているはず
			$tw_user_id = $_SESSION['tw_user_id'];
			$local_user = $this->Circle->find('first', array(
                'conditions' => array('tw_user_id' => $tw_user_id)
            ));
			$circle_name = $local_user['Circle']['circle_name'];
			$this->set("circle_name",$circle_name);//view側にデータをセット
			$id = $local_user['Circle']['id'];
			$this->set("id",$id);//view側にデータをセット

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
				$circle_value = 0;
				$circle_value1 = 0;//練習したい
				$circle_value2 = 0;//楽な方がいい
				$circle_value3 = 0;//飲みたい
				$circle_value4 = 0;//飲みたくない
				$circle_value5 = 0;//インカレがいい
				$circle_value6 = 0;//学内がいい
				$circle_value7 = 0;//人数重視
				
				if($local_user["Circle"]["url"] != ""){
					$circle_value += 5;
					$circle_value1 += 5;
					$circle_value2 += 5;
					$circle_value3 += 5;
					$circle_value4 += 5;
					$circle_value5 += 5;
					$circle_value6 += 5;
					$circle_value7 += 5;
				}
				if($local_user["Circle"]["pr"] != ""){
					$circle_value += 5;
					$circle_value1 += 5;
					$circle_value2 += 5;
					$circle_value3 += 5;
					$circle_value4 += 5;
					$circle_value5 += 5;
					$circle_value6 += 5;
					$circle_value7 += 5;
				}
				if($local_user['Circle']['intercollege'] = "学内"){
					$circle_value6 += 10;
				}
				if($local_user['Circle']['intercollege'] = "インカレ"){
					$circle_value5 += 10;
				}
				$circle_value7 += $local_user['Circle']['man'] + $local_user['Circle']['woman'];
				$circle_value1 += $local_user['Circle']['mazime'] * 5;
				$circle_value3 += $local_user['Circle']['nomi'] * 5;
				$circle_value2 += 25 - $local_user['Circle']['mazime'] * 5;
				$circle_value4 += 25 - $local_user['Circle']['nomi'] * 5;
				$favorite = $this->Favorite->find('count', array('conditions' => array('Favorite.circle_id' => $id)));
				//お気に入り数をvalueに加える
				$circle_value += $favorite;
				$circle_value1 += $favorite;
				$circle_value2 += $favorite;
				$circle_value3 += $favorite;
				$circle_value4 += $favorite;
				$circle_value5 += $favorite;
				$circle_value6 += $favorite;
				$circle_value7 += $favorite;
				$this->request->data['Circle']['id'] = $id;
				$this->request->data['Circle']['value'] = $circle_value;
				$this->request->data['Circle']['value1'] = $circle_value1;
				$this->request->data['Circle']['value2'] = $circle_value2;
				$this->request->data['Circle']['value3'] = $circle_value3;
				$this->request->data['Circle']['value4'] = $circle_value4;
				$this->request->data['Circle']['value5'] = $circle_value5;
				$this->request->data['Circle']['value6'] = $circle_value6;
				$this->request->data['Circle']['value7'] = $circle_value7;
			
				if ($this->Circle->save($this->request->data/*, array('validate' => false)*/)) {
					// $this->redirect(array('action'=>'follow')); //twitter
					$this->Session->setFlash(__('更新完了しました。'));
					//更新したらloginページに移動させる
					$this->redirect(array('action' => 'circle_edit_main'));
				} else {
					$this->Session->setFlash(__('更新に失敗しました。'));
				}
			}else{ //postのelse
				$this->request->data=Sanitize::clean($this->Circle->read(null,$id), array('remove_html' => true,'escape' =>false));
			}
		}else{
			//不正なアクセス
			$this->redirect(array('action'=>'student_resister'));
			$this->Session->setFlash(__('Twitterでログインしてください'));
		}
	}//circle_editの終わり
	
	
	//サークル情報の削除
	public function del($id) {
   
    $this->Circle->id = $id;
	$this->Session->destroy();
    if ($this->request->is('post') || $this->request->is('put')) {
      $this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
      $this->Circle->delete($this->request->data('Circle.id'));
	  $this->Session->destroy();
      $this->redirect(array('action'=>'circle'));
    } else {
      $this->request->data = 
          $this->Circle->read(null, $id);
    }
  }
  
  
  public function edit_event($id) {
   
    $this->Event->id = $id;
	$this->set("event_id",$id);//view側にデータをセット
	
	$events = $this->Event->find('first',array(
		'conditions' => array('Event.id' => $id)));
	$circle_name = $events['Event']['circle_name'];
	$this->set("circle_name",$circle_name);//view側にデータをセット
	$title = $events['Event']['title'];
	$this->set("title",$title);//view側にデータをセット
	
    if ($this->request->is('post') || $this->request->is('put')) {
            $this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
			//debug($this->request->data);
			
            if ($this->Event->save($this->request->data)) {
				// $this->redirect(array('action'=>'follow')); //twitter
                $this->Session->setFlash(__('更新完了しました。'));
				//更新したらloginページに移動させる
				$this->redirect(array('action' => 'circle_edit_cal'));
            } else {
                $this->Session->setFlash(__('更新に失敗しました。'));
				
            }
            
    }
    else
    {
        $this->request->data=$this->Event->read(null,$id);//更新画面の表示
		
		
    }
  }
  
  public function delete($id) {
   
    $this->Event->id = $id;
	$this->set("event_id",$id);//view側にデータをセット
    if ($this->request->is('post') || $this->request->is('put')) {
      $this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
      $this->Event->delete($this->request->data('Event.id'));
	  $this->Session->setFlash(__('予定を削除

しました。'));
	  $this->redirect(array('action' => 'circle_edit_cal'));
    } else {
      $this->request->data = 
          $this->Event->read(null, $id);
    }
  }
 
	
	
	//studentページのコントローラー
	public function student() {

	    $this->modelClass = null;
		
		/*
		//検索アルゴリズム
	    
	    //各種目について選択されているかをデータ化
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
		//検索データが入っていない時valueが高いものから順に全てのサークルを表示
		*/
		$top_data = $this->Circle->find('all', array('order' => array('value' => 'desc'),'limit' => 100));
		$i = 0;
		//top_data内のサークルがお気に入りされているかをチェック
		
	    if(isset($_SESSION['tw_user_id'])){
	        $tw_user_id = $_SESSION['tw_user_id'];
	        foreach($top_data as $top_datum){
	            $top_favored = $this->Favorite->find('count', array(
	                'conditions' => array('user_id' => $tw_user_id,'circle_id' => $top_datum['Circle']['id'])
	            ));
	            if($top_favored>0){
	                $top_data[$i]['Circle']['favored'] = true;
	            }else{
	                $top_data[$i]['Circle']['favored'] = false;
	            }
	            $i++;
	        }
	    }else{
	        for(;$i<count($top_data);$i++){
	            $top_data[$i]['Circle']['favored'] = false;
	        }
	    }
		
		$this -> set('top_data',$top_data);
		/*
		//検索条件を変数化
		if ($this -> request -> data){
			if($this -> data["keyword"]){
				$word = $this -> data["keyword"];
			}
			else{
				$word = "";
			}
			$sort = $this -> data["radio1"];//検索条件決定用変数
		}
		else{
			$word = "";
		}
		//サークルごとに活動日を表示
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
		$act=array(
			"1"=>'テニス',
			"2"=>'卓球',
			"3"=>'サッカー',
			"4"=>'野球',
			"5"=>'バスケ',
			"6"=>'バレー',
			"7"=>'バドミントン',
			"8"=>'ラグビー',
			"9"=>'ホッケー',
			"10"=>'水泳',
			"11"=>'武道',
			"12"=>'ダンス',
			"13"=>'登山',
			"14"=>'乗り物',
			"15"=>'スキー',
			"31"=>'政治・経済',
			"32"=>'放送・広告',
			"33"=>'語学',
			"34"=>'国際',
			"35"=>'コンピュータ',
			"36"=>'自然科学',
			"37"=>'法学',
			"38"=>'企業',
			"51"=>'ロック',
			"52"=>'ジャズ',
			"53"=>'クラシック',
			"54"=>'コーラス',
			"61"=>'映画・写真',
			"62"=>'演劇・お笑い',
			"63"=>'美術',
			"64"=>'文芸',
			"71"=>'旅行',
			"72"=>'アウトドア',
			"73"=>'ゲーム',
			"74"=>'グルメ',
			"75"=>'芸能',
			"81"=>'その他'
		);
		//チェックした種目のみを含めた配列を作る
		$activity2 = array();
		$a = 0;
		for($i=0;$i<37;$i++):
			if($activity[$i]=="On"):
				$activity2[$a]=$act[$counts[$i]];
				$a = $a+1;
			endif;
		endfor;
		$p=array("駒場","本郷","");
		$in=array("学内","インカレ","");
		if ($this -> request -> data){
			$this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
			//検索条件
			if($this -> data["keyword"] != ""){
				$opt = array(
					array(
						'OR' => array(
							array(
								'OR' => array(
									array('Circle.circle_name LIKE' => '%'.$word.'%'),
									array('Circle.activity LIKE' => '%'.$word.'%'),
									array('Circle.phrase LIKE' => '%'.$word.'%'),
								)
							),
							array(
								array('Circle.activity' => $activity2),
							)
						),
					),
				);
			}
			else{
				$opt = array(
					'Circle.activity' => $activity2
				);
			}
			//検索結果表示順
			if($sort == "練習したい"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value1 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else if($sort == "楽な方がいい"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value2 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else if($sort == "飲みたい"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value3 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else if($sort == "飲みたくない"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value4 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else if($sort == "インカレがいい"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value5 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else if($sort == "学内がいい"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value6 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else if($sort == "人数重視"){
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value7 DESC', 'Circle.man + Circle.woman DESC')));
			}
			else{
				$data = $this->Circle->find('all' , array('conditions' => $opt, 'order' => array('Circle.value DESC', 'Circle.man + Circle.woman DESC')));
			}
			
			//favの情報
			$i = 0;
			if(isset($_SESSION['tw_user_id'])){
				$tw_user_id = $_SESSION['tw_user_id'];
				foreach($data as $datum){
					$favored = $this->Favorite->find('count', array(
						'conditions' => array('user_id' => $tw_user_id,'circle_id' => $datum['Circle']['id'])
					));
					if($favored>0){
						$data[$i]['Circle']['favored'] = true;
					}else{
						$data[$i]['Circle']['favored'] = false;
					}
					$i++;
				}
			}else{
				for(;$i<count($data);$i++){
					$data[$i]['Circle']['favored'] = false;
				}
			}
			
			$this -> set('data',$data);
			
			$this -> set("activity",$activity);
			if (isset($day)):
				$this -> set("day",$day);
				$this -> set("day2",$day2);
			endif;
			$this -> set("p",$p);
			$this -> set("in",$in);
			
			
			
			
			//検索結果カレンダー
		
		//circleのIdに一致するイベントを列挙
		$count = 10;		//10このサークルの予定だけを表示
		if($sort == "練習したい"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value1 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else if($sort == "楽な方がいい"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value2 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else if($sort == "飲みたい"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value3 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else if($sort == "飲みたくない"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value4 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else if($sort == "インカレがいい"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value5 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else if($sort == "学内がいい"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value6 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else if($sort == "人数重視"){
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value7 DESC', 'Circle.man + Circle.woman DESC')));
		}
		else{
			$circles = $this->Circle->find( 'all', array( 'fields' => 'id','limit' => $count,'conditions' => $opt, 'order' => array('Circle.value DESC', 'Circle.man + Circle.woman DESC')));
		}
		//10個のサークルのidを配列に入れる
		
		
		
		//circleのIdに一致するイベントを列挙
		

		//検索順にイベントを配列に加えていく
		$events = array();
		for($i=0; $i<count($circles); $i++){
			$event_add = $this->Event->find( 'all', array( 'conditions' => array('Event.circle_id' => $circles[$i]['Circle']['id'])));
			$events = array_merge($events, $event_add);
		}
		//var_dump($events);
		
		//$events = $this->Event->find('all');
		$title = array();
		$day = array();
		
		// SQLのレスポンスをもとにデータ作成
		$rows = array();
		$first = array();
		$second = array();
		//イベントの日付がすでにsecondに入っていたらイベントを表示しない
		for ( $a=0; count( $events) > $a; $a++) {
			
			if(!in_array($events[$a]['Event']['day'], $second)){
				if(in_array($events[$a]['Event']['day'], $first)){
					$second[] = $events[$a]['Event']['day'];
				}
				if($this->Event->find('count', array('conditions' => array('Event.day' => $events[$a]['Event']['day']))) > 2){
					$first[] = $events[$a]['Event']['day'];
				}
				$rows[] = array(
					'id' => $events[$a]['Event']['id'],
					//'circle_id' => $events[$a]['Event']['circle_id'],
					//'circle_name' => $events[$a]['Event']['circle_name'],
					'title' => $events[$a]['Event']['circle_name'].":".$events[$a]['Event']['title'],
					'start' => date('Y-m-d', strtotime($events[$a]['Event']['day'])),
					'end' => $events[$a]['Event']['day'],
					'url' => "../Students/event_id/".$events[$a]['Event']['id'],
					//'allDay' => $events[$a]['Event']['allday'],
				);
			}
		}
		//var_dump($rows);
		// JSONへ変換
		$this->set("json", json_encode($rows));
			
			
		}
		*/
	}
	

}//クラス
	

?>