<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📝 勉強場所融通システム - データ登録</title>
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
            <a href="select.php" class="nav-link">
                <i class="fas fa-list"></i>
                仲間を検索
            </a>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li><a href="login.php" class="button button-login">ログイン</a></li>
                    <li><a href="logout.php" class="button button-logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="main-container form-page">
        <div class="form-card">
            <h1 class="form-title">📝 登録画面</h1>
            <p class="form-subtitle">登録情報を入力してください</p>
            
            <form method="post" action="insert.php">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i> お名前
                    </label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="例：山田太郎" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> メールアドレス
                    </label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="例：example@email.com" required>
                </div>

                <div class="form-group">
                    <label for="lid" class="form-label">
                        <i class="fas fa-envelope"></i> ログインID
                    </label>
                    <input type="text" id="lid" name="lid" class="form-input" placeholder="例：Apple" required>
                </div>

                <div class="form-group">
                    <label for="lpw" class="form-label">
                        <i class="fas fa-envelope"></i> ログインパスワード
                    </label>
                    <input type="password" id="lpw" name="lpw" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="aim" class="form-label">
                        <i class="fas fa-comment"></i> 勉強内容
                    </label>
                    <textarea id="content" name="aim" class="form-textarea" placeholder="何の勉強をしていますか..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="cheering" class="form-label">
                        <i class="fas fa-comment"></i> 仲間にエールを📣
                    </label>
                    <textarea id="content" name="cheering" class="form-textarea" placeholder="同じ勉強をしている仲間にエールを送ろう..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="cheering" class="form-label">
                        <i class="fas fa-comment"></i> 悩み😂
                    </label>
                    <textarea id="content" name="anxiety" class="form-textarea" placeholder="悩みはつきもの..." required></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    送信する
                </button>
            </form>
        </div>
    </main>
</body>

</html>