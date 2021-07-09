<?php
session_start();
$t_account = $_POST["t_account"];
$t_pw = $_POST["t_pw"];


//1. 接続します
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_teachers_table WHERE t_account=:t_account AND t_pw=:t_pw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':t_account', $t_account);
$stmt->bindValue(':t_pw', $t_pw);
$res = $stmt->execute();

echo $res;

//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["t_account"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["tt_name"]   = $val['t_name'];
  $_SESSION["t_account"]  = $_POST["t_account"];
  $_SESSION["t_pw"]  = $_POST["t_pw"];
  //Login処理OKの場合select.phpへ遷移
  header("Location: t_mainmenu.php");
}else{
  $samural_alert = "IDまたはパスワードが違います";
// ②
  $alert = "<script type='text/javascript'>alert('". $samural_alert. "');</script>";
  // ③
  echo $alert;
  echo "<script language=javascript>location.href ='login.php'</script>";

  
}

//処理終了
exit();

?>


