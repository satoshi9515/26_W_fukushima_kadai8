<?php
session_start();
$s_account = $_POST["s_account"];
$s_pw = $_POST["s_pw"];


//1. 接続します
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_students_table WHERE s_account=:s_account AND s_pw=:s_pw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':s_account', $s_account);
$stmt->bindValue(':s_pw', $s_pw);
$res = $stmt->execute();


//SQL実行時にエラーがある場合
if($res==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//３．抽出データ数を取得
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
$val = $stmt->fetch(); //1レコードだけ取得する方法

//４. 該当レコードがあればSESSIONに値を代入
if( $val["s_account"] != "" ){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["s_name"]   = $val['s_name'];
  $_SESSION["s_account"]  = $_POST["s_account"];
  $_SESSION["s_pw"]  = $_POST["s_pw"];
  //Login処理OKの場合select.phpへ遷移
  header("Location: s_mainmenu.php");
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


