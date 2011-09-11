<?php 
	echo $this->Html->css(array('style','sort'),false);
	echo $javascript->link(array('jquery-latest.js','jquery.tablesorter.min','jquery.timer'),false);
?>
<script type="text/javascript">
<!--
$(function(){
	$(".tablesorter").tablesorter({widgets:['zebra']});
	var latest_date = null;
	$.get("getLatestEntry", function(fastdata){
		latest_date = fastdata;
	});
	var second = false;
	var latest_date = null;
	$.timer(300000, function (timer) {
		if (!second) {
			$.get("getLatestEntry", function(data){
				latest_date = data;
			});
			second = true;
			timer.reset(300000);
		} else {
			$.get("getLatestEntry", function(data){
				if(latest_date < data){
					window.location.reload();
				}
			});
		}
	});

	$.timer(30000, function (timer) {
	});
});
-->
</script>
<div id="latest_update"></div>
<?php
	echo "連絡、雑談その他は".$html->link('スパ4掲示板','http://jbbs.livedoor.jp/bbs/read.cgi/game/41719/1314297746/',null,null,false)."で<br/>";
	echo $html->link('対戦相手を募集する。','entry_form',null,null,false)."<br/><br/><br/>";
if($entrys){
?>
<table id="entry" class="tablesorter">
<thead>
<tr>
<th width="60">募集<br>開始<br>時間</th>
<th width="60">終了<br>予定<br>時間</th>
<th width="30">機種</th>
<th width="60">ゲームID</th>
<th width="50">ニックネーム</th>
<th width="90">連絡手段</th>
<th width="150">連絡先(Skypeid等)</th>
<th width="40">PP</th>
<th width="200">コメント</th>
<th width="100">使用キャラ</th>
<th width="80">削除</th>
</tr>
</thead>
<tbody>
<?php
	foreach($entrys as $entry){
		echo $form->create("ssf4aes",array("action"=>"entry_view","type"=>"post"));
		echo '<tr><td>';
		echo str_replace(' ','<br/>',str_replace('-','/',substr($entry['Ssf4ae_entry']['start_datetime'],2,14)));
		echo '</td><td>';
		echo str_replace(' ','<br/>',str_replace('-','/',substr($entry['Ssf4ae_entry']['end_datetime'],2,14)));
		echo '</td><td>';
		echo $platforms[$entry['Ssf4ae_entry']['platform']];
		echo '</td><td>';
		echo $entry['Ssf4ae_entry']['game_id'];
		echo '</td><td>';
		echo $entry['Ssf4ae_entry']['nickname'];
		echo '</td><td align="right">';
		echo $messenger_types[$entry['Ssf4ae_entry']['messenger_type']];
		echo '</td><td>';
		echo $entry['Ssf4ae_entry']['messenger_id'];
		echo '</td><td>';
		echo $entry['Ssf4ae_entry']['playerpoint'];
		echo '</td><td>';
		echo nl2br(h($entry['Ssf4ae_entry']['comment']));
		echo '</td><td>';
			foreach($characters[$entry['Ssf4ae_entry']['ssf4ae_entry_id']] as $character){
				//echo '<div class="clearfix">';
				//echo '<div style="float:left">';
				echo $character['Ssf4ae_character']['character_name'];
				//echo '</div><div style="float:right">';
				//echo $character['Ssf4ae_entry_character']['battlepoint'];
				//echo '</div></div>';
				echo '<br/>';
			}
		echo '</td><td>';
		echo $form->hidden('Ssf4ae_entry.ssf4ae_entry_id', array('value'=>$entry['Ssf4ae_entry']['ssf4ae_entry_id']));
		echo $form->password('Ssf4ae_entry.password', array('value'=>"",'size'=>10)).$form->submit('削除', array('name' => 'delete'));
		echo '</td></tr>';
		echo '</form>';
	}
echo '</tbody>';
echo '</table>';
}
?>
登録期間に関しては実際に反応出来る時間を設定してください。<br />
長期間表示されいる場合は予告なく削除される可能性があります。<br />
<br />
今対戦できる相手が見つけられるという意味合いの為、<br/>
募集開始時間まで1時間以上あるデータは表示されません。<br/>
<br/>
NEW!：自動チェック処理を入れました。新たな募集を5分ごとにチェックし、<br/>
新規登録があった場合、自動的にリロードします。<br/>
JavaScriptはONにしてください。<br/>
<br/>
