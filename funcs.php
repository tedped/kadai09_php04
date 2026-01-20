<?php
//共通に使う関数を記述

//DB接続
function db_conn()
{
    try {
        $db_name = 'gs_kadai09';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str,ENT_QUOTES);
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
  header("Location: " . $file_name);
}

// ログインチェック処理！ loginCheck()
// 以下、セッションID持ってたら、ok CSRF対策としてセッションIDを更新する
// 持ってなければ、閲覧できない処理にする
function login_check(){
    if(!isset($_SESSION["chk_ssid"]) ||  $_SESSION["chk_ssid"] !== session_id()){
        exit("Login Error");
    }
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
}