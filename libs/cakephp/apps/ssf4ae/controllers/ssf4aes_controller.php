<?php
	class Ssf4aesController extends AppController{
		var $name = 'Ssf4aes';
		var $uses = array();
		//var $components  = array('DebugKit.Toolbar','Auth');
		var $components = array('RequestHandler');
		var $helpers = array('Javascript');
		var $paginate = array();
		function beforeFilter() {
		}
		function afterFilter() {
		}
		function index(){
			$this->render();
		}
		/*********************************************************************
			選手エントリーのフォーム
			セーブもここの分岐内で処理。
			重複チェックもモデルではなくこのコントローラー内で実行。
		*********************************************************************/
		function entry_form(){
			$this->loadModel('Ssf4ae_entry');
			$this->loadModel('Ssf4ae_character');
			$this->loadModel('Ssf4ae_entry_character');
			if(isset($this->params['form']['load'])){
				$conditions = array(
					'conditions' => array(
							'Ssf4ae_entry.game_id' => $this->data['Ssf4ae_entry']['game_id']
						,	'Ssf4ae_entry.password' => md5($this->data['Ssf4ae_entry']['password'])
									),
					'order' => array('Ssf4ae_entry.ssf4ae_entry_id'=>'DESC'),
					'limit' => 1
				);
				$load_data = $this->Ssf4ae_entry->find('all',$conditions);
				if($load_data){
					$load_data[0]["Ssf4ae_entry"]["password"] = $this->data['Ssf4ae_entry']['password'];
					$this->set('load_data',$load_data[0]);
					$conditions = array(
						'conditions' =>array(
							'Ssf4ae_entry_character.ssf4ae_entry_id' => $load_data[0]["Ssf4ae_entry"]["ssf4ae_entry_id"]
						)
					);
					$temp_charactors = $this->Ssf4ae_entry_character->find('all',$conditions);
					$charactors = array();
					foreach($temp_charactors as $temp_charactor){
						$charactors[$temp_charactor["Ssf4ae_entry_character"]["character_id"]] = $temp_charactor["Ssf4ae_entry_character"]["battlepoint"];
					}
					$this->set('charactors_bp',$charactors);
				}else{
					$this->set('load_data',$this->data);
				}
			}else{
				$this->set('load_data',$this->data);
				$unique_error = '';
				if($this->data){
					//フラグの初期化
					$valid_flag = true;
					//プレイヤー情報のvalidation
					$this->Ssf4ae_entry->set($this->data['Ssf4ae_entry']);
					if(!$this->Ssf4ae_entry->validates())$valid_flag = false;
					//重複チェック
					//キャラクター情報のvalidation
					foreach($this->data['Ssf4ae_entry_character'] as $index_name => $bp){
						if(isset($bp)&&!is_numeric($bp)&&$bp!=''){
							$entry_char_row['Ssf4se_entry_character']['entry_id']= 1;
							$entry_char_row['Ssf4se_entry_character']['character_id']= str_replace('battlepoint','',$index_name);
							$entry_char_row['Ssf4se_entry_character']['battlepoint']= $bp;
							$this->Ssf4_entry_character->set($entry_char_row);
							if(!$this->Ssf4_entry_character->validates())$valid_flag = false;
						}
					}
					if($valid_flag){
						//プレイヤー情報のセーブ
						$this->data['Ssf4ae_entriy']['entry_id'] = 0;
						if(strlen($this->data['Ssf4ae_entry']['password'])>0){
							$this->data['Ssf4ae_entriy']['password'] = md5($this->data['Ssf4ae_entry']['password']);
						}else{
							$this->data['Ssf4ae_entriy']['password'] = "";
						}
						$this->Ssf4ae_entry->save($this->data['Ssf4ae_entriy']);					////新規発行IDを取得
						$last_id = $this->Ssf4ae_entry->getLastInsertID();
						//キャラクター情報をセーブ
						foreach($this->data['Ssf4ae_entry_character'] as $index_name => $bp){
							if(isset($bp)&&is_numeric($bp)){
								$entry_char_row['Ssf4ae_entry_character']['ssf4ae_entry_characters_id']= 0;
								$entry_char_row['Ssf4ae_entry_character']['ssf4ae_entry_id']= $last_id;
								$entry_char_row['Ssf4ae_entry_character']['character_id']=str_replace('battlepoint','',$index_name);
								$entry_char_row['Ssf4ae_entry_character']['battlepoint']=$bp;
								$this->Ssf4ae_entry_character->save($entry_char_row);
							}
						}
						//登録一覧へ
						//$this->render();
						$this->redirect('entry_view');
						//return;
					}
				}
			}
			//表示用デフォルトデータ
			//BP入力欄生成用のデータ取得
			$params= array(
				'fields' => array('Ssf4ae_character.character_id','Ssf4ae_character.character_name'),
				'order' => 'Ssf4ae_character.character_id'
			);
			$characters = $this->Ssf4ae_character->find('all',$params);
			$this->set('platforms',array(1=>'PS3',2=>'XBOX360',3=>'PC(steam)'));
			$this->set('messenger_types',array(1=>'Skype',2=>'MSN Messenger',3=>'PSN',4=>'TeamSpeak3',5=>'その他(コメント欄)'));
			$this->set('characters',$characters);
			$this->set('title_for_layout', '対戦相手募集登録');
			$this->render();
		}
		/*********************************************************************
			戦いたい人表示部分
		*********************************************************************/
		function entry_view($tournament_id = null){
			$this->loadModel('Ssf4ae_entry');
			$this->loadModel('Ssf4ae_character');
			$this->loadModel('Ssf4ae_entry_character');
			//削除処理
			if(isset($this->params['form']['delete']) && strlen($this->data["Ssf4ae_entry"]["password"])>=1){
				if("48VYNcVYzstZtmqq6YisxbDoKDpSywCg"===$this->data["Ssf4ae_entry"]["password"]){
					var_dump($this->data['Ssf4ae_entry']);
					$del_data["Ssf4ae_entry"]["delete_flag"] = 1;
					$del_data["Ssf4ae_entry"]["ssf4ae_entry_id"] = $this->data['Ssf4ae_entry']['ssf4ae_entry_id'];
					$this->Ssf4ae_entry->save($del_data);
				}else{
					$conditions = array(
						'conditions' => array(
								'Ssf4ae_entry.ssf4ae_entry_id' => $this->data['Ssf4ae_entry']['ssf4ae_entry_id']
						)
					);
					$load_data = $this->Ssf4ae_entry->find('first',$conditions);
					if($load_data){
						if($load_data["Ssf4ae_entry"]["password"]==md5($this->data["Ssf4ae_entry"]["password"])){
							$del_data["Ssf4ae_entry"]["delete_flag"] = 1;
							$del_data["Ssf4ae_entry"]["ssf4ae_entry_id"] = $load_data["Ssf4ae_entry"]["ssf4ae_entry_id"];
							$this->Ssf4ae_entry->save($del_data);
						}
					}
				}
			}
			//現在募集中の登録者
			//$this->paginate = array(
			$now_date = new DateTime();
			$end_date = $now_date->format('Y/m/d H:i:s');
			date_add($now_date, date_interval_create_from_date_string('1 hours'));
			$start_date = $now_date->format('Y/m/d H:i:s');
			$params = array(
				'conditions' => array(
					'Ssf4ae_entry.start_datetime <=' => $start_date,
					'Ssf4ae_entry.end_datetime >' => $end_date
					,'Ssf4ae_entry.delete_flag' => 0
					)
				,
				'order' => array('Ssf4ae_entry.start_datetime'=>'ASC'),
				'recursive' => 2,
				'limit' => 65535
				);
			//$entrys = $this->paginate('Ssf4_entry');
			$entrys = $this->Ssf4ae_entry->find('all',$params);
			//各出場者の使用キャラを取得
			$characters = array();
			$entry_ids = array();
			foreach($entrys as $entry){
				$characters[$entry['Ssf4ae_entry']['ssf4ae_entry_id']] = $this->Ssf4ae_entry_character->find('all',array(
					'conditions' => array('Ssf4ae_entry_character.ssf4ae_entry_id' => $entry['Ssf4ae_entry']['ssf4ae_entry_id']),
					'fields' => array('Ssf4ae_character.character_name','Ssf4ae_entry_character.battlepoint'),
					'recursive' => 2,
					'order' => 'Ssf4ae_entry_character.battlepoint DESC',
					'limit' => 65535
					));
					$entry_ids[] = $entry['Ssf4ae_entry']['ssf4ae_entry_id'];
			}
			$this->set('characters',$characters);
			$this->set('platforms',array(1=>'PS3',2=>'XBOX360'));
			$this->set('messenger_types',array(1=>'Skype',2=>'MSN Messenger',3=>'PSN',4=>'TeamSpeak3',5=>'その他(コメント欄)'));
			$this->set('entrys',$entrys);
			$this->set('title_for_layout', '対戦相手募集中');
			$this->render();
		}
		function getLatestEntry(){
			// デバッグ情報出力を抑制
			Configure::write('debug', 0);
			// ajax用のレイアウトを使用
			$this->layout = "ajax";
			// ajaxによる呼び出し？
			if($this->RequestHandler->isAjax()) {
				$this->loadModel('Ssf4ae_entry');
				$now_date = new DateTime();
				$end_date = $now_date->format('Y/m/d H:i:s');
				date_sub($now_date, date_interval_create_from_date_string('1 hours'));
				$start_date = $now_date->format('Y/m/d H:i:s');
				$params = array(
					'conditions' => array(
						'Ssf4ae_entry.start_datetime >=' => $start_date,
						'Ssf4ae_entry.end_datetime >' => $end_date
						,'Ssf4ae_entry.delete_flag' => 0
						)
					,
					'order' => array('Ssf4ae_entry.start_datetime'=>'DESC'),
					'limit' => 1
					);
				//$entrys = $this->paginate('Ssf4_entry');
				$entrys = $this->Ssf4ae_entry->find('all',$params);
				if($entrys){
					$this->set('last_update',$entrys[0]["Ssf4ae_entry"]["created"]);
				}else{
					$this->set('last_update',null);
				}
			}
			$this->render();
		}
		/*********************************************************************
			RRGGBBの自動生成関数
			Googleのグラフ出力APIで使用
		*********************************************************************/
		function get_col(){
			$r = rand(128,255); 
			$g = rand(128,255); 
			$b = rand(128,255); 
			$color = dechex($r) . dechex($g) . dechex($b); 
			return $color;
		}
	}
?>
