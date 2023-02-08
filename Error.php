<?php 
namespace Core;
class Error
{
    protected $debug;
    public function __construct($debug=true)
    {
        $this->debug = $debug;
    }
    public function error()
    {
        //默认错误全部关掉
        error_reporting(0);
        //所有错误都交给错误函数去处理 E_ALL 不包含建议 E_STRICT是建议
        set_error_handler([$this,'handle'],E_ALL | E_STRICT);
    }
    /**
     * $code 错误号
     * $error 错误信息
     * $file 错误文件
     * $line 错误行数
     */
    public function handle($code,$error,$file,$line)
    {
        $msg = $error."(错误码:$code)".$file."(行号:$line)";
        switch($code){
            //通知性错误
            case E_NOTICE:
                //开启debug时通知用户错误 开发用
                if($this->debug){
                    // echo $msg; //直接输出通知错误
                    //include "views/notic.php";//引入界面美观
                }else{
                    //线上用记录错误日志方便迭代更新
                }
                
                break;
            //其他可以补充
            default:
               //开启debug时通知用户错误 开发用
                if($this->debug){
                    echo $msg;
                }else{
                    //线上用记录错误日志方便迭代更新 也可以发送邮箱或者短信 使用一些方式进行去重
                    $file = 'logs/'.date("Y_m_d").'.log';
                    error_log(date('[c]').$msg.PHP_EOL,3,$file);
                }
                //die;//直接终止，不往下执行,按需求
                break;
        }
    }
}
?>