<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Event extends AppModel {

public $validate = array(
        
		'title' => array(
          'rule'=>'notBlank',
		  'required'=> true,
		  'message'=>'タイトルを入力してください',
        ),
		'place' => array(
          'rule' => array('maxLength',30),
		  'allowEmpty' => true,
		  'message'=>'30文字以内で記述してください',
        ),
		'money' => array(
		  'rule'    => array('naturalNumber', true),	//0を含めた自然数
		  'allowEmpty' => true,
		  'message'=>'0以上の金額を設定してください',
        ),
		'for_newcomer' => array(
		  'rule' => 'notBlank',
		  'required'=>true,
		  'message'=>'必須項目です。',
        ),
		'pr' => array(
          'rule' => array('maxLength', 200),
		  //'required'=>update,
		  'message'=>'200文字以内で記述してください',
        )
		
		
        
    );

}
