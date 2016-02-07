<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Student extends AppModel {
 /**
 * 保存時にパスワードをハッシュ化する
 */
	 
   public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['tw_access_token_secret'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['tw_access_token_secret'] = $passwordHasher->hash($this->data[$this->alias]['tw_access_token_secret']);
    }
    return true;
}

public $validate = array(
        'tw_user_id' => array(
          'rule'=>array('isUnique'),
		  'required'=>true,
		  'message'=>'すでに同じ名前が登録されています。',
		  'on'=>'create'
        ),
        
    );
     
}