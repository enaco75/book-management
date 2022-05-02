<!-- 変更画面のビュー -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>変更画面</title>
</head>
<body>
<div id="wrapper">

    <header>
        <h1>enaco</h1>
    </header>

<main>
    <div class="form_wrap">
        <form action="./update.php" method="POST">
            <div class="_intro">
                <h2>単行本情報変更</h2>
                <p>
                    こちらの単行本の情報を編集することができます。
                </p>
            </div>

            <div class="content_box">
                <div class="img_wrap"><img src="<?php echo isset($_POST['img_path'])?$_POST['img_path']:$row['img_path'];?>" alt="商品画像"></img></div>
                <div class="content">
                    <div class="items">
                        <p>タイトル</p>
                        <div class="set">
                            <p><input type="text" name="title" value="<?php echo isset($_POST['title'])?$_POST['title']:$row['title'];?>"></p>
                            <p class="err"><?php echo isset($err['title'])?$err['title']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p>巻数</p>
                        <div class="set">
                            <p><input class="input_n" type="text" name="volume" value="<?php echo isset($_POST['volume'])?$_POST['volume']:$row['volume'];?>"><span>巻</span></p>
                            <p class="err"><?php echo isset($err['volume'])?$err['volume']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p>価格</p>
                        <div class="set">
                            <p><input class="input_n" type="text" name="price" value="<?php echo isset($_POST['price'])?$_POST['price']:$row['price'];?>"><span>円</span></p>
                            <p class="err"><?php echo isset($err['price'])?$err['price']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p>発売日</p>
                        <div class="set">
                            <p><input type="text" name="release_date" placeholder="例）20210716" value="<?php echo isset($_POST['release_date'])?$_POST['release_date']:$row['release_date'];?>"></p>
                            <p class="err"><?php echo isset($err['release_date'])?$err['release_date']:'';?></p>
                        </div>
                    </div>
                    <div class="items">
                        <p>購入日</p>
                        <div class="set">
                            <p><input type="text" name="purchase_date" placeholder="例）20210716" value="<?php echo isset($_POST['purchase_date'])?$_POST['purchase_date']:$row['purchase_date'];?>"></p>
                            <p class="err"><?php echo isset($err['purchase_date'])?$err['purchase_date']:'';?></p>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo isset($_GET['id'])?$_GET['id']:$_POST['id'];?>">
            <button class="nomal_btn" type="submit" name="state" value="update">変更する</button>
    
        </form>
    </div>

    <p class="back_link"><a href="./list.php">◀︎　一覧に戻る</a></p>
</main>


<footer id="footer">
    <p>©︎2021 PH23 Erina no Hyouka_Kadai</p>
</footer>
</div><!-- wrapper -->
</body>
</html>