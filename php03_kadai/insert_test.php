<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ


//$insert_dt = $_POST['insert_dt'];
$image_url = $_POST['image_url'];
/*
$book_title = $_POST['book_title'];
$book_author = $_POST['book_author'];
$book_publisher = $_POST['book_publisher'];
*/
$naiyou = $_POST['naiyou'];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}


//３．データ登録SQL作成
//$sql = "INSERT INTO gs_bm_table(insert_dt,image_url,book_title,book_author,book_publisher,naiyou,indate)VALUES(:insert_dt, :image_url, :book_title, :book_author, :book_publisher,:naiyou, sysdate());";
$sql = "INSERT INTO test_gs_bm_table(image_url,naiyou,indate)VALUES(:image_url,:naiyou, sysdate());";
//$sql = "INSERT INTO gs_bm_table(insert日時, 画像URL, 書籍名, 著者名, 出版社名, 書籍コメント, 登録日時)VALUES(:datetime, :image_url, :book_title, :book_author, :book_publisher, :naiyou, sysdate());";
$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':insert_dt', $insert_dt, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image_url', $image_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//$stmt->bindValue(':book_title', $book_title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//$stmt->bindValue(':book_author', $book_author, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//$stmt->bindValue(':book_publisher', $book_publisher, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_Error:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
