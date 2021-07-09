<?php
$c_id = $_GET["c_id"];


//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_kdb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM gs_course_table WHERE c_id=:c_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':c_id', $c_id, PDO::PARAM_INT);
$status = $stmt->execute();
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $regist_course = $stmt->fetch();
  $dis_course .=  $regist_course["c_name"];
  
};







//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();

}

session_start();
include("u_funcs.php");
loginCheck();
//1.  DB接続します
$pdo = db_connect();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_students_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= '<a href="s_view.php?s_id='.$result["s_id"].'">';
    $view .= '学生名　';
    $view .= $result["s_name"]."　:アカウント名".$result["s_account"];
    $view .='</a>';
    $view .='　　';
    $view .= '<a href="s_delete.php?s_id='.$result["s_id"].'">';
    $view .='[削除]';

    $view .='</a>';
    
    $view .="</p>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> 学生授業登録</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="univ_mainmenu.php">メインメニュー</a>
        <a class="navbar-brand" href="t_regist.php">学生登録</a>
        <a class="navbar-brand" href="t_select.php">学生管理</a>
        <a class="navbar-brand" href="c_regist.php">学生授業登録</a>
        <a class="navbar-brand" href="c_select.php">学生授業管理</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div><?=$dis_course?></div>

    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
