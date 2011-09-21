<?php 
	echo $this->Html->css(array('style','sort'),false);
	echo $javascript->link(array('jquery-latest.js','jquery.tablesorter.min','jquery.timer','audio.min'),false);
?>
<script type="text/javascript">
<!--
function doReload() {
	window.location.reload();
}
$(function(){
	$(".tablesorter").tablesorter({widgets:['zebra']});
	var latest_date = false;
	var new_date = false;
	$.ajax({
		url: 'getLatestEntry',
		type: 'GET',
		dataType: 'text',
		timeout: 10000,
		success: function(data){
			latest_date = data;
			$("#latest_update").html(latest_date);
		}
	});
	$.timer(60000, function (timer) {
		if(!latest_date || latest_date==""){
			$.ajax({
				url: 'getLatestEntry',
				type: 'GET',
				dataType: 'text',
				timeout: 10000,
				success: function(data){
					latest_date = data;
					$("#latest_update").html(latest_date);
				}
			});
		}else{
			$.ajax({
				url: 'getLatestEntry',
				type: 'GET',
				dataType: 'text',
				timeout: 10000,
				success: function(data){
					new_date = data;
				}
			});
			if((latest_date < new_date) || (!latest_date && new_date)){
				audiojs.events.ready(function() {
					var as = audiojs.createAll();
				});
				setTimeout("doReload()",4000) 
			}
		}
	});
	$("#ts3toggle").click(function () {
		if ($("#whatsts3").is(":hidden")){
			$("#whatsts3").slideDown("slow");
		} else {
			$("#whatsts3").slideUp("slow");
		}
	});
});
-->
</script>
最終更新日時：<span id="latest_update"></span><br/><br/>
<div style="font-weight:bold;color:#CC0000">
ページを開いたままにしておくと、新規登録がされた時にスト2の乱入音が鳴ります。<br/>
対戦相手待ちの方はこのページを別タブにでも開いておいてください。<br/>
この機能を利用する場合にはJavaScriptはONにしてください。<br/>
</div>
<br/>

<?php
	echo "連絡、雑談その他は".$html->link('スパ4掲示板','http://jbbs.livedoor.jp/bbs/read.cgi/game/41719/1314297746/',array("target"=>"blank"),null,false)."で<br/>";
	echo $html->link('対戦相手を募集する。','entry_form',null,null,false)."<br/><br/>";
?>
<div id="ts3toggle">TeamSpeak3について</div>
<div id="whatsts3" style="display:none;">
スカイプだと煩わしい部分があったので試験的にスパ４用のチャット＆ボイスチャットサーバーを２４時間建てておいたから<br />
良かったら用途に合わせて自由に使ってみてくれお、ついでで建ててあるだけだからスパ４じゃなくても好きに使ってくれていいお<br />
一応俺は掲示板も使いつつ常駐させてみるお( ＾ω＾)<br />
<br />
サーバーIP:kiyo.orz.hm<br />
PW:peer<br />
<?php
	echo $html->link('TS3導入と日本語化','http://hovel.arcenserv.info/ts3/?%E3%82%AF%E3%83%A9%E3%82%A4%E3%82%A2%E3%83%B3%E3%83%88%2F%E5%B0%8E%E5%85%A5',array("target"=>"blank"),null,false);
	echo "<br/>";
	echo $html->link('TS3使い方','http://hovel.arcenserv.info/ts3/?%E3%82%AF%E3%83%A9%E3%82%A4%E3%82%A2%E3%83%B3%E3%83%88%2F%E6%A9%9F%E8%83%BD%E7%B4%B9%E4%BB%8B',array("target"=>"blank"),null,false);
?>
<br />
対戦待ちだったりアドバイスだったり使いやすいはず(｀・ω・´）<br />
どんどん利用してこ！してこ！<br />
</div><br/>
<?php
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
<th width="130">使用キャラ</th>
<th width="80">対戦状況</th>
<th width="80">削除</th>
</tr>
</thead>
<tbody>
<?php
	foreach($entrys as $entry){
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
				echo '<div class="clearfix">';
				echo '<div style="float:left">';
				echo $character['Ssf4ae_character']['character_name'];
				echo '</div><div style="float:right">';
				echo $character['Ssf4ae_entry_character']['battlepoint'];
				echo '</div></div>';
				echo '<br/>';
			}
		echo '</td><td>';
		echo $form->create("ssf4aes",array("action"=>"entry_view","type"=>"post"));
		echo $form->hidden('Ssf4ae_entry.ssf4ae_entry_id', array('value'=>$entry['Ssf4ae_entry']['ssf4ae_entry_id']));
		if($entry['Ssf4ae_entry']['now_fight_flag']==1){
			echo "対戦中<br/>";
			echo $form->password('Ssf4ae_entry.password', array('value'=>"",'size'=>10)).$form->submit('終了', array('name' => 'fight_end'));
		}else{
			echo "受付中<br/>";
			echo $form->password('Ssf4ae_entry.password', array('value'=>"",'size'=>10)).$form->submit('開始', array('name' => 'fight_start'));
		}
		echo '</form>';
		echo '</td><td>';
		echo $form->create("ssf4aes",array("action"=>"entry_view","type"=>"post"));
		echo $form->hidden('Ssf4ae_entry.ssf4ae_entry_id', array('value'=>$entry['Ssf4ae_entry']['ssf4ae_entry_id']));
		echo $form->password('Ssf4ae_entry.password', array('value'=>"",'size'=>10)).$form->submit('削除', array('name' => 'delete'));
		echo '</form>';
		echo '</td></tr>';
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
<audio style="display:none;" src="http://www.vash-ch.com/ssf4ae/files/HERE_COMES_A_NEW_CHALLENGER.mp3" autoplay="autoplay" />
