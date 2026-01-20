<?php
require_once("funcs.php");

//DB接続します
$pdo = db_conn();

//データ登録SQL作成
$id = $_GET["id"];
$sql = "DELETE FROM
            users
        WHERE
            id = :id"; 
$stmt = $pdo->prepare($sql);


// バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//実行
$status = $stmt->execute();

//データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  redirect("select.php");
}
?>
