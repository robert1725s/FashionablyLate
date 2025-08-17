# FashionablyLate 問い合わせフォーム、問い合わせ管理

## 環境構築

#### Docker ビルド

1. git clone git@github.com:robert1725s/FashionablyLate.git
2. cd FashionablyLate
3. docker-compose up -d

#### Laravel 環境構築

1. docker-compose exec php bash
2. composer install
3. cp .env.example .env
4. .env ファイルの 11 行目以降を以下に変更

```diff
// 前略

DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
+ DB_HOST=mysql
DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=
+ DB_DATABASE=laravel_db
+ DB_USERNAME=laravel_user
+ DB_PASSWORD=laravel_pass

// 後略
```

5. php artisan key:generate
6. php artisan migrate
7. php artisan db:seed

```
初期ユーザでログイン可能です
メールアドレス：admin@hoge.com
パスワード：password
```

## 使用技術

-   PHP 8.1
-   Laravel 8.8
-   MySQL 8.0
-   nginx 1.21

## ER 図

<img width="791" height="521" alt="Image" src="https://github.com/user-attachments/assets/03e17d6e-3e2f-4e25-aaf7-3cb91aa50594" />

## URL

-   開発環境：http://localhost/
-   phpMyadmin：http://localhost:8080/
