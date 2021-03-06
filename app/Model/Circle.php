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
		  'ruleName' => array(
            'rule' => 'isUnique',
			'required'=>'update',
			'message'=>'すでに同じ名前が登録されています。',
			'on'=>'update'
            // ここに on や required などその他のキーを書く
			),
		  'ruleName2' => array(
            'rule' => array('maxLength', 25),
			'required'=>'update',
			'message'=>'25文字まで入力できます',
			'on'=>'update'
            // ここに on や required などその他のキーを書く
		    ),
		  
        ),
		'url' => array(
          'rule' => array('url', true),
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
		'man' => array(
		  'rule'    => array('naturalNumber', true),	//0を含めた自然数
		  'allowEmpty' => true,
		  'message'=>'0以上の値を設定してください',
        ),
		'woman' => array(
		  'rule'    => array('naturalNumber', true),	//0を含めた自然数
		  'allowEmpty' => true,
		  'message'=>'0以上の値を設定してください',
        ),
		'cost_in' => array(
		  'rule'    => array('naturalNumber', true),	//0を含めた自然数
		  'allowEmpty' => true,
		  'message'=>'0以上の値を設定してください',
        ),
		'cost' => array(
		  'rule'    => array('naturalNumber', true),	//0を含めた自然数
		  'allowEmpty' => true,
		  'message'=>'0以上の値を設定してください',
        ),
		'pr' => array(
          'rule' => array('maxLength', 200),
		  //'required'=>update,
		  'message'=>'200文字以内で記述してください',
        )
		
		
        
    );
     

}
?>