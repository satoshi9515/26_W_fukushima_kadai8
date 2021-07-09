 <?php
session_start();
//2. SESSION変数に値を代入！！
$t_account=$_SESSION["t_account"];
$t_pw =$_SESSION["t_pw"];

include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成

$sql = "SELECT * FROM gs_teachers_table WHERE t_account=:t_account AND t_pw=:t_pw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':t_pw', $t_pw, PDO::PARAM_STR);
$stmt->bindValue(':t_account', $t_account, PDO::PARAM_STR);
$status = $stmt->execute();
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();
};
$t_id=$row["t_id"];

$csql = "SELECT * FROM gs_course_table WHERE t_id=:t_id";
$cstmt = $pdo->prepare($csql);
$cstmt->bindValue(':t_id', $t_id, PDO::PARAM_INT);
$cstatus = $cstmt->execute();

$cview="";
if($cstatus==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $cstmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $cstatus = $cstmt->fetch(PDO::FETCH_ASSOC)){
    $cview .= '<p>'.$cstatus["c_name"].'</p>';
    
  }

}

$tsql = "SELECT count(*) as cnt_class, sum(c_length) as sum_len FROM gs_course_table WHERE t_id=:t_id";
$tstmt = $pdo->prepare($tsql);
$tstmt->bindValue(':t_id', $t_id, PDO::PARAM_INT);
$tstatus = $tstmt->execute();

$tview="";
if($tstatus==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $tstmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $tstatus = $tstmt->fetch(PDO::FETCH_ASSOC)){
    $tview .= '<p>担当コマ数　'.$tstatus["cnt_class"].'コマ</p>';
    $tview .= '<p>授業時間　'.$tstatus["sum_len"].'分</p>';
    
  }

}



?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>講師メインメニュ</title>
  <link rel="stylesheet" href="samplemmmm.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



</head>
<body>
  <div class="header">
    <div class="univdisplay">講師　<?=$row["t_name"]?>様</div>
    <ul class="header-menu">
      <li><a href="t_select.php">授業・講管理</a></li>
      <li><a href="mainmenu.php">受講状況</a></li>
      <li><a href="s_select.php">学生管理</a></li>
      <li><a href="logout.php">ログアウト</a></li>
      <li><a href="setting.php">各種設定</a></li>
    </ul>
  </div>

  <div id="container"> <!-- コンテナ -->
    <div id="itemA">
      <div>担当授業</div>
      <div><?=$cview?></div>

     
    </div> <!-- アイテム -->

    <div id="itemB">
      <div>授業統計</div>
      <div><?=$tview?></div>
     
    </div>
    
    <div id="itemC">
      <div>学生情報</div>
      

    </div>
  </div>
</body>
</html>
