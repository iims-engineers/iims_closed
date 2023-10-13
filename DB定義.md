# MOT2 DB 設計

## 必要なテーブル

- ユーザー

- トピック

- コメント

### ユーザーテーブル

| 論理名           | 物理名            | 型          | PK  | 初期値     | 説明                                                            |
| ---------------- | ----------------- | ----------- | --- | ---------- | --------------------------------------------------------------- |
| ID               | id                | int         | ○   |            | ユーザーを識別する一意の ID                                     |
| 姓               | last_name         | varchar(50) |     |            | 姓                                                              |
| 名               | first_name        | varchar(50) |     |            | 名                                                              |
| 姓（カナ）       | last_name_kana    | varchar(50) |     |            | 姓（カナ）                                                      |
| 名（カナ）       | first_name_kana   | varchar(50) |     |            | 名（カナ）                                                      |
| イニシャル       | initial           | varchar     |     |            | 氏名のイニシャル<br /> 非ログイン時は氏名をイニシャルで表示する |
| 生年月日         | birthday          | date        |     |            |                                                                 |
| 国籍             | nationality       | varchar     |     |            | 入力式                                                          |
| 自己紹介         | introduction_text | varchar     |     |            | 自由記述型の自己紹介文                                          |
| パスワード       | password          | varchar     |     |            | パスワード。ログインに使用                                      |
| メールアドレス   | email             | varchar     |     |            | メールアドレス。ログインに使用                                  |
| 管理者フラグ     | is_admin          | boolean     |     | false      | true：管理者権限                                                |
| 作成日時         | created_at        | datetime    |     |            | アカウント作成日時（レコード作成日）                            |
| 更新日時         | updated_at        | datetime    |     | created_at | アカウント最終更新日時。初期値は作成日時                        |
| 最終ログイン日時 | last_login_at     | datetime    |     |            | アカウントの最終ログイン日時                                    |
| 論理削除フラグ   | is_deleted        | boolean     |     | false      | true：論理削除                                                  |

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
