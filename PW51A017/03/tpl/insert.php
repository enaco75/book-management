<!-- 登録画面のビュー -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>登録画面</title>
</head>
<body>
<div id="wrapper">
<header>
    <h1>enaco</h1>
</header>

<main>
    <div class="form_wrap">
        <form action="./insert.php" method="POST" enctype="multipart/form-data">
            <div class="_intro_i">
                <h2>単行本情報登録</h2>
                <p>
                    追加する単行本の情報を入力してください。
                </p>
            </div>

            <div class="content_box_i">
                <div class="content">
                    <div class="items">
                        <p class="koumoku">タイトル</p>
                        <div class="set">
                            <p><input type="text" name="title" value="<?php echo isset($_POST['title'])?$_POST['title']:'';?>"></p>
                            <p class="err_i"><?php echo isset($err['title'])?$err['title']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p class="koumoku">巻数</p>
                        <div class="set">
                            <p><input type="text" name="volume" value="<?php echo isset($_POST['volume'])?$_POST['volume']:'';?>">巻</p>
                            <p class="err_i"><?php echo isset($err['volume'])?$err['volume']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p class="koumoku">価格</p>
                        <div class="set">
                            <p><input type="text" name="price" value="<?php echo isset($_POST['price'])?$_POST['price']:'';?>">円</p>
                            <p class="err_i"><?php echo isset($err['price'])?$err['price']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p class="koumoku">発売日</p>
                        <div class="set">
                            <p><input type="text" name="release_date" placeholder="例）20210716" value="<?php echo isset($_POST['release_date'])?$_POST['release_date']:'';?>"></p>
                            <p class="err_i"><?php echo isset($err['release_date'])?$err['release_date']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p class="koumoku">購入日</p>
                        <div class="set">
                            <p><input type="text" name="purchase_date" placeholder="例）20210716" value="<?php echo isset($_POST['purchase_date'])?$_POST['purchase_date']:'';?>"></p>
                            <p class="err_i"><?php echo isset($err['purchase_date'])?$err['purchase_date']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p class="koumoku">画像</p>
                        <p><input type="file" name="upload_file"></t>
                    </div>
                </div><!-- content -->
            </div><!-- content_box_i -->
           
    
            <button class="nomal_btn" type="submit" name="state" value="insert">登録する</button>
        </form>
    </div><!-- form_wrap -->
    <p class="back_link"><a href="./list.php">◀︎　一覧に戻る</a></p>
</main>

<footer id="footer">
    <p>©︎2021 PH23 Erina no Hyouka_Kadai</p>
</footer>
</div><!-- wrapper -->
</body>
</html>