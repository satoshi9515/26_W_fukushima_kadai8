 <?php
session_start();
//2. SESSION変数に値を代入！！
$s_account=$_SESSION["s_account"];
$s_pw =$_SESSION["s_pw"];

include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成

$sql = "SELECT * FROM gs_students_table WHERE s_account=:s_account AND s_pw=:s_pw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':s_pw', $s_pw, PDO::PARAM_STR);
$stmt->bindValue(':s_account', $s_account, PDO::PARAM_STR);
$status = $stmt->execute();
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
};
$s_id=$row["s_id"];

$ssql = "SELECT * FROM gs_course_table WHERE  s_id like '%$s_id%'";
$sstmt = $pdo->prepare($ssql);
$sstatus = $sstmt->execute();

$sview="";
if($sstatus==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $sstmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $sstatus = $sstmt->fetch(PDO::FETCH_ASSOC)){
    $sview .= '<p>'.$sstatus["c_name"].'</p>';
    
  }

}

$ksql = "SELECT count(*) as cnt_class, sum(c_length) as s_len FROM gs_course_table WHERE  s_id like '%$s_id%'";
$kstmt = $pdo->prepare($ksql);
$kstatus = $kstmt->execute();

$kview="";
if($kstatus==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $kstmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $kstatus = $kstmt->fetch(PDO::FETCH_ASSOC)){
    $kview .= '<p>授業数　'.$kstatus["cnt_class"].'コマ</p>';
    $kview .= '<p>授業時間　'.$kstatus["s_len"].'分</p>';
    
  }

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>学生メインメニュ</title>
  <link rel="stylesheet" href="samplemmmm.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



</head>
<body>
  <div class="header">
    <div class="univdisplay">学生　<?=$row["s_name"]?>さん</div>
    <ul class="header-menu">
      <li><a href="t_select.php">授業管理</a></li>
      <li><a href="mainmenu.php">受講状況</a></li>
      <li><a href="s_select.php">学生管理</a></li>
      <li><a href="logout.php">ログアウト</a></li>
      <li><a href="setting.php">各種設定</a></li>
    </ul>
  </div>

  <div id="container"> <!-- コンテナ -->
    <div id="itemA">
      <div>受講授業</div>
      <div><?=$sview?></div>

     
    </div> <!-- アイテム -->

    <div id="itemB">
      <div>授業統計</div>
      <div><?=$kview?></div>
     
    </div>
    
    <div id="itemC">
      <div>学生情報</div>
      

    </div>
  </div>
</body>
</html>
