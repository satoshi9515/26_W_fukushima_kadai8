
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>大学新規登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="login.php">ログインページ</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="univ_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>新規大学登録</legend>
    <label><input name="id" type="hidden"></label><br>
     <label>大学名：<input type="text" name="u_name"></label><br>
     <label>アカウント：<input type="text" name="u_account"></label><br>
     <label>PASSWORD：<input type="text" name="u_pw"></label><br>
     <label><input type="hidden" name="u_life_flg" value="0"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
