<!-- 削除画面のビュー -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>削除画面</title>
</head>
<body>
<div id="wrapper">
<header>
    <h1>enaco</h1>
</header>


<main>
    <div class="form_wrap">
        <form action="./delete.php" method="POST">
            <div class="_intro">
                <h2>単行本削除</h2>
                <p>
                    こちらの単行本の情報を削除します。
                </p>
            </div>

            <div class="content_box">
                <div class="img_wrap"><img src="<?php echo $row['img_path'];?>" alt="商品画像"></img></div>
                <div class="content">
                    <div class="items">
                        <p>タイトル</p>
                        <p><?php echo $row['title'];?></p>
                    </div>
                    <div class="items">
                        <p>巻数</p>
                        <p><?php echo $row['volume'];?>巻</p>
                    </div>
                    <div class="items">
                        <p>価格</p>
                        <p><?php echo $row['price'];?>円</p>
                    </div>
                    <div class="items">
                        <p>発売日</p>
                        <p><?php echo $row['release_date'][0];?>年<?php echo $row['release_date'][1];?>月<?php echo $row['release_date'][2];?>日</p>
                        
                    </div>
                    <div class="items">
                        <p>購入日</p>
                        <p class="null_ver"><?php echo $row['purchase_date'] == ''?'ー':$row['purchase_date'][0] . '年' . $row['purchase_date'][1] . '月' . $row['purchase_date'][2] . '日';?></p>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo isset($_GET['id'])?$_GET['id']:$_POST['id'];?>">
            <button class="nomal_btn" type="submit" name="state" value="delete">削除する</button>
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