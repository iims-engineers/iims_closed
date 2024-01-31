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
| カナ               | name_kana         | varchar(255) |      |                  | 氏名フリガナ                                                 |
| イニシャル         | initial           | varchar(255) |      |                  | 氏名のイニシャル<br /> 非ログイン時は氏名をイニシャルで表示する |
| 生年月日           | birthday          | date         |      |                  |                                                              |
| 国籍               | nationality       | varchar(255) |      |                  | 入力式                                                       |
| 自己紹介           | introduction_text | varchar(500) |      |                  | 自由記述型の自己紹介文                                       |
| メールアドレス     | email             | varchar(255) |      |                  | メールアドレス。ログインに使用                               |
| メールアドレス？   | email_verified_at | timestamp    |      |                  | ※要確認                                                      |
| パスワード         | password          | varchar(255) |      |                  | パスワード。ログインに使用                                   |
| リメンバートークン | remember_token    | varchar(100) |      |                  | パスワード。ログインに使用                                   |
| 管理者フラグ       | is_admin          | boolean      |      | false            | true：管理者                                                 |
| 承認ステータス     | is_approved       | boolean      |      | false            | true：承認済                                                 |
| 作成日時           | created_at        | timestamp    |      | レコード作成日時 | 作成日時（レコード作成日）                                   |
| 更新日時           | updated_at        | timestamp    |      | レコード作成日時 | 最終更新日時。レコード更新時に自動で上書き                   |
| 最終ログイン日時   | last_login_at     | timestamp    |      | null             | アカウントの最終ログイン日時                                 |
| 論理削除日時       | deleted_at        | timestamp    |      | null             | true：論理削除                                               |

### トピックテーブル

| 論理名         | 物理名     | 型       | PK  | 初期値     | 説明                                   |
| -------------- | ---------- | -------- | --- | ---------- | -------------------------------------- |
| ID             | id         | int      | ○   |            | トピックを識別する一意の ID            |
| 件名           | title      | varchar  |     |            | 上限 50 文字程度？                     |
| 本文           | text       | varchar  |     |            | 上限 500 文字程度？                    |
| 投稿者         | user_id    | int      |     |            | ユーザーテーブルの ID                  |
| 投稿日時       | posted_at  | datetime |     |            | トピック投稿日時（レコード作成日）     |
| 更新日時       | updated_at | datetime |     | created_at | トピック最終更新日時。初期値は投稿日時 |
| 論理削除フラグ | is_deleted | boolean  |     | false      | true：論理削除                         |

### コメントテーブル

| 論理名         | 物理名     | 型       | PK  | 初期値 | 説明                               |
| -------------- | ---------- | -------- | --- | ------ | ---------------------------------- |
| ID             | id         | int      | ○   |        | コメントを識別する一意の ID        |
| コメント       | comment    | varchar  |     |        | 上限 500 文字程度？                |
| トピック ID    | topic_id   | int      |     |        | 紐づくトピックの ID                |
| 投稿者         | user_id    | int      |     |        | コメントを投稿したユーザーの ID    |
| 投稿日時       | posted_at  | datetime |     |        | コメント投稿日時（レコード作成日） |
| 論理削除フラグ | is_deleted | boolean  |     | false  | true：論理削除                     |
