<?php
//1.POSTでid,name,email,naiyouを取得
$book_name=$_POST["book_name"];
$book_url=$_POST["book_url"];
$book_comment=$_POST["book_comment"];
$id=$_POST["id"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE gd_bm_table SET book_name=:book_name,book_url=:book_url,book_comment=:book_comment WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':book_name',  $book_name,  PDO::PARAM_STR);
$stmt->bindValue(':book_url',  $book_url,  PDO::PARAM_STR);
$stmt->bindValue(':book_comment',  $book_comment,  PDO::PARAM_STR);
$stmt->bindValue(':id' ,  $id,  PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: bm_list_view.php");
  exit;

}



?>
