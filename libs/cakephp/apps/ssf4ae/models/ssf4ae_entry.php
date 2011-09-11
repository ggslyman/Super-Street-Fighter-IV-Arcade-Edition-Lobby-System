<?php
	class Ssf4ae_entry extends AppModel {
		var $name = 'Ssf4ae_entry';
		//テーブル名を正常に認識しないので明示
		var $primaryKey = 'ssf4ae_entry_id';
		var $validate = array(
			'ps3id' => array(
				'rule1' => array(
					'rule' => array('custom','/[a-zA-Z0-9\._-]+/'),
					'message' => 'PS3IDは半角英数のみです。'
				),
				'rule2' => array(
					'rule' => 'notEmpty',
					'message' => 'PS3IDは必須です。'
				)
			),
			'nickname' => array(
				'rule1' => array(
					'rule' => 'notEmpty',
					'message' => 'ニックネームは必須です。'
				)
			),
			'start_datetime' => array(
				'rule1' => array(
					'rule' => 'notEmpty',
					'message' => '開始予定時間は必須です。'
				)
			),
			'end_datetime' => array(
				'rule1' => array(
					'rule' => 'notEmpty',
					'message' => '終了予定時間は必須です。'
				)
			),
			'playerpoint' => array(
				'rule1' => array(
					'rule' => 'numeric',
					'message' => 'PPは数字で入力してください。'
				)
			)
		);
	}
?>
