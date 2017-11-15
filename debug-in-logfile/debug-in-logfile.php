<?php

/**
  Plugin Name: debug-in-logfile
  Plugin URI: https://kyutaro.github.io/
  Description: デバッグ内容をログファイルに出力するためのプラグイン
  Author: Hisashi Imahayashi
  Version: 0.1
  Author URI: https://kyutaro.github.io/
 */
class DebugInLogfile {

    /**
     * コンストラクタ
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_pages'));
    }

    /**
     * 管理画面にプラグイン用のページを追加する
     */
    public function add_pages() {
        add_menu_page('debug-in-logfile', 'debug-in-logfile', 'administrator', __FILE__, array($this, 'debug_in_logfile_option_page'), '', 85);
    }

    /**
     * 管理画面のビュー(HTML部分)を呼び出す
     */
    public function debug_in_logfile_option_page() {
        //オブション画面に表示する内容
        require_once 'optionView.php';
    }

    /**
     * デバッグログに変数の内容などを書き込むための一連の処理
     * 出力されるlogの場所：/wordpress/debug/
     * @param $debug デバッグ内容
     * @param string $file デバッグするファイル
     * @return type なし
     */
    public static function customDebugLog($debug, $file = false) {
        //日本時間のセット。サーバによってはUTC(世界標準時)の場合があるため。
        date_default_timezone_set('Asia/Tokyo');

        self::mkLogDir();

        $logFile = self::setLogFile($file);
        self::changeLogFile($logFile, $file);
        self::execDebugToFile($debug, $logFile);
    }

    /**
     * sql文をsql用のログファイルに書き込む
     * 命名規則は"debug_sql_yyyy-mm-dd.log"
     * 例えば以下のようにログが出力される
     *     例：debug_sql_2016-09-09.log
     */
    public static function sqlLog($debug) {
        self::customDebugLog($debug, 'sql');
    }

    /**
     * 管理画面のデバッグを管理画面用のログファイルに書き込む
     * 命名規則は"debug_admin_yyyy-mm-dd.log"
     * 例えば以下のようにログが出力される
     *     例：debug_admin_2016-09-09.log
     */
    public static function adminLog($debug) {
        self::customDebugLog($debug, 'admin');
    }

    /**
     * フロント画面のデバッグをフロント画面用のログファイルに書き込む
     * 命名規則は"debug_front_yyyy-mm-dd.log"
     * 例えば以下のようにログが出力される
     *     例：debug_front_2016-09-09.log
     */
    public static function frontLog($debug) {
        self::customDebugLog($debug, 'front');
    }

    /**
     * ログ用のディレクトリが存在しなければ作成する
     */
    private function mkLogDir() {
        $logDir = ABSPATH . '/debug/';
        if (!file_exists($logDir)) {
            mkdir($logDir);
        }
    }

    /**
     * 
     * @param type $file
     */
    private function setLogFile($file) {
        switch ($file) {
            case false:
                $logFile = ABSPATH . 'debug/debug_' . date('Y-m-d', time()) . '.log';
            case true:
                $logFile = ABSPATH . 'debug/debug_' . $file . '_' . date('Y-m-d', time()) . '.log';
        }
        return $logFile;
    }

    /**
     * ログファイル書き込みの際、800KBを超えていればログファイルを新しくする
     * なお800KBを超えたログファイルは"debug_YYYY-MM-DD_till_HH-ii-ss.log"の形式でリネーム保存される
     * @param string $logFile ログファイルのパス
     * @param string $file デバッグするファイルの種類。(例：フロントであれば $file == 'front' である)
     */
    private function changeLogFile($logFile, $file) {
        if (!file_exists($logFile)) {
            return false;
        }
        if (filesize($logFile) >= 800000) {
            switch ($file) {
                case false:
                    $reLogFile = ABSPATH . 'debug/debug_' . date('Y-m-d', time()) . '_till_' . date('H-i-s', time()) . '.log';
                case true:
                    $reLogFile = ABSPATH . 'debug/debug_' . $file . '_' . date('Y-m-d', time()) . '_till_' . date('H-i-s', time()) . '.log';
            }
            rename($logFile, $reLogFile);
        }
    }

    /**
     * 実際にログファイルに書き込む処理
     * @param $debug デバッグ内容
     * @param string $logFile ログファイルのパス
     */
    private function execDebugToFile($debug, $logFile) {
        //出力時間
        $today = date("Y-m-d H:i:s");
        $debugTime = "<DEBUG_TIME " . $today . ">";
        error_log($debugTime, 3, $logFile);
        //出力内容
        if (is_array($debug) || is_object($debug)) {
            error_log(print_r($debug, true), 3, $logFile);
        } else {
            error_log($debug, 3, $logFile);
        }
        //改行
        error_log("\n", 3, $logFile);
    }

}

$debugInLogfile = new DebugInLogfile;
