<?php
// Shorten URL configuretion file.

define( 'VERSION', '0.01' ); // Version number.
define( 'DEBUG', '1' ); // Debug Mode  1:on 0:off

define( 'BASEURL', 'http://www.kyo-to.net/~nao/shurl/sh.php?mode=shurl&shchar=' ); // shchar をつなげるショートカット用URL
define( 'MINSHCHAR', '5' ); // 短縮URLの最小文字列
define( 'DATDIR', './data/' ); // データディレクトリ
define( 'DATFILE', DATDIR . 'shurl.dat' ); // Datファイル

define( 'ADMIN', 'admin' ); // 管理者ID
define( 'PASSWD', 'pp234kk' ); //管理者パスワード

?>