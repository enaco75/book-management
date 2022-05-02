<!-- 一覧画面のビュー -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>一覧画面</title>
</head>
<body>
<div id="wrapper">

    <header>
        <h1>enaco</h1>
    </header>

    <div class="complete_msg"><?php echo $msg;?></div>
    
<main class="main_list">
    <h2>単行本一覧</h2>
    <div class="complete_msg"><?php echo $msg;?></div>
    <form action="./list.php" method="POST">
        

       
        <p class="search_set">
            <input class="search_input" type="text" name="search" placeholder="キーワードを入力" value="<?php echo isset($_POST['search'])?$_POST['search']:'';?>"><!--もし＄_POSTに中身が入っている時は、その中身を表示させる。＄_POSTが空なら空白にする。-->          
            <button class="search_btn" type="submit" name="state" value="search">検索</button>
        </p>
        
        <button class="csv_btn" type="submit" name="state" value="download">CSVでダウンロード</button>

        <p class="err"><?php echo isset($search_msg)?$search_msg:'';?></p>
        
        <table>
            <tr>
                <th>タイトル</th>
                <th>画像</th>
                <th>巻数</th>
                <th>
                    価格
                    <button class="asc_btn" type="submit" name="state" value="price_ASC">▲</button>
                    <button class="desc_btn" type="submit" name="state" value="price_DESC">▼</button>
                </th>
                <th>発売日</th>
                <th>購入日</th>
                <th>変更　・　削除</th>
            </tr>
            <!-- ↓これ以降リストを繰り返しで表示 -->
            <?php foreach($list as $val){ ?>
                <tr class="nakami">
                    <td><?php echo $val['title'];?></td>
                    <td class="img">
                        <div class="img_wrap"><img src="<?php echo $val['img_path'];?>" alt="商品画像"></img></div>
                    </td>
                    <td><?php echo $val['volume'];?>巻</td>
                    <td><?php echo $val['price'];?>円</td>
                    <td><?php echo $val['release_date'][0];?>年<?php echo $val['release_date'][1];?>月<?php echo $val['release_date'][2];?>日</td>
                    <td><?php echo $val['purchase_date'] == ''?'ー':$val['purchase_date'][0] . '年' . $val['purchase_date'][1] . '月' . $val['purchase_date'][2] . '日';?></td>
                    <td>
                        <a class="textlink_a" href="./update.php?id=<?php echo $val['id'];?>">変更</a>　・　
                        <a class="textlink_b" href="./delete.php?id=<?php echo $val['id'];?>">削除</a>
                    </td>
                </tr>
            <?php } ?>
    
        </table>
    
    
        <button class="entry_btn" type="submit" name="state" value="entry">単行本を<br>登録</button>
    </form>
</main>

<footer id="footer">
    <p>©︎2021 PH23 Erina no Hyouka_Kadai</p>
</footer>
</div><!-- wrapper -->
</body>
</html>