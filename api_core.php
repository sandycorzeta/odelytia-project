<?php
   
ini_set('display_errors','on');
/**
Welcome to Cosu!P Statistics Core API Library.
This file save all of configurations that have been set up, for parsing the data to the front end a.k.a Web
**/
include 'langfunc.php';
//Database Conf
$osu_dbhost = "53bd65e14382ecc4c800039d-scorzprivate.rhcloud.com" ;
$osu_dbname = "osu_db" ;
$osu_dbuser = "adminyCMJSds" ;
$osu_dbpass = "C7ryPXfiIFGa" ;
$osu_port = "63541" ;

//Basic Conf
$uid = '3268516'; // Insert your userid here
$osu_mode = '3'; // Pick the main of your osu mode gameplay. 0 = osu!standard, 1 = Taiko, 2 = Catch The Beat, 3 = osu!Mania.
$osu_api_key = '904a8856dcf8f3b133e230d00f5dbdf81b96765d'; // Input your osu API Key from http://osu.ppy.sh/p/api

if ($osu_mode == '0'){
    $game_mode = 'osu!';
} elseif ($osu_mode == '1'){
    $game_mode = 'Taiko';
} elseif ($osu_mode == '2'){
    $game_mode = 'Catch The Beat';
} elseif ($osu_mode == '3'){
    $game_mode = 'osu!Mania';
}

//Osu API Core class

function osu_user($osu_finduser,$osu_oldactivity=false,$osu_forcecache=FALSE,$osu_cache_expire=60){
    
    global $osu_dbhost, $osu_dbname, $osu_dbuser, $osu_dbpass, $uid, $osu_mode, $osu_api_key, $event_days, $langlong_array, $langshort_array;

    $osu_db = new PDO("mysql:host=${osu_dbhost};port=${osu_port};dbname=${osu_dbname}", $osu_dbuser, $osu_dbpass, array(PDO::ATTR_PERSISTENT => TRUE));
    $osu_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($osu_oldactivity == true){
        $event_days = '7' ;
        if ($osu_cache_expire != 0){
            $osu_query_select = $osu_db->prepare("SELECT * FROM osu_user WHERE user_id=:osuuser");
            $osu_query_select->bindParam(':osuuser', $osu_finduser);
            $osu_query_select->execute();
            $osu_query_fetch = $osu_query_select->fetch();            
            }
    } else {
        $event_days = '0' ;
    }
    
    if ($osu_oldactivity == false){
        if ($osu_cache_expire != 0){
            $osu_query_select = $osu_db->prepare("SELECT * FROM osu_user WHERE user_id=:osuuser");
            $osu_query_select->bindParam(':osuuser', $osu_finduser);
            $osu_query_select->execute();
            $osu_query_fetch = $osu_query_select->fetch();
            $osu_fetch_time = $osu_query_fetch["updated"];
            $osu_updatetime = time();
            $cache_expire = $osu_updatetime-$osu_fetch_time;
            } else {
                $cache_expire = -1;
                $osu_forcecache = FALSE;
            }
        } else {
            $cache_expire = -1;
        }

    if (!$osu_forcecache && (($cache_expire > $osu_cache_expire) || ($cache_expire < 0))){
        $osu_user_api = file_get_contents("https://osu.ppy.sh/api/get_user?k=${osu_api_key}&u=${osu_finduser}&type=id&m=${osu_mode}&event_days=${event_days}");
        $parse_user_api = json_decode($osu_user_api, TRUE);
        $data_user = $parse_user_api[0];
        $count_total = $data_user['count300'] + $data_user['count100'] + $data_user['count50'];
        $count_rank_total = $data_user['count_rank_ss'] + $data_user['count_rank_s'] + $data_user['count_rank_a'];
        $unranked_score = $data_user['total_score'] - $data_user['ranked_score'];
        $insert_query_db = $osu_db->prepare("INSERT INTO osu_user (user_id, username, count300, count100, count50, playcount, ranked_score, total_score, pp_rank, level, pp_raw, accuracy, count_rank_ss, count_rank_s, count_rank_a, country, updated, count_total, count_rank_total, unranked_score) VALUES (:user_id, :username, :count300, :count100, :count50, :playcount, :ranked_score, :total_score, :pp_rank, :level, :pp_raw, :accuracy, :count_rank_ss, :count_rank_s, :count_rank_a, :country, :updated, :count_total, :count_rank_total, :unranked_score) ON DUPLICATE KEY UPDATE user_id=VALUES(user_id), username=VALUES(username), count300=VALUES(count300), count100=VALUES(count100), count50=VALUES(count50), playcount=VALUES(playcount), ranked_score=VALUES(ranked_score), total_score=VALUES(total_score), pp_rank=VALUES(pp_rank), level=VALUES(level), pp_raw=VALUES(pp_raw), accuracy=VALUES(accuracy), count_rank_ss=VALUES(count_rank_ss), count_rank_s=VALUES(count_rank_s), count_rank_a=VALUES(count_rank_a), country=VALUES(country), updated=VALUES(updated), count_total=VALUES(count_total), count_rank_total=VALUES(count_rank_total), unranked_score=VALUES(unranked_score)");
        $insert_query_db->bindParam(':user_id', $data_user['user_id']);
        $insert_query_db->bindParam(':username', $data_user['username']);
        $insert_query_db->bindParam(':count300', $data_user['count300']);
        $insert_query_db->bindParam(':count100', $data_user['count100']);
        $insert_query_db->bindParam(':count50', $data_user['count50']);
        $insert_query_db->bindParam(':playcount', $data_user['playcount']);
        $insert_query_db->bindParam(':ranked_score', $data_user['ranked_score']);
        $insert_query_db->bindParam(':total_score', $data_user['total_score']);
        $insert_query_db->bindParam(':pp_rank', $data_user['pp_rank']);
        $insert_query_db->bindParam(':level', $data_user['level']);
        $insert_query_db->bindParam(':pp_raw', $data_user['pp_raw']);
        $insert_query_db->bindParam(':accuracy', $data_user['accuracy']);
        $insert_query_db->bindParam(':count_rank_ss', $data_user['count_rank_ss']);
        $insert_query_db->bindParam(':count_rank_s', $data_user['count_rank_s']);
        $insert_query_db->bindParam(':count_rank_a', $data_user['count_rank_a']);
        $insert_query_db->bindParam(':country', $data_user['country']);
        $insert_query_db->bindParam(':updated', $osu_updatetime);
        $insert_query_db->bindParam(':count_total', $count_total);
        $insert_query_db->bindParam(':count_rank_total', $count_rank_total);
        $insert_query_db->bindParam(':unranked_score', $unranked_score);
        $insert_query_db->execute();

        $data_user['updated'] = $osu_updatetime;
    } else {
        $data_user = array(
            "user_id" => $osu_query_fetch['user_id'],
            "username" => $osu_query_fetch['username'],
            "count300" => $osu_query_fetch['count300'],
            "count100" => $osu_query_fetch['count100'],
            "count50" => $osu_query_fetch['count50'],
            "playcount" => $osu_query_fetch['playcount'],
            "ranked_score" => $osu_query_fetch['ranked_score'],
            "total_score" => $osu_query_fetch['total_score'],
            "pp_rank" => $osu_query_fetch['pp_rank'],
            "level" => $osu_query_fetch['level'],
            "pp_raw" => $osu_query_fetch['pp_raw'],
            "accuracy" => $osu_query_fetch['accuracy'],
            "count_rank_ss" => $osu_query_fetch['count_rank_ss'],
            "count_rank_s" => $osu_query_fetch['count_rank_s'],
            "count_rank_a" => $osu_query_fetch['count_rank_a'],
            "country" => $osu_query_fetch['country'],
            "updated" => $osu_query_fetch['updated'],
            "count_total" => $osu_query_fetch['count_total'],
            "count_rank_total" => $osu_query_fetch['count_rank_total'],
            "unranked_score" => $osu_query_fetch['unranked_score'],
            "events" => array(),
        );

    }
    return $data_user;
    return $langlong_array; //taken from langfunc.php
    return $langshort_array; //taken from langfunc.php
}
//$data_user=osu_user(3268516, FALSE, true, 60);
//$country = $data_user['country'] ;
//$country_name = $langlong_array[$country]  ;
//echo $country_name ;
//echo "Username: ".$data_user['username']." (".$data_user['user_id'].")     Rank: \n";
//echo "Play count: ".$data_user['playcount']."\n";
//echo "300: ".$data_user['count300']." | 100: ".$data_user['count100']." | 50: ".$data_user['count50']."\n";
//echo "Updated: ".$data_user["updated"]."\n";