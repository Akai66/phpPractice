<?php
/**
 * Created by PhpStorm.
 * User: liukai
 * Date: 20/4/25
 * Time: 18:09
 */

error_reporting(E_ERROR);

//获取用户列表
class synGhData{

    private $token;

    private $startDate;

    private $basicHeader;

    private $userInfos;

    private $userWeeklyDatas = array();

    const DOMAIN_ID = 'ad585628-76bf-49eb-a433-c85613981461';

    const URL_GETUSERLIST = 'http://szzb-api.shengxunwei.com/api/User/GetUserList';

    const URL_GETREPORTLIST = 'http://szzb-api.shengxunwei.com/api/WeeklyReport/GetWeeklyReportList';

    const URL_GETREPORT = 'http://szzb-api.shengxunwei.com/api/WeeklyReport/GetWeeklyReport?';

    static $passUser = array(
        '姜锋',
        '李晗蕾',
        '刘俊杰',
        '胡云',
        '鲍晓宇',
        '梁铮',
        '王祖欣',
        '黄旭伟',
        '管理员',
        '吴海波',
        '李文东',
    );

    function __construct($token,$startDate){
        $this->token = $token;
        $this->startDate = $startDate;
        $this->basicHeader = array(
            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36",
            "Host: szzb-api.shengxunwei.com",
            "Origin: http://szzb.shengxunwei.com",
            "Referer: http://szzb.shengxunwei.com/",
            "token: {$this->token}",
        );
    }

    function run(){
        try{
            //获取用户列表信息
            $this->getUserInfos();
            //获取每个人该周的工时填报数据
            $this->getWeeklyDatas();
            echo json_encode($this->userWeeklyDatas,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * 获取用户列表信息
     * @throws Exception
     */
    function    getUserInfos(){
        $postData = array(
            'OrderBy' => '',
            'PagingInfo' => array(
                'currentPage' => 1,
                'pageSize' => 50,
                'totalPage' => 0,
                'totalCount' => 0,
            ),
            'Parameters' => array(
                'domainId' => self::DOMAIN_ID,
                'organizationId' => '',
                'organizationIdPath' => '',
                'keyword' => '',
            ),
        );
        $header = $this->basicHeader;
        $header[]="Content-Type: application/json;charset=UTF-8";
        $postRow = json_encode($postData);
        $header[]="Content-Length: ".strlen($postRow);
        $options = array(
            CURLOPT_URL               => self::URL_GETUSERLIST,
            CURLOPT_HTTPHEADER            => $header,
            CURLOPT_RETURNTRANSFER    => 1,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postRow,
        );

        $result = $this->curl($options);
        $result = json_decode($result,true);
        if(empty($result['data']['data'])){
            throw new Exception('获取用户列表失败');
        }
        $this->userInfos = $result['data']['data'];
    }

    /**
     * 获取每个人该周的工时填报数据
     */
    function getWeeklyDatas(){
        //以用户名称为索引,存储该周每个项目的工时
        $dateArr = explode('/',$this->startDate);
        $startYear = $endYear = $dateArr[0];
        $startMon = $endMon = intval($dateArr[1]);
        foreach ($this->userInfos as $user){
            $userId = $user['id'];
            $userName = $user['name'];
            if(in_array($userName,self::$passUser)){
                continue;
            }
            $postData = array(
                'OrderBy' => '',
                'PagingInfo' => array(
                    'currentPage' => 1,
                    'pageSize' => 10,
                    'totalPage' => 4,
                    'totalCount' => 0,
                ),
                'Parameters' => array(
                    'startYear' => $startYear,
                    'endYear' => $endYear,
                    'startMonth' => $startMon,
                    'endMonth' => $endMon,
                    'userId' => $userId,
                    'userName' => $userName,
                ),
            );
            $header = $this->basicHeader;
            $header[]="Content-Type: application/json;charset=UTF-8";
            $postRow = json_encode($postData);
            $header[]="Content-Length: ".strlen($postRow);
            $options = array(
                CURLOPT_URL               => self::URL_GETREPORTLIST,
                CURLOPT_HTTPHEADER            => $header,
                CURLOPT_RETURNTRANSFER    => 1,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postRow,
            );
            $result = $this->curl($options);
            $result = json_decode($result,true);
            if(empty($result['data']['data'])){
                echo "获取工时列表失败,name:$userName\n";
                continue;
            }
            $reportList = $result['data']['data'];
            //定位要查询的report数据
            $reqId = '';
            foreach ($reportList as $report){
                if(stripos($report['monday'],$this->startDate) !== false){
                    $reqId = $report['id'];
                    break;
                }
            }
            if(empty($reqId)){
                echo "获取本周工时report失败,name:$userName\n";
                continue;
            }
            $header = $this->basicHeader;
            $options = array(
                CURLOPT_URL               => self::URL_GETREPORT . "id={$reqId}",
                CURLOPT_HTTPHEADER            => $header,
                CURLOPT_RETURNTRANSFER    => 1,
                CURLOPT_POST => true,
            );
            $result = $this->curl($options);
            $result = json_decode($result,true);
            if(empty($result['data']['weeklyReportItem_BusinessOpportunity']) && empty($result['data']['weeklyReportItem_Task'])){
                echo "获取工时报告失败,name:$userName\n";
                continue;
            }
            $this->userWeeklyDatas[$userName] = array();
            //统计商机工时
            foreach ($result['data']['weeklyReportItem_BusinessOpportunity'] as $businessItem){
                if($businessItem['spentTime'] > 0){
                    $date = explode(' ',$businessItem['date'])[0];
                    $this->userWeeklyDatas[$userName][] = array(
                        'task' => $businessItem['businessOpportunitySerialNumber'],
                        'date' => $date,
                        'time' => $businessItem['spentTime'],
                        'content' => $businessItem['content'],
                    );
                }
            }
            //统计一般任务
            foreach ($result['data']['weeklyReportItem_Task'] as $taskItem){
                if($taskItem['spentTime'] > 0){
                    $date = explode(' ',$taskItem['date'])[0];
                    $this->userWeeklyDatas[$userName][] = array(
                        'task' => $taskItem['taskName'],
                        'date' => $date,
                        'time' => $taskItem['spentTime'],
                        'content' => $taskItem['content'],
                    );
                }
            }
        }
    }

    /**
     * 发送请求
     * @param array $options
     * @return mixed
     */
    function curl($options=array()){
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}

//参数1:token,参数2:开始日期(星期一) 日期格式如:2020/03/30
if(empty($argv[1])){
    echo "token必传!";
    return;
}
if(empty($argv[2])){
    echo "开始日期必传!";
    return;
}
$token = $argv[1];
$startDate = $argv[2];
$worker = new synGhData($token,$startDate);
$worker->run();




