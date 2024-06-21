# MOT2 DB 設計

## 必要なテーブル

- ユーザー

- トピック

- コメント

### ユーザーテーブル

| 論理名             | 物理名            | 型           | PK   | 初期値           | 説明                                                         |
| ------------------ | ----------------- | ------------ | ---- | ---------------- | ------------------------------------------------------------ |
| ID                 | id                | bigint       | ○    |                  | ユーザーを識別する一意の ID                                  |
| 氏名               | name              | varchar(255) |      |                  | ユーザー氏名                                                 |
| 国籍               | nationality       | varchar(255) |      |                  | 入力式                                                       |
| 自己紹介           | introduction_text | varchar(500) |      |                  | 自由記述型の自己紹介文                                       |
| 活動参加歴         | past-join         | varchar(500) |      | 空文字           | IIMSの過去の活動参加歴                                       |
| 表示用ユーザーID   | user_identifier       | varchar(50) |      |                  |              |
| アイコン画像   | user_icon       | varchar(255) |      |                  |              |
| カバー画像   | user_cover_image       | varchar(255) |      |                  |              |
| X(Twitter)アカウントURL   | sns_x       | varchar(255) |      |                  |              |
| FacebookアカウントURL   | sns_facebook       | varchar(255) |      |                  |              |
| InstagramアカウントURL   | sns_instagram       | varchar(255) |      |                  |              |
| メールアドレス     | email             | varchar(255) |      |                  | メールアドレス。ログインに使用                               |
| メールアドレス？   | email_verified_at | timestamp    |      |                  | ※要確認                                                      |
| パスワード         | password          | varchar(255) |      |                  | パスワード。ログインに使用                                   |
| リメンバートークン | remember_token    | varchar(100) |      |                  | パスワード。ログインに使用                                   |
| 会員登録認証用トークン | verify_token    | varchar(255) |      |                  | 認証用トークン(会員登録時に使用)         |
| パスワード再設定トークン | 	reset_password_access_key    | varchar(64) |      |                  | パスワード再設定トークン    |
| パスワード再設定キーの有効期限 | 	reset_password_expire_at    | timestamp  |                  | パスワード再設定キーの有効期限    |
| 承認ステータス     | is_approved   | tinyint      |      | 0    | 1：承認済                                                 |
| 管理者フラグ       | is_admin          | tinyint      |      | 0            | 1：管理者                                                 |
| 作成日時           | created_at        | timestamp    |      | レコード作成日時 | 作成日時（レコード作成日）                                   |
| 更新日時           | updated_at        | timestamp    |      | レコード作成日時 | 最終更新日時。レコード更新時に自動で上書き                   |
| 論理削除日時       | deleted_at        | timestamp    |      | null             | true：論理削除                                               |

### トピックテーブル

| 論理名         | 物理名     | 型       | PK  | 初期値     | 説明                                   |
| -------------- | ---------- | -------- | --- | ---------- | -------------------------------------- |
| ID             | id         | bigint      | ○   |            | トピックを識別する一意の ID            |
| タイトル           | title      | varchar(255)  |     |            |  |
| 本文           | content       | varchar(500)  |     |            | 上限 500 文字程度？                    |
| 投稿者         | user_id    | bigint      |     |            | ユーザーテーブルの ID                  |
| 投稿日時       | created_at  | timestamp |     |  CURRENT_TIMESTAMP  | トピック投稿日時（レコード作成日）     |
| 更新日時       | updated_at | timestamp |     | CURRENT_TIMESTAMP | トピック最終更新日時。初期値は投稿日時 |
| 論理削除日時 | deleted_at | timestamp  |     | null      |       |

### コメントテーブル

| 論理名         | 物理名     | 型       | PK  | 初期値 | 説明                               |
| -------------- | ---------- | -------- | --- | ------ | ---------------------------------- |
| ID             | id         | bigint      | ○   |        | コメントを識別する一意の ID        |
| コメント       | comment    | varchar(255)  |     |        |      |
| トピック ID    | topic_id   | bigint      |     |        | 紐づくトピックの ID                |
| 投稿者         | user_id    | bigint      |     |        | コメントを投稿したユーザーの ID    |
| 投稿日時       | created_at  | timestamp |     |  CURRENT_TIMESTAMP  | トピック投稿日時（レコード作成日）     |
| 更新日時       | updated_at | timestamp |     | CURRENT_TIMESTAMP | トピック最終更新日時。初期値は投稿日時 |
| 論理削除日時 | deleted_at | timestamp  |     | null      |       |


### サポートテーブル

| 論理名         | 物理名     | 型       | PK  | 初期値 | 説明                               |
| -------------- | ---------- | -------- | --- | ------ | ---------------------------------- |
| ID             | id         | bigint      | ○   |        |         |
| 本文       | message    | varchar(500)  |     |        |      |
| 投稿者         | user_id    | bigint      |     |        | 投稿者のユーザーID    |
| 作成日時       | created_at  | timestamp |     |  CURRENT_TIMESTAMP  | トピック投稿日時（レコード作成日）     |
| 更新日時       | updated_at | timestamp |     | CURRENT_TIMESTAMP | トピック最終更新日時。初期値は投稿日時 |
| 論理削除日時 | deleted_at | timestamp  |     | null      |       |

### お知らせテーブル

| 論理名         | 物理名     | 型       | PK  | 初期値 | 説明                               |
| -------------- | ---------- | -------- | --- | ------ | ---------------------------------- |
| ID             | id         | bigint      | ○   |        |         |
| タイトル        | title      | varchar(255)  |     |            |  |
| 本文           | content    | varchar(500)  |     |        |      |
| 作成者         | user_id    | bigint      |     |        | お知らせ作成者のユーザーID    |
| 公開開始日       | pub_start_at  | timestamp |     |   | |
| 公開終了日       | pub_end_at  | timestamp |     |   | |
| 公開フラグ       | is_public | tinyint |     |   | 1:公開中 |
| 作成日時       | created_at  | timestamp |     |  CURRENT_TIMESTAMP  | |
| 更新日時       | updated_at | timestamp |     | CURRENT_TIMESTAMP |  |
| 論理削除日時 | deleted_at | timestamp  |     | null      |       |

### お知らせ既読管理テーブル

| 論理名         | 物理名     | 型       | PK  | 初期値 | 説明                               |
| -------------- | ---------- | -------- | --- | ------ | ---------------------------------- |
| ユーザーID   | user_id         | bigint      | ○   |        |  usersテーブルのID   |
| お知らせID   | announcements_id | bigint      | ○   |        | announcementsテーブルのID |
