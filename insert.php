<?php
//POSTデータ取得
$name = $_POST["name"];
$email = $_POST["email"];
$lid = $_POST["lid"];
$lpw = password_hash($_POST["lpw"], PASSWORD_DEFAULT);
$aim = $_POST["aim"];
$cheering = $_POST["cheering"];
$anxiety = $_POST["anxiety"];

require_once("funcs.php");

//DB接続します
$pdo = db_conn();
//ログインチェック処理！
// login_check();

//データ登録SQL作成
//SQL文を用意
$sql = "INSERT INTO 
            users(id,name,email,lid,lpw,aim,cheering,anxiety,created_at,nicknames_id,gender_id,ages_id,colors_id,kanri_flg,life_flg)
        VALUES
            (NULL,:name,:email,:lid,:lpw,:aim,:cheering,:anxiety,now(),NULL,NULL,NULL,NULL,0,0)";
$stmt = $pdo->prepare($sql);
// バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':aim', $aim, PDO::PARAM_STR);
$stmt->bindValue(':cheering', $cheering, PDO::PARAM_STR);
$stmt->bindValue(':anxiety', $anxiety, PDO::PARAM_STR);
//実行
$status = $stmt->execute();


//データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //index.phpへリダイレクト
  redirect("index.php");
}
?>

