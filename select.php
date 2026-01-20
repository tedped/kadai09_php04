<!-- データ選択ファイルは上にphp,下にhtml -->
<?php
// 0. SESSION開始！！
session_start();

require_once("funcs.php");
//ログインチェック処理！
login_check();

//DB接続します
$pdo = db_conn();


//データ取得SQL作成
$count_stmt = $pdo->prepare('SELECT count(*) FROM users');
$count_status = $count_stmt->execute();
$count = $count_stmt->fetchColumn();
// 三項演算子
$search = isset($_GET['search']) ? $_GET['search'] : '';
if($search !== ''){
    //検索キーワードが指定されている場合
    $sql = "SELECT * FROM users WHERE aim LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search' , '%' . $search . '%' , PDO::PARAM_STR);
}else{
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
}
$status = $stmt->execute();


//データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '" >';
        $view .= h($result['updated_at']) 
                    . ' / ' . h($result['name']) 
                    . ' / ' . h($result['email']) 
                    . ' / ' . h($result['aim']) 
                    . ' / ' . h($result['cheering'])
                    . ' / ' . h($result['anxiety']);
        $view .= '</a>';
        if($_SESSION["kanri_flg"] === 1){
            $view .= '<a href="delete.php?id=' . $result["id"] .  '">';
            $view .= '[削除]';
        }
        $view .= '</a>';
    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>仲間を検索</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- 装飾要素 -->
    <div class="decoration"></div>
    <div class="decoration"></div>

    <!-- ヘッダー -->
    <header class="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-clipboard-list"></i>
                勉強場所融通システム
            </a>
            <a href="index.php" class="nav-link">
                <i class="fas fa-plus"></i>
                登録画面に戻る
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li><a href="login.php" class="button button-login">ログイン</a></li>
                <li><a href="logout.php" class="button button-logout">ログアウト</a></li>
            </ul>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-container">
        <div class="content-card">
            <h1 class="page-title">勉強仲間を検索</h1>
            <p class="page-subtitle">同じ勉強をしている人たち</p>
            

            <form method="get" action="select.php">
                <div class="form-group">
                    <label for="search" class="form-label">検索:</label>
                    <input type="text" id="search" name="search" class="form-input" placeholder="同じ勉強をしている人を検索しよう">
                    <button type="submit" class="form-button">検索</button>
                </div>



            <div class="data-container">
                <!-- html文の中でphpのif文を条件分岐として利用できる -->
                <?php if(empty($view)): ?>
                    <!-- もし $view データがない場合の表示 -->
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <p>まだデータがありません</p>
                        <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #999;">
                            最初のアンケートを投稿してみましょう！
                        </p>
                    </div>
                <?php else: ?>
                    <!-- もし $view データが存在する場合 -->
                    <?= $view ?>
                    <?= '<br>合計件数:' . $count ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>

</html>