=== debug-in-logfile ===
Contributors: Hisashi Imahayashi

ログ出力用のプラグインです。
開発の際の補助として是非ご活用ください。

== 説明 ==

 = 基本的な使い方 =

1.プラグインを有効化
2.デバッグ出力したい箇所で以下のように書く
    DebugInLogfile::customDebugLog($sample);
    ※引数の$sampleは出力したい変数や文字列。配列やオブジェクトも入れることが出来る。
3.wordpress直下にdebugフォルダが作成され、中に"debug_yyyy-mm-dd.log"の形式で日付毎にログファイルが作成される
    例：ログファイル作成日が2016/09/09であれば"debug_2016-09-09.log"が作成される。

= 画面毎にログファイルを出力する場合 =

用途に応じて出力するログファイルを切り分けることが出来ます。
基本的な使い方は同じで全て/debugフォルダに格納されます。

[パターン1]
関数：DebugInLogfile::customDebugLog($debug, $file);
     ※$fileは文字列
ファイル形式：debug_YYYY-MM-DD.log
例：debug_2016-09-09.log
    $file = "custom"の場合：debug_custom_2016-09-09.log
備考：デバッグを出力するためのログファイル。第二引数$file(文字列)を指定することで通常のログファイルと別のログファイルに出力できる

[パターン2]
関数：DebugInLogfile::frontLog($debug);
ファイル形式：debug_front_YYYY-MM-DD.log
例：debug_front_2016-09-09.log
備考：フロント画面のデバッグを出力するためのログファイル

[パターン3]
関数：DebugInLogfile::adminLog($debug);
ファイル形式：debug_admin_YYYY-MM-DD.log
例：debug_admin_2016-09-09.log
備考：管理画面のデバッグを出力するためのログファイル

[パターン4]
関数：DebugInLogfile::adminLog($debug);
ファイル形式：debug_sql_YYYY-MM-DD.log
例：debug_sql_2016-09-09.log
備考：sqlのデバッグを出力するためのログファイル

== インストール ==

1. `debug-in-logfile`ディレクトリを`/wp-content/plugins/`ディレクトリの下に配置
2. ワードプレス管理 > プラグイン画面 にて`debug-in-logfile`プラグインを有効化

== 変更履歴 ==

= 1.0 =
* 初コミット