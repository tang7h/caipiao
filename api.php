<?php
    header("Content-Type:text/html;charset=utf-8");
    $data = file_get_contents("http://api.caipiaokong.com/live/?name=jczq&format=json&uid=109324&token=1d9da94d8d6d095d2cf1bc7cca4efe35a98b30ba");
    $data_arr = json_decode($data,true);
//    echo "<pre>";
//    print_r($data_arr);
//    exit();
    $servername = "127.0.0.1";
    $username = "root";
    $password = "3133974";
    $dbname = "positemall";
    
    // 创建连接
     $conn = new mysqli($servername, $username, $password, $dbname);
//     // 检测连接
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        
    
    
    
    $field1="id,match_num,phase,official_date,official_num,create_at,time_endsale,match_name,match_date,home_team,away_team,first_half,second_half,final_score,status,weekday,handicap,current0,current1,current3,trend_spf,current_spf,current_rqspf,trend_rqspf,current_bqc,trend_bqc,current_jqs,trend_jqs,current_bf,trend_bf,odds_avg,odds_wlxe,odds_libo,odds_bet365,odds_bwin,odds_yapan";
    $field2=explode(',',$field1);
   // var_dump($field2);exit();
    $field="";
    $value="";
    foreach($data_arr as $key =>$val) {
        //var_dump($val);
        foreach($field2 as $k=>$v){
            if(is_array($val[$v])){
                $kkk="";
                foreach ($val[$v] as $kk=>$vv){
                    $kkk.=$vv."|";
                }
                $kkk=trim($kkk,'|');
                $value.="'".$kkk."',";
            }else{
           $value.="'".$val[$v]."',"; 
            }
        }
        //$field="(".trim($field,",").")";
        $value="(".trim($value,",").")";
        //echo $value."<br/>";
        
        $sql = "INSERT INTO jczq (".$field1.") VALUES ".$value;
        
//      echo $sql."<br/>";
        if ($conn->query($sql) === TRUE) {
            echo "数据储存成功~";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $value='';
       // $field="";
        $sql="";
    }
    
   $conn->close();
//    echo "$sql";