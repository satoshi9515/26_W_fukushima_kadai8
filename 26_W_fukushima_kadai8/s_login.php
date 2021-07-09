

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/sample1.css">
<!-- <link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style> --> 
<title>学生ログイン</title>
</head>
<body>
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <ul class="navi-header">
          <li><img src="img/logo.png"></li>
          <li><a class="navbar-brand" href="t_login.php">講師ログイン</a></li>
          <li><a class="navbar-brand" href="s_login.php">学生ログイン</a></li>
          <li><a class="navbar-brand" href="univ_regist.php">大学ログイン</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="s_login_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ログインページ</legend>
     <label>ID：<input type="text" name="s_account"></label><br>
     <label>PW：<input type="text" name="s_pw"></label><br>
     <input type="submit" value="ログイン">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>

