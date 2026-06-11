# todo-laravel-handwriting

Laravel の勘を取り戻すために、手書きで Todo アプリを作るリポジトリ。

## 構成

```
.
├── docker/
│   ├── nginx/default.conf   # Nginx 設定
│   └── php/Dockerfile       # PHP 8.4-fpm + Laravel インストーラー
├── docker-compose.yml       # app / web / db の 3 サービス
├── .env.docker              # Docker コンテナ用環境変数
└── laravel/                 # Laravel 13.x アプリ本体
```

| サービス | イメージ | ポート |
|---|---|---|
| app | PHP 8.4-fpm (カスタム) | 9000 (内部) |
| web | nginx:1.25-alpine | localhost:8080 |
| db | mysql:8.0 | localhost:33060 |

> MySQL のホスト側ポートが 3306 ではなく 33060 なのは、ローカルに MySQL が入っている場合の競合を避けるため。

## 起動 / 停止

```bash
# 起動
docker compose up -d

# 停止（DB データは保持）
docker compose down

# 停止 + DB データも削除
docker compose down -v
```

## artisan / composer コマンドの実行

```bash
# php artisan
docker compose exec app php artisan <command>

# 例
docker compose exec app php artisan make:model Todo -m
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:status
docker compose exec app php artisan tinker

# composer
docker compose exec app composer require <package>
```

## ログ確認

```bash
docker compose logs -f app   # PHP-FPM
docker compose logs -f web   # Nginx
docker compose logs -f db    # MySQL
```

## Nginx config を変更したとき

ファイル単体の bind mount はスナップショット方式のため、編集後は `restart` ではなくコンテナを作り直す。

```bash
docker compose up -d --force-recreate web
```

## アクセス先

- アプリ: http://localhost:8080
- MySQL: localhost:33060 (user: `todo_user` / pass: `todo_password` / db: `todo_db`)
