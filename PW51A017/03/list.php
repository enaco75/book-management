<?php 
//一覧画面のコントローラー
session_start();

//定数呼び出し
require_once '../../const.php';
//関数呼び出し
require_once './func.php';

//初期化
$list = [];
$msg = '';
//削除されていないデータを全て取得するためのSQL文（del_dateがNULLのものを取ってくる。）
$sql = "SELECT * FROM m_book WHERE del_date IS NULL";

//登録・変更・削除ページで処理を完了させて戻ってきた時
if(isset($_SESSION['msg'])){
    $msg = $_SESSION['msg'];

    session_destroy();
}

//[単行本を登録する]ボタンを押された時
if(isset($_POST['state']) && $_POST['state'] == 'entry'){
    //登録画面に遷移
    header('location:./insert.php');
    exit;
}

//検索ボタンを押された時
if(isset($_POST['search']) && $_POST['search'] != ''){
    $sql .= " AND title LIKE '%".$_POST['search']."%'";
}
//並び替えのSQL文
if(isset($_POST['state']) && $_POST['state'] == 'price_ASC'){   //価格の昇順
    $sql .= " ORDER BY price ASC";
}elseif(isset($_POST['state']) && $_POST['state'] == 'price_DESC'){ //価格の降順
    $sql .= " ORDER BY price DESC";
}else{  //全件表示：発売日の降順（最初にページを開いた時。）
    $sql .= " ORDER BY release_date DESC";
}

//SQL文最終調整
$sql .= ";";

//DB連結したい
$link = mysqli_connect( HOST , USER_ID , PASSWORD , DB_NAME);
mysqli_set_charset($link , 'utf8');
//DBからデータとってくる
$result = mysqli_query($link ,$sql);
while($row = mysqli_fetch_assoc($result)){
    //発売日の表記を"年月日"にする
    $row['release_date'] = explode("-",$row['release_date']);

    //購入日が入ってる（NULLじゃない場合）
    if ($row['purchase_date'] !== NULL) {
        $row['purchase_date'] = explode("-",$row['purchase_date']); //購入日の表記を"年月日"にする
    }

    //画像があるかどうか？
    if (file_exists(DIR_IMG . $row['id'] . '.jpg')) {
        $row['img_path'] = DIR_IMG . $row['id'] . '.jpg';
    }
    else{
        $row['img_path'] = './img/no_image.png';
    }
    
    $list[] = $row;
}
mysqli_close($link);

//[CSVでダウンロード]ボタンを押された時
if(isset($_POST['state']) && $_POST['state'] == 'download'){
    //ダウンロードされるファイル名
    $filename = 'book_'.date("YmdHis").'.csv';
    //ファイルタイプにMINEタイプを指定
    header('Content-Type:application/octet-stream');
    //ファイルのダウンロード、リネームを指示
    header('Content-Disposition:attachment;filename = "'.$filename.'"');
    //ここから下の出力内容がダウンロードされる
    foreach($list as $val){
        $val['release_date'] = implode('-',$val['release_date']);
        if($val['purchase_date'] !== NULL){
            $val['purchase_date'] = implode('-',$val['purchase_date']);
        }
        //画像のパスが入っている列を削除
        unset($val['img_path']);
        //indexを詰める
        $val = array_values($val);
        $csv_line = implode(',' , $val);
        $csv_line = rtrim($csv_line,',');
        echo $csv_line."\n";
    }
    exit;
}

/* function test(){
    $filename = 'book_'.date("YmdHis").'.csv';
    header('Content-Type:application/octet-stream');
    header('Content-Disposition:attachment;filename="'.$filename.'"');
    echo 1;
    foreach($list as $val){
        $val['release_date'] = implode('-',$val['release_date']);
        if($val['purchase_date'] !== NULL){
            $val['purchase_date'] = implode('-',$val['purchase_date']);
        }
        $csv_line = implode(',' , $val);
        $csv_line = rtrim($csv_line,',');
        echo $csv_line."\n";
    }
    exit;
} */

//検索結果が0件の場合
$search_msg = "";
if($list == NULL){
    $search_msg = "検索対象のデータがありません。";
}

//ビューの表示
require_once 'tpl/list.php';
?>