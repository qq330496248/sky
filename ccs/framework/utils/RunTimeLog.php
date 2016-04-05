<?php

/**
 * @desc 记录脚本运行时间
 * @author ChenLuoyong
 * @date 2015-1-14
 */
class RunTimeLog
{

    /**
     * 脚本开始时间
     *
     * @var float
     */
    private $scriptStart;

    /**
     * 脚本结束时间
     *
     * @var float
     */
    private $scriptEnd;

    /**
     * 用到的方法数组
     *
     * @var array
     */
    private $action;

    /**
     * 保存数据的表名
     *
     * @var string
     */
    private static $table;

    /**
     * 数据库链接对象
     *
     * @var object
     */
    private $dbc;

    /**
     * 数据库命令对象
     *
     * @var object
     */
    private $dbcmd;

    /**
     * 累计计时对象
     *
     * @var array
     */
    private static $mbiao;

    /**
     * 初始化
     *
     * @param string $route            
     */
    public function __construct($route = '')
    {
        $this->scriptStart = $this->getMicrotime();
        $this->action[] = $route;
        self::$table = 'script_runtime';
        $this->dbc = Yii::app()->db;
        $this->dbcmd = $this->dbc->createCommand();
        self::$mbiao = array();
    }

    /**
     * 保存数据
     *
     * @author ChenLuoyong
     */
    public function __destruct()
    {
        $this->scriptEnd = $this->getMicrotime();
        
        $spendtime = $this->scriptEnd - $this->scriptStart;
        $request_uri = $_SERVER['REQUEST_URI'];
        $pos = strpos($request_uri, '?r=');
        if ($pos > 0) {
            $request_uri = substr($request_uri, $pos + 1);
        }
        if ($_POST) {
            $request_uri .= json_encode($_POST);
        }
        $data['request_uri'] = $request_uri;
        $data['starttime'] = $this->scriptStart;
        $data['endtime'] = $this->scriptEnd;
        $data['runtime'] = round($spendtime, 3);
        $data['track_time'] = $spendtime;
        $user_IP = (@$_SERVER["HTTP_VIA"]) ? @$_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
        $data['ip'] = $user_IP;
        $data['action'] = json_encode($this->action);
        $referener = @$_SERVER['HTTP_REFERER'];
        $data['referer'] = $referener;
        $data['agent'] = $_SERVER["HTTP_USER_AGENT"];
        
        if ($spendtime > 0) {
            // 写入数据库
            $this->dbcmd->insert(self::$table, $data);
        }
    }

    /**
     * 获取新对象
     *
     * @return RunTimeLog
     * @author YangLong
     */
    static public function getNew($route = '')
    {
        return new static($route);
    }

    /**
     * 获取包含微妙的时间戳
     *
     * @author ChenLuoyong
     * @return mixed
     */
    static private function getMicrotime()
    {
        return microtime(true);
    }

    /**
     * 秒表开始/记录/结束
     *
     * @param string $action            
     * @param string $save            
     */
    static public function dbStart($action = '', $save = FALSE)
    {
        if (! empty(self::$mbiao) && $save) {
            $request_uri = $_SERVER['REQUEST_URI'];
            $pos = strpos($request_uri, '?r=');
            if ($pos > 0) {
                $request_uri = substr($request_uri, $pos + 1);
            }
            if ($_POST) {
                $request_uri .= json_encode($_POST);
            }
            if (empty(self::$mbiao)) {
                self::$mbiao[] = self::getMicrotime();
            } else {
                self::$mbiao[] = self::$mbiao[count(self::$mbiao) - 1] - self::getMicrotime();
            }
            $tmp = self::$mbiao;
            $tmp[0] = 0;
            $data = array(
                'request_uri' => $request_uri,
                'starttime' => self::$mbiao[0],
                'endtime' => self::$mbiao[count(self::$mbiao) - 1],
                'runtime' => array_sum(self::$mbiao) - self::$mbiao[0],
                'track_time' => implode('-', $tmp),
                'action' => $action,
                'ip' => (@$_SERVER["HTTP_VIA"]) ? @$_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"],
                'referer' => $referener = @$_SERVER['HTTP_REFERER'],
                'agent' => $_SERVER["HTTP_USER_AGENT"]
            );
            $dbc = Yii::app()->db;
            $dbcmd = $dbc->createCommand();
            $dbcmd->insert('script_runtime', $data);
        } else {
            if (empty(self::$mbiao)) {
                self::$mbiao[] = self::getMicrotime();
            } else {
                self::$mbiao[] = self::$mbiao[count(self::$mbiao) - 1] - self::getMicrotime();
            }
        }
    }
}