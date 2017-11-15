<script src="/wp-content/plugins/debug-in-logfile/option.js"></script>
<div class="wrap">
    <div id="icon-options-general" class="icon32">
        <br />
    </div>
    <h2>
        debug-in-logfileの使い方
    </h2>
    <p>
        このプラグインはデバッグ出力によって開発の効率化につなげるために開発されました。<br />
        以下はプラグインの使い方になります。
    </p>
    <h3>
        基本的な使い方
    </h3>
    <ol>
        <li>プラグインを有効化</li>
        <li>
            デバッグ出力したい箇所で以下のように書く。<br />
            &nbsp;&nbsp;&nbsp;&nbsp;DebugInLogfile::customDebugLog($sample);<br />
            ※引数の$sampleは出力したい変数や文字列。配列やオブジェクトも入れることが出来る。
        </li>
        <li>
            wordpress直下にdebugフォルダが作成され、中に"debug_yyyy-mm-dd.log"の形式で日付毎にログファイルが作成される。<br />
            &nbsp;&nbsp;&nbsp;&nbsp;例：ログファイル作成日が2016/09/09であれば"debug_2016-09-09.log"が作成される。<br />
        </li>
    </ol>
    <h3>
        画面毎にログファイルを出力する場合
    </h3>
    <p>
        用途に応じて出力するログファイルを切り分けることが出来ます。<br />
        基本的な使い方は同じで全て/debugフォルダに格納されます。
    </p>
    <table border="1" width="1000" cellspacing="0" cellpadding="5">
        <tr>
            <th bgcolor="#EE0000"><font color="#FFFFFF">関数</font></th>
            <th bgcolor="#EE0000" width="200"><font color="#FFFFFF">ファイル形式</font></th>
            <th bgcolor="#EE0000" width="200"><font color="#FFFFFF">例</font></th>
            <th bgcolor="#EE0000" width="700"><font color="#FFFFFF">備考</font></th>
        </tr>
        <tr>
            <td bgcolor="#FFF" align="" nowrap>
                DebugInLogfile::customDebugLog($debug, $file);<br />
                ※$fileは文字列
            </td>
            <td bgcolor="#FFF" width="300">debug_YYYY-MM-DD.log</td>
            <td bgcolor="#FFF" width="400">
                debug_2016-09-09.log<br />
                $file = "custom"の場合：<br />
                &nbsp;&nbsp;&nbsp;&nbsp;debug_custom_2016-09-09.log
            </td>
            <td bgcolor="#FFF" align="left" width="700">デバッグを出力するためのログファイル。第二引数$file(文字列)を指定することで通常のログファイルと別のログファイルに出力できる</td>
        </tr>        
        <tr>
            <td bgcolor="#FFF" align="" nowrap>DebugInLogfile::frontLog($debug);</td>
            <td bgcolor="#FFF" width="300">debug_front_YYYY-MM-DD.log</td>
            <td bgcolor="#FFF" width="400">debug_front_2016-09-09.log</td>
            <td bgcolor="#FFF" align="left" width="700">フロント画面のデバッグを出力するためのログファイル</td>
        </tr>
        <tr>
            <td bgcolor="#FFF" nowrap>DebugInLogfile::adminLog($debug);</td>
            <td bgcolor="#FFF" width="300">debug_admin_YYYY-MM-DD.log</td>
            <td bgcolor="#FFF" width="400">debug_admin_2016-09-09.log</td>
            <td bgcolor="#FFF" align="left" width="700">管理画面のデバッグを出力するためのログファイル</td>
        </tr>
        <tr>
            <td bgcolor="#FFF" nowrap>DebugInLogfile::sqlog($debug);</td>
            <td bgcolor="#FFF" width="300">debug_sql_YYYY-MM-DD.log</td>
            <td bgcolor="#FFF" width="400">debug_sql_2016-09-09.log</td>
            <td bgcolor="#FFF" align="left" width="700">sqlのデバッグを出力するためのログファイル</td>
        </tr>        
    </table>
    <h3>
        備考
    </h3>    
    <p>
        ログファイルの容量が800KBを超えた場合、リネームされて、新しいログファイルが作成される。<br />
        リネームされたログファイル名は"debug_YYYY-MM-DD_till_HH-ii-ss.log"となる。<br />
        &nbsp;&nbsp;&nbsp;&nbsp;例：ログファイル名が"debug_2016-09-09.log"のものがあれば"debug_2016-09-09_till_11-00-11.log"が作成される。<br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;※現在日時が11時00分11秒の時。
    </p>

    <!-- /.wrap -->
</div>