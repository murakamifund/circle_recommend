<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Circle extends AppModel {
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
		
		'circle_name' => array(
          'rule'=>'isUnique',
		  'required'=>'update',
		  'message'=>'すでに同じ名前が登録されています。',
		  'on'=>'update'
        ),
		'url' => array(
          'rule'=>'url',
		  'allowEmpty' => true,
		  'message'=>'URLを入力してください。',
		  'on'=>'update'
        ),
		'phrase' => array(
          'rule' => array('maxLength', 25),
		  //'required'=>update,
		  'message'=>'25文字以内で記述してください',
        ),
		
		'activity' => array(
		  'rule' => 'notBlank',
		  'required'=>'update',
		  'message'=>'必須項目です。',
        ),
		
		'place' => array(
		  'rule' => 'notBlank',
		  'required'=>'update',
		  'message'=>'必須項目です。',
        ),
		'placetext' => array(
          'rule' => array('maxLength', 25),
		  'allowEmpty' => true,
		  //'required'=>update,
		  'message'=>'25文字以内で記述してください',
        ),
		'intercollege' => array(
		  'rule' => 'notBlank',
		  'required'=>'update',
		  'message'=>'必須項目です。',
        ),
		'pr' => array(
          'rule' => array('maxLength', 200),
		  //'required'=>update,
		  'message'=>'200文字以内で記述してください',
        )
		
		
        
    );
     

}
?>