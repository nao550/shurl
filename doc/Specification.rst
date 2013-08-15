===============
URL短縮プログラム
===============

mod_rerwite を使用してアクセスされたURLから短縮部をとりだし、それをキーにして登録されたURLへ転送する


mod_rewrite を使用して、

http://www.example.com/xxxxxx

でアクセスがあった場合にスクリプトへ転送する設定にする。

.htaccess に以下のように記述する。

::

  RewriteEngine On
  RewriteBase /~nao/shurl/
  RewriteRule ^sh.php - [L]
  RewriteRule ^(.+)$ /~nao/shurl/sh.php?mode=shurl&shchar=$1


3行目でURLに sh.php の文字列が含まれる場合にさらに転送をしない設定を入れる。
これをいれないと、4行目で延々とループすることになる。



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

dat_gensh 




