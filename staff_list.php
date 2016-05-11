<!DOCTYPE html>
<?php
// session_start();
// //パソコンとサーバ間で毎回session_idを変える。セキュリティー上必要ば処理
// session_regenerate_id(true);
// if(isset($_SESSION['login']) == false)
// {
//   echo 'ログインされていません<br />';
//   echo '<a href="staff_login.html">ログイン画面へ</a>';
//   exit();
// }
// else {
//   echo $_SESSION['staff_name'];
//   echo 'さんがログイン中<br />';
//   echo '<br />';
// }
 ?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>php練習</title>
</head>
<body>
	<?php
	try{
	$dsn = 'mysql:dbname=shop;host=localhost';
	$user = 'root';
	$password = '';
	$dbh = new PDO($dsn,$user,$password,
		//MYSQLの文字化け対策
		array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"
		)
	);

	$sql = 'SELECT code,name FROM mst_staff WHERE 1';
	$stmt = $dbh -> prepare($sql);
	$stmt -> execute();
	$dbh = null;
	echo '<form method="post" action="staff_edit.php">';
	while (true)
	{
		$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
		if($rec == false)
		{
			break;
		}
		echo '<input type="radio" name="staffcode" value="'.$rec['code'].'" >';
		echo $rec['name'];
		echo '<br />';
	}
	echo '<input type="submit"name="add"value="追加">';
	echo '<input type="submit"name="disp"value="参照">';
	echo '<input type="submit" name="edit" value="修正">';
	echo '<input type="submit" name="delete"value="削除">';
	echo '</form>';
}
	catch(Exception $e)
	{
		echo 'ただいま障害によりご迷惑をお掛けしています';
		exit();
	}

	?>
</body>
</html>
