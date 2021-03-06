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
	
		//検索wordを受け取り、分割
		if ($this -> request -> data){
			//サニタイズ
			$this->data = Sanitize::clean($this->data, array('remove_html' => true,'escape' =>false));
			if($this -> data["keyword"]){
				$keywords = $this -> data["keyword"];
				$kw = mb_convert_kana($keywords, 's');
				$words = preg_split('/[\s]+/', $kw, -1, PREG_SPLIT_NO_EMPTY);
				
			}
			else{
				$words = "";
			}
			$conditions['OR'] = array();
			foreach ($words as $count => $word) {
				$condition = array('OR' => array(array('Circle.circle_name LIKE' => '%'.$word.'%'),array('Circle.activity LIKE' => '%'.$word.'%'),array('Circle.pr LIKE' => '%'.$word.'%')));
				array_push($conditions['OR'], $condition);
			}
			//条件文
			
			$top_data = $this->Circle->find('all', array('conditions' => $conditions['OR'], 'order' => array('value' => 'desc'),'limit' => 100));
		}else/*検索をしていない場合*/{
			//検索データが入っていない時valueが高いものから順に全てのサークルを表示
			$top_data = $this->Circle->find('all', array('order' => array('value' => 'desc'),'limit' => 100));
		}

		//top_data内のサークルがお気に入りされているかをチェック
		$i = 0;
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

		
	}
}//クラス
	

?>