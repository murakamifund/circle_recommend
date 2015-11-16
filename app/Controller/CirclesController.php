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
            'logoutRedirect' => array('controller' => 'Circles', 'action' => 'circle_login'))
        );
 
    public function beforeFilter() {
        // 各コントローラーの index と login を有効にする
        $this->Auth->allow('circle_login','circle_resister');
		parent::beforeFilter();
		AuthComponent::$sessionKey = 'Auth.circles';
    }
	
	public function circle_resister() {
	
    $this->modelClass = null;
    $this->layout = "layout_circle";
    $this->set("header_for_layout","circlr recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
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
    $this->layout = "layout_circle_edit";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
	
   
	}
	
	public function circle_edit_main(){
		$id = $this->Auth->user('id');
		$circle_name = $this->Auth->user('circle_name');
		$this->set('tmp', $id);	//これでビュー側でtmpと指定してidを表示
		$this->modelClass = null;
		$this->layout = "layout_circle_edit";
		$this->set("header_for_layout","circle recommendation");
		$this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
		$this->set("msg", "Welcome to my layout!");
	
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
    $this->layout = "layout_circle_edit";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
    $this->Circle->id=$id;
	$circle_name = $this->Auth->user('circle_name');
	$this->set("circle_name",$circle_name);//view側にデータをセット
	
   
	
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
	
	public function circle_edit(){
	$id = $this->Auth->user('id');
	$this->set('tmp', $id);
	$this->modelClass = null;
    $this->layout = "layout_circle_edit";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
    $this->Circle->id=$id;
	
	$circle_name = $this->Auth->user('circle_name');
	$this->set("circle_name",$circle_name);//view側にデータをセット
   
	
    if ($this->request->is('post') || $this->request->is('put')) {
            $this->data = Sanitize::clean($this->data, array('encode' => false));
			//debug($this->request->data);
			
            if ($this->Circle->save($this->request->data, array('validate' => false))) {
				// $this->redirect(array('action'=>'follow')); //twitter
                $this->Session->setFlash(__('更新完了しました。'));
				//更新したらloginページに移動させる
				$this->redirect(array('action' => 'circle_edit_main'));
            } else {
                $this->Session->setFlash(__('更新に失敗しました。'));
				
            }
            
    }
    else
    {
        $this->request->data=$this->Circle->read(null,$id);//更新画面の表示
		
		
    }
	}
	
	//サークルのログイン
	public function circle_login() {
	$this->modelClass = null;
    $this->layout = "layout_circle";
    $this->set("header_for_layout","circle recommendation");
    $this->set("footer_for_layout",
        "copyright by 東京大学システム創成学科C. 2015.");
    $this->set("msg", "Welcome to my layout!");
	
	if ($this->request->is('post')) {
                      $this->data = Sanitize::clean($this->data, array('encode' => false));
			if ($this->Auth->login()) {
				 $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('サークル名かパスワードが間違っています。'));
			}
		}
	}
	
	public function del($id) {
  
    $this->layout = "layout_circle_edit";
   
    $this->Circle->id = $id;

    if ($this->request->is('post') || $this->request->is('put')) {
      $this->data = Sanitize::clean($this->data, array('encode' => false));
      $this->Circle->delete($this->request->data('Circle.id'));
	  $this->Session->destroy();
      $this->redirect(array('action'=>'circle_login'));
    } else {
      $this->request->data = 
          $this->Circle->read(null, $id);
    }
  }
 
	//サークルはログイン不要　あとで消す
	//ログアウト_login
	public function circle_logout() {
	$this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'circle_login'));
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