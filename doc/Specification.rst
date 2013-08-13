===============
URL短縮プログラム
===============

mod_rerwite を使用してアクセスされたURLから短縮部をとりだし、それをキーにして登録されたURLへ転送する


::

  RewriteEngine On
  RewriteBase /
  RewriteRule ^(.+)/(.+)/(.+)$ $1.php?mode=$2&id=$3


　これは冒頭でお話しした、Webアプリケーションを静的ページ風のURLで動作させるための書き換え例です。正規表現内の（）で囲まれた部分を、書き換え後URLで $1、$2、$3……のようにして順番に参照することができます。上記の例では 例えば“/test/edit/123”は、“test.php?mode=edit&id=123”のように書き換えられます。


.. code-block:: PHP

  <html>
  <head>
     <meta http-equiv="refresh" content="0;url=転送URL" />
  </head>
  <body></body>
  </html>


もしくは PHP の転送を使ってもいいかもしれない


データは GET で受けとることになる。


要件
===========

使用者側

- n文字異常でshurlが登録可能
- 自動生成も可能
- 使用期限の設定あり、 1,3,7,30,60,180 、標準は7

管理

- 登録されている shurl の一覧
- shurl へのアクセスカウント (後ほど実装)


クラス
===========

dat class
dat_add
dat_get
dat_del
dat_daychk
dat_getall
 




