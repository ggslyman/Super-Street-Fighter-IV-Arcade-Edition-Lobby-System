<?php
	echo $this->Html->css(array('style','anytime'),false);
	echo $javascript->link(array('jquery-1.6.2.min','jquery-ui-1.8.16.custom.min','anytime','common'),false);
?>
<script type="text/javascript">
<!--
$(function(){
	AnyTime.picker( "field1",
			{ format: "%W, %M %D in the Year %z %E", firstDOW: 1 } );
		$(".datetimepicker").AnyTime_picker(
		{ format: "%Y/%m/%d %H:%i", labelTitle: "日時指定",
			labelHour: "Hora", labelMinute: "Minuto" } );
});
-->
</script>
<?php
	//エラー表示用タグ作成
	//
	function disp_error($errmsg){
		$err_head = '<font color="red">';
		$err_foot = '</font><BR />';
		return $err_head.$errmsg.$err_foot;
	}
?>
<?php
	echo "連絡、雑談その他は".$html->link('スパ4掲示板','http://jbbs.livedoor.jp/bbs/read.cgi/game/41719/1314297746/',null,null,false)."で<br/>";
	echo $html->link('対戦相手を探す。','entry_view',null,null,false)."<br/><br/><br/>";
?>
<h3>
	書き直しはできません<br />間違えた場合は削除してください。<br />
	またパスワードを入力しなかった場合は削除ができませんのでご了承ください。<br />
	登録期間に関しては実際に反応出来る時間を設定してください。<br />
	長期間表示されいる場合は予告なく削除される可能性があります。
</h3>
<?php
	//フォーム開始
	echo $form->create("ssf4aes",array("action"=>"entry_form","type"=>"post"));
	//大会IDをhiddenに設定
	//プレイヤー情報エラー処理
	if(isset($this->validationErrors["Ssf4aeEntry"])){
		foreach($this->validationErrors["Ssf4aeEntry"] as $error){
			echo disp_error($error);
		}
	}
?>
<table id="playerlist">
<?php
	//ps3id
?>
	<tr>
		<td>
			ゲームID
		</td>
		<td>
<?php
	echo $form->text("Ssf4ae_entry.game_id",array("value"=>$load_data["Ssf4ae_entry"]["game_id"],"size"=>"24"));
?>
		</td>
	</tr>
	<tr>
		<td>
			パスワード
		</td>
		<td>
<?php
	echo $form->password("Ssf4ae_entry.password",array("size"=>"24"));
	echo "<br/>※前回登録時にパスワードを入力すると、次回、ゲームID、パスワードを入力し、<br/>読込ボタンを押すことで各種情報を前回入力情報で補完します。<br/>また削除時のパスワードとしても使用されます。";
	echo $form->submit('読込', array('name' => 'load'));
?>
		</td>
	</tr>
	<tr>
		<td>
			機種
		</td>
		<td>
<?php
	echo $form->radio("Ssf4ae_entry.platform",$platforms,array('value'=>$load_data["Ssf4ae_entry"]["platform"],'legend' => false,'div' => false,'label' => false,'separator' => '<br />'));
?>
		</td>
	</tr>
	<tr>
		<td>
			ニックネーム
		</td>
		<td>
<?php
	//nickname
	echo $form->text("Ssf4ae_entry.nickname",array("value"=>$load_data["Ssf4ae_entry"]["nickname"],"size"=>"24"));
?>
		</td>
	</tr>
	<tr>
		<td>
			連絡手段
		</td>
		<td>
<?php
	echo $form->radio("Ssf4ae_entry.messenger_type",$messenger_types,array('value'=>$load_data["Ssf4ae_entry"]["messenger_type"],'legend' => false,'div' => false,'label' => false,'separator' => '<br />'));
?>
		</td>
	</tr>
	<tr>
		<td>
			連絡先(Skypeid等)
		</td>
		<td>
<?php
	echo $form->text("Ssf4ae_entry.messenger_id",array("value"=>$load_data["Ssf4ae_entry"]["messenger_id"],"size"=>"24"));
?>
		</td>
	</tr>
	<tr>
		<td>
			PP
		</td>
		<td>
<?php
	//playerpoint
	echo $form->text("Ssf4ae_entry.playerpoint",array("value"=>$load_data["Ssf4ae_entry"]["playerpoint"],"size"=>"5"));
?>
		</td>
	</tr>
	<tr>
		<td>
			プレイ予定時間
		</td>
		<td>
<?php
	//playerpoint
	echo $form->text("Ssf4ae_entry.start_datetime",array("value"=>$form->value("Ssf4ae_entry.start_datetime"),"size"=>"20","class"=>"datetimepicker")).'-'.$form->text("Ssf4ae_entry.end_datetime",array("value"=>$form->value("Ssf4ae_entry.end_datetime"),"size"=>"20","class"=>"datetimepicker"));
?>
		<br/>開始時刻は特に見ていませんが、終了日時を過ぎると表示されなくなります。<br/>特に日付をまたぐ募集の場合は気をつけて下さい。
		</td>
	</tr>
	<tr>
		<td>
			コメント
		</td>
		<td>
<?php
	//playerpoint
	echo $form->textarea("Ssf4ae_entry.comment",array("value"=>$load_data["Ssf4ae_entry"]["comment"],"cols"=>"40","rows"=>"10"));
?>
		</td>
	</tr>
</table>
<br>
<?php
	if(isset($this->validationErrors["Ssf4EntryCharacter"])){
		foreach($this->validationErrors["Ssf4EntryCharacter"] as $error){
			echo disp_error($error);
		}
	}
?>
<table>
<?php
	$idx=1;
	foreach($characters as $character){
		if($idx++%3==1)echo "<tr>";
		//use character
		echo '<td align="right">';
		echo $character["Ssf4ae_character"]["character_name"]."　";
		if($form->error("battlepoint"))echo $err_head.$form->error("battlepoint").$err_foot;
		if(isset($charactors_bp[$character["Ssf4ae_character"]["character_id"]])){
			$bp_value = $charactors_bp[$character["Ssf4ae_character"]["character_id"]];
		}else{
			$bp_value = $form->value("Ssf4_entry_character.battlepoint".$character["Ssf4ae_character"]["character_id"]);
		}
		echo "BP：".$form->text("Ssf4ae_entry_character.battlepoint".$character["Ssf4ae_character"]["character_id"],array("value"=>$bp_value,"size"=>"5"))."<BR>";
		echo '</td>';
		if($idx++%3==0)echo "</tr>";
	}
	echo "</table>";
	echo $form->end('登録');
?>