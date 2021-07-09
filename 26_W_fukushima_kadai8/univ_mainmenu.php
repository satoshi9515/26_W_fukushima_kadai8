 <?php
session_start();
//2. SESSION変数に値を代入！！
$u_name =$_SESSION["u_name"] ;
$u_account=$_SESSION["u_account"];
$u_pw =$_SESSION["u_pw"];

include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_teachers_table");
$status = $stmt->execute();
$xx = $pdo->prepare("SELECT count(t_id) FROM gs_teachers_table");
$xx->execute();

$xxx = $xx->fetch(PDO::FETCH_ASSOC);
$n_teachers = $xxx['count(t_id)'];



//３．データ表示
$tview="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $tview .= "<p>";
    $tview .= '講師名　';
    $tview .= $result["t_name"];
    $tview .="</p>";
  }

}

$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_course_table");
$status = $stmt->execute();
$yy = $pdo->prepare("SELECT sum(c_length) FROM gs_course_table");
$yy->execute();

$yyy = $yy->fetch(PDO::FETCH_ASSOC);
$l_course = $yyy['sum(c_length)'];

//３．データ表示
$cview="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $cview .= "<p>";
    $cview .= '<a href="c_view.php?c_id='.$result["c_id"].'">';
    $cview .= '授業名　';
    $cview .= $result["c_name"]."　:授業時間".$result["c_length"];
    $cview .='分'; 
    $cview .='　　登録学生数　';
    $cview .=$result["cnt_s_id"];
    $cview .='名';
    $cview .='</a>';
    $cview .= '<a href="c_delete.php?c_id='.$result["c_id"].'">';
    $cview .='[削除]';
    $cview .='</a>';
    $cview .="</p>";
  }

}
$stmt = $pdo->prepare("SELECT * FROM gs_students_table");
$status = $stmt->execute();
$zz = $pdo->prepare("SELECT count(s_id) FROM gs_students_table");
$zz->execute();

$zzz = $zz->fetch(PDO::FETCH_ASSOC);
$n_students = $zzz['count(s_id)'];

//３．データ表示
$sview="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $sview .= "<p>";
    $sview .= '学生名　';
    $sview .= $result["s_name"];
    $sview .="</p>";
  }

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>大学メインメニュ</title>
  <link rel="stylesheet" href="samplemmmm.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



</head>
<body>
  <div class="header">
    <div class="univdisplay">ようこそ<?=$u_name?>大学様</div>
    <ul class="header-menu">
      <li><a href="t_select.php">授業・講師管理</a></li>
      <li><a href="mainmenu.php">受講状況</a></li>
      <li><a href="s_select.php">学生管理</a></li>
      <li><a href="logout.php">ログアウト</a></li>
      <li><a href="setting.php">各種設定</a></li>
    </ul>
  </div>

  <div id="container"> <!-- コンテナ -->
    <div id="itemA">
      <div>講師一覧</div>
      <div><?=$n_teachers?>名</div>
      <div class="container jumbotron"><?=$tview?></div>
    </div> <!-- アイテム -->

    <div id="itemB">
      <div>授業ダッシュボード</div>
      <div>合計授業時間<?=$l_course?>分</div>
      <div class="container jumbotron"><?=$cview?></div>
    </div>
    
    <div id="itemC">
      <div>学生情報</div>
      <div>生徒数<?=$n_students?>名</div>
      <div class="container jumbotron"><?=$sview?></div>

    </div>
  </div>
</body>
</html>
