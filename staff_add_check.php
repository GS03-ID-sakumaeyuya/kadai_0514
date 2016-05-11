<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>php練習</title>
</head>
<body>
  <?php
    // require_once('common/sabitize.php');
    // $sanitize = sanitize($_POST);

    $staff_name = $_POST['name'];
    $staff_password = $_POST['password'];
    $staff_repassword = $_POST['repassword'];


    $staff_name = htmlspecialchars($staff_name);
    $staff_password = htmlspecialchars($staff_password);
    $staff_repassword = htmlspecialchars($staff_repassword);
    if($staff_name == "")
    {
      echo 'スタッフ名が入力されていませ<br>';
    } else{
      echo 'スタッフ名:';
      echo $staff_name;
      echo '<br>';
    }
    if($staff_password == "")
    {
        echo 'パスワードが入力されていません<br>';
    }
    if($staff_password != $staff_repassword)
    {
      echo 'パスワードが一致しません';
    }

    if($staff_name =="" || $staff_password =="" || $staff_password != $staff_repassword)
    {
      echo '<form><input type="button" onclick="history.back()"value="戻る"></form>';
    }
    else
    {
      $staff_password = md5($staff_password);
      echo '<form method="post" action="staff_add_done.php">';
      echo '<input type="hidden" name="name" value="'.$staff_name.'">';
      echo '<input type="hidden" name="password" value="'.$staff_password.'">';
      echo '<br>';
      echo '<input type="button" onclick="history.back()"value="戻る">';
      echo '<input type="submit" value="OK">';
      echo '</fomr>';
    }
   ?>
</body>
</html>
