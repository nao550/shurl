<?php
/*
ゲットで変数が来ているかどうかチェック
 変数がなければ標準画面
 変数があれば変数をチェック
   mode=gen で shurl 生成画面
   mode=error でエラー発生したので再入力画面
   mode=shurl で shurl を受け取ったと解釈
*/

   if( isset( $_GET['mode'] )){
       if( $_GET['mode'] == 'gen' ){
           $mode = $_GET['mode'];           
       } elseif( $_GET['mode'] == 'error' ){
           $mode = $_GET['mode'];
        } elseif( $_GET['mode'] == 'shurl' ){
           $mode = $_GET['mode'];
       }
   } else {
       $mode = "first";
   }

   include( "header.inc" );

   if( $mode == 'gen' ){
       $org_url = $_GET['org_url'];
       $shchar = $_GET['shurl'];
       $cutoff = $_GET['cutoff'];
       print( 'gen mode' );
       
   } elseif ( $mode == 'shurl' ){
       $shchar = $_GET['shurl'];
       print( 'shurl mode.' );

   } elseif ( $mode == 'first' ){
       echo 'first time.';

   } elseif( $mode == 'error' ){
       $org_url = $_GET['org_url'];
       $shchar = $_GET['shurl'];
       $cutoff = $_GET['cutoff'];
       print( 'error mode' );

   }

   include( "footer.inc" );


/*

標準画面の表示
 生成ボタン で org_url、shchar、day、をGETで送る


url生成画面
 shchar の有無チェック
   shchar あれば
     shchar の長さチェック
       エラーで mode=error で戻す
   shchar なければ、org_url,time より hash で shchar 生成

 org_url,shchar,day を dat へ登録

 shurl の画面を表示


shurl を受け取った
 GET で shchar を取り出し
 shchar で dat を検索
  dat になればエラー画面
  dat にあれば location  hogeで移動

*/




?>



 
