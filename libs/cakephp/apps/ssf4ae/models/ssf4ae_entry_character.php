<?php
	class Ssf4ae_entry_character extends AppModel {
		var $name = 'Ssf4ae_entry_character';
		var $primaryKey = 'ssf4ae_entry_characters_id';
		var $belongsTo  = array(
				'Ssf4ae_character' => array(
					'className' => 'Ssf4ae_character',
					'foreignKey' => 'character_id'
				)
			);
		var $virtualFields = array(
				'users' => 'count(1)',
				'bp' => 'sum(Ssf4ae_entry_character.battlepoint)',
				'av_bp' => 'round(sum(Ssf4ae_entry_character.battlepoint)/count(*))'
			);
		var $validate = array(
			'entry_id' => array(
				'rule1' => array(
					'rule' => 'numeric',
					'message' => 'エントリーIDを変更しないでください。'
				),
				'rule2' => array(
					'rule' => 'notEmpty',
					'message' => 'エントリーIDを変更しないでください。'
				)
			),
			'character_id' => array(
				'rule1' => array(
					'rule' => 'numeric',
					'message' => 'キャラクターIDを変更しないでください。'
				),
				'rule2' => array(
					'rule' => 'notEmpty',
					'message' => 'キャラクターIDを変更しないでください。'
				)
			),
			'battlepoint' => array(
				'rule1' => array(
					'rule' => 'numeric',
					'message' => 'BPは数字で入力してください。'
				)
			)
		);
	}
?>
