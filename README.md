# etude

## etudeとは？
（人数制限と体温入力による）予約入場管理システムです

## ダウンロード方法
GitHubからダウンロードするかgit cloneしてください  
ダウンロード先  
https://github.com/tech-is/etude.git

git cloneする場合  
```
git clone https://github.com/tech-is/etude.git  
```

## 主な機能
```
・時間単位の予約
・体温を入力し規定値以上か判定 

## 環境構築
```
・apache  
・PHP 7.4.5
・MYSQL 10.4.11-MariaDB   
・Codeigniter 3.1.11  
```

## 初期設定


* **メールの設定**  

* **有効期限の設定**  

## フォルダ構成
・application/  
　　・config/　デフォルトコントローラーの設定やデータベースの設定ファイルを置いています  
　　・controler/　コントローラーのフォルダ  
　　・model/　データベース周りの関数をまとめたクラスを置いているフォルダ  
　　・views/　フロントエンドファイルをまとめたフォルダ  
　　・system/ ライブラリやヘルパーを置いているフォルダ  
　　・assets/ 静的ファイルをおいているフォルダ  
　　・index.php　最初にこのファイルを読み込んでください  

## データベース構築

ターミナルで行う場合
```
mysql -u root -p パスワード
MariaDB[(none)] ここにSQLを張り付けて実行
```
もしくは
```
①cd sqlファイルの場所まで移動
②mysql -u root -p パスワード
③create database db名(新規データベース作成)
④\q(ログアウト)
⑤mysql -u root -p db名 < baseball.sql(インポート)
```