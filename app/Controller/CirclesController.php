<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class CirclesController extends AppController {
	var $uses = array('Circle','Event');
	
	
	
	public $components = array(
        'Session',
        'Auth' => array(
			'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Circle',
                    'fields' => array('username' => 'circle_name','password' => 'password')
					//2つで認証する場合、usernameとpasswordに対応するものが何かを明示する必要がある
                )
            
			),
            // ログイン後にジャンプ
            'loginRedirect' => array('controller' => 'Circles', 'action' => 'circle_edit_main'),
			//array('action'=>'edit',$data['User']['id'])
            // ログアウト後に /circles/circle_login へジャンプ
            'logoutRedirect' => array('controller' => 'Circles', 'action' => 'circle'))
        );
 
    public function beforeFilter() {
        // 各コントローラーの index と login を有効にする
        $this->Auth->allow('circle','circle_login','circle_resister','circle_resister_finish','circle_id','event_id');
		parent::beforeFilter();
		AuthComponent::$sessionKey = 'Auth.circles';
    }
	
	//circleページのコントローラー
	public function circle() {
	
    $this->modelClass = null;
	
	if ($this->request->is('post')) {
                      $this->data = Sanitize::clean($this->data, array('encode' => false));
			if ($this->Auth->login()) {
				 $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('サークル名かパスワードが間違っています。'));
			}
		}
	
   
	}
	
	//circle個別ページのコントローラー
	public function circle_id($id) {
	
   
    $this->Circle->id = $id;
	$this->set("circle_id",$id);//view側にデータをセット
	
	$data = $this->Circle->find('first',array(
		'conditions' => array('Circle.id' => $id)));
	$circle_name = $data['Circle']['circle_name'];
	$this->set("circle_name",$circle_name);//view側にデータをセット
	$twitterid = $data['Circle']['twitterid'];
	$this->set("twitterid",$twitterid);//view側にデータをセット
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
	$all = $data['Circle']['all'];
	$this->set("all",$all);//view側にデータをセット
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
    
  }
	
	
	//circle個別ページのコントローラー
	public function event_id($id) {
	
   
    $this->Event->id = $id;
	$this->set("event_id",$id);//view側にデータをセット
	
	$events = $this->Event->find('first',array(
		'conditions' => array('Event.id' => $id)));
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
	
    
    
  }
	
	
	public function circle_resister($id) {
	
    $this->modelClass = null;
	
	$this->set('student_id', $id);	//これでビュー側でstudent_idと指定してidを表示
	
	// post時の処理
	if ($this->request->is('post')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
            $this->Circle->create();
            if ($this->Circle->save($this->request->data)) {	//ここにfalseと入れればバリデーションを無視できる
			$this->Session->setFlash(__('登録完了しました。サークル名とパスワードはサークル内で共有してください。新たな変更がある場合は、サークル管理者ページからログインしてサークル情報を編集してください。'));
			$this->redirect(array('action' => 'circle_resister_finish'));
           
            } else {
                $this->Session->setFlash(__('登録に失敗しました。もう一度やり直してください。'));
				//debug($this->Circle->validationErrors);
            }
			
    }
   
	}
	
	public function circle_resister_finish() {
	
    $this->modelClass = null;
	
   
	}
	
	public function circle_edit_main(){
		$id = $this->Auth->user('id');
		$circle_name = $this->Auth->user('circle_name');
		$this->set('tmp', $id);	//これでビュー側でtmpと指定してidを表示
		$this->modelClass = null;;
	
		$this->Circle->id=$id;
	
		$this->set("circle_name",$circle_name);//view側にデータをセット
		/*
		view側で$circle_name['Circle]['circle_name']をechoで表示
		*/
	}
	
	
	
	public function circle_edit_cal(){
	$id = $this->Auth->user('id');
	$this->set('id', $id);
	$this->modelClass = null;
	
    $this->Circle->id=$id;
	$circle_name = $this->Auth->user('circle_name');
	$this->set("circle_name",$circle_name);//view側にデータをセット
	
	$data = $this->Event->find('all' , array('conditions' => array('Event.circle_id' => $id)));	//Eventのテーブルから、circle_idが一致するものを検索してデータを配列に入れる
	
    if ($this->request->is('post') || $this->request->is('put')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
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
	
	}
	
	public function circle_edit(){
	$id = $this->Auth->user('id');
	$this->set('tmp', $id);
	$this->modelClass = null;
	
    $this->Circle->id=$id;
	
	$circle_name = $this->Auth->user('circle_name');
	$this->set("circle_name",$circle_name);//view側にデータをセット
   
	
    if ($this->request->is('post') || $this->request->is('put')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
			//debug($this->request->data);
			
			$uploaddir = '../img';
			$uploadfile = $this->data['Circle']['photo'];
			var_dump(getcwd());
			$data = $this->data;
			$data["Circle"]["photo"] = $uploadfile["name"];
			var_dump($data);
			if(move_uploaded_file($uploadfile['tmp_name'],$uploaddir.DS.$uploadfile["name"])){
				var_dump("successed");
			}
			else{
				var_dump("failed");
			}
			
            if ($this->Circle->save($data, array('validate' => false))) {
				// $this->redirect(array('action'=>'follow')); //twitter
				$this->Session->setFlash(__('更新完了しました。'));
				//更新したらloginページに移動させる
				//$this->redirect(array('action' => 'circle_edit_main'));
            } else {
                $this->Session->setFlash(__('更新に失敗しました。'));
				
            }
            
    }
    else
    {
        $this->request->data=$this->Circle->read(null,$id);//更新画面の表示
		
		
    }
	}
	
	
	
	public function del($id) {
   
    $this->Circle->id = $id;

    if ($this->request->is('post') || $this->request->is('put')) {
      $this->data = Sanitize::clean($this->data, array('encode' => false));
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
            $this->data = Sanitize::clean($this->data, array('encode' => false));
			//debug($this->request->data);
			
            if ($this->Event->save($this->request->data, array('validate' => false))) {
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
      $this->data = Sanitize::clean($this->data, array('encode' => false));
      $this->Event->delete($this->request->data('Event.id'));
	  $this->redirect(array('action' => 'circle_edit_cal'));
    } else {
      $this->request->data = 
          $this->Event->read(null, $id);
    }
  }
 
	//サークルはログイン不要　あとで消す
	//ログアウト_login
	public function circle_logout() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'circle'));
	}
	
	//ログアウト_home
	public function circle_logout_home() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => '../Students/home'));
	}
	
	
	
  
  
	
}
	

?>