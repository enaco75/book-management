<?php 
//変更画面のコントローラー

session_start();

//定数呼び出し
require_once '../../const.php';
//関数呼び出し
require_once './func.php';

//初期化
$err = [];
$id = '';

/* //直で変更画面のURLを打ち込まれた時
if ($_GET['id'] == '') {
    header('location:./list.php');
    exit;
} */


//一覧画面で指定された単行本の情報
if (isset($_GET['id'])) {
    //一覧画面で[変更]リンクをクリックされた単行本情報（id）を受け取る
    $id = $_GET['id'];

    //[変更]ボタンを押された単行本の変更前情報を表示（登録画面からこの変更画面に飛んできた時。）
    //SQL文作ります
    $sql = "SELECT * FROM m_book WHERE id = " . $id . ";";

    //DB連結したい
    $link = mysqli_connect( HOST , USER_ID , PASSWORD , DB_NAME);
    mysqli_set_charset($link , 'utf8');

    $result = mysqli_query($link ,$sql);
    $row = mysqli_fetch_assoc($result);
    //発売日や購入日の日付を"-"なしの形式に置き換える
    $row['release_date'] = str_replace("-","",$row['release_date']);
    if ($row['purchase_date'] !== '') {  //購入日がNULLじゃなかった場合
        $row['purchase_date'] = str_replace("-","",$row['purchase_date']);
    }
    //画像があるかどうか？
    if (file_exists(DIR_IMG . $row['id'] . '.jpg')) {
        $row['img_path'] = DIR_IMG . $row['id'] . '.jpg';
    }
    else{
        $row['img_path'] = './img/no_image.png';
    }
    mysqli_close($link);
}

//[単行本の情報を変更する]ボタンを押された時
if(isset($_POST['state']) && $_POST['state'] == 'update'){
    $id = $_POST['id'];

    //タイトルのエラーチェック
    if($_POST['title'] == ''){//未入力ですか？
        $err['title'] = '※ 名前を入力してください。';
    }
    //巻数のエラーチェック
    if($_POST['volume'] == ''){//未入力ですか？
        $err['volume'] = '※ 巻数を入力してください。';
    }
    elseif(!is_numeric($_POST['volume'])){//数値以外で入力されてないか？
        $err['volume'] = '※ 巻数を数値(半角)で入力してください。';
    }
    elseif(check_digit($_POST['volume'],10) !== false){//10桁以上はDBに登録できないのでそのチェック
        $err['volume'] = check_digit($_POST['volume'],10);
    }
    //価格のエラーチェック
    if($_POST['price'] == ''){//未入力ですか？
        $err['price'] = '※ 価格を入力してください。';
    }
    elseif(!is_numeric($_POST['price'])){//数値以外で入力されてないか？
        $err['price'] = '※ 価格を数値(半角)で入力してください。';
    }
    elseif(check_digit($_POST['price'],10) !== false){//10桁以上はDBに登録できないのでそのチェック
        $err['price'] = check_digit($_POST['price'],10);
    }
    //発売日のエラーチェック
    if($_POST['release_date'] == ''){//未入力ですか？
        $err['release_date'] = '※ 発売日を入力してください。';
    }
    elseif(check_date($_POST['release_date'],8) !== false){//妥当性チェック
        $err['release_date'] = check_date($_POST['release_date'],8);
    }
    //購入日が入力された場合はエラーチェック
    if(isset($_POST['purchase_date']) && $_POST['purchase_date'] !== ''){
        if(check_date($_POST['purchase_date'],8) !== false){//妥当性チェック
            $err['purchase_date'] = check_date($_POST['purchase_date'],8);
        }
    }
    

    /* //ファイルのエラーメッセージ
    //アップロードされたファイルの受け取り
    $upload_file = $_FILES['upload_file'];
    if($upload_file['name'] == ''){//ファイルがアップされているか？
        $err['file'] = '※ ファイルを選択してください。';
    }
    else{
        //拡張子のチェック
        $err['ext'] = "※ ファイル形式が違います。";
        $ext_check = [];
        $ext_check = explode('.',$upload_file['name']);
        $ext = $ext_check[count($ext_check)-1];
        foreach ($file_type as $val) {
            if ($ext == $val) {
                unset($err['ext']);
            }
        }
    } */

    //画像があるかどうか？
    if (file_exists(DIR_IMG . $_POST['id'] . '.jpg')) {
        $_POST['img_path'] = DIR_IMG . $_POST['id'] . '.jpg';
    }
    else{
        $_POST['img_path'] = './img/no_image.png';
    }
    
    //エラーチェックをクリアしたら
    if($err === []){
        //POSTの受け取り
        $title = $_POST['title'];
        $volume = $_POST['volume'];
        $price = $_POST['price'];
        $release_date = $_POST['release_date'];
        $purchase_date = $_POST['purchase_date'] == ''?"NULL":$_POST['purchase_date'];

        //DB接続
        $link = mysqli_connect( HOST , USER_ID , PASSWORD , DB_NAME);
        mysqli_set_charset($link , 'utf8');
        //SQL文作成
        $sql = "UPDATE m_book SET title = '" . $title . "' , volume = " . $volume . " , price = " . $price . " , release_date = " . $release_date . " , purchase_date = " . $purchase_date . " WHERE id = " . $id . ";";
        mysqli_query($link ,$sql);
        //var_dump($sql);
        
        //id取得するよ
        //$id = mysqli_insert_id($link);
        //$_SESSION['id'] = $id;

        //画像の名前をid.拡張子にしてimgフォルダに格納
        //move_uploaded_file($upload_file['tmp_name'],'../../img/' . $id . '.' . $ext);
        //mysqli_close($link);

        //登録完了メッセージを入れる
        $_SESSION['msg'] = '変更が完了しました！';

        //登録完了画面に遷移
        header('location:./list.php');
        exit;
        
    }
}
//ビューの表示
require_once 'tpl/update.php';
?>