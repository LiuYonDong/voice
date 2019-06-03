<?php 
require_once 'AipSpeech.php';

const APP_ID = '15772196';
const API_KEY = 'SjrC17bdHV4BWWAlej5qD3f4';
const SECRET_KEY = 'jTnZHTlm2ee41z4GmYdz3KlRD4rRBwun';

$client = new AipSpeech(APP_ID, API_KEY, SECRET_KEY);

$data = $_POST;
#内容
$con = $_POST['con'];
#发音人选择, 0为普通女声，1为普通男生，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女声
$per = $_POST['per'];
#语速，取值0-15，默认为5中语速
$spd = $_POST['speed'];
#音调，取值0-15，默认为5中语调
$pit = $_POST['yd'];
#音量，取值0-9，默认为5中音量
$vol = $_POST['vocie'];
// 下载的文件格式, 3：mp3(default) 4： pcm-16k 5： pcm-8k 6. wav
$aue = 3;
$formats = array(3 => 'mp3', 4 => 'pcm', 5 =>'pcm', 6 => 'wav');
$format = $formats[$aue];
//urlencode($con)
$args = array(
	'per' => $per,
	'spd' => $spd,
	'pit' => $pit,
	'vol' => $vol,
);
$result = $client->synthesis($con, 'zh', 1, $args);
if(!is_array($result)){
	$filename = 'download/'.date('YmdHis',time()).rand(0000,1111).'.'.$format;
    file_put_contents($filename, $result);
    exit(json_encode(array('ok'=>true,'msg'=>$filename)));
}else{
	exit(json_encode(array('ok'=>false,'msg'=>$result['error_msg'])));
}



 ?>