<!doctype html>
<html lang="en">
<?php
include 'langfunc.php';
require 'api_core.php';
$data_user = osu_user(3268516);
$country = $data_user['country'];
$country_name = $langlong_array[$country];
$country_id = $langshort_array[$country];
$unranked_score = $data_user['total_score'] - $data_user['ranked_score'];
$count_total = $data_user['count300'] + $data_user['count100'] + $data_user['count50'];
$count_rank_total = $data_user['count_rank_ss'] + $data_user['count_rank_s'] + $data_user['count_rank_a'];
?>
<head>
    <meta charset="utf-8">
        <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
        <title>Odelyt!a | A Custom osu! Profile Statistics</title>

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">

        <!-- iOS icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/touch/apple-touch-icon-57x57-precomposed.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#FFFFF">

        <!-- Generic Icon -->
        <link rel="shortcut icon" href="images/touch/touch-icon-57x57.png">

        <!-- SEO: If mobile URL is different from desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
        <!--
        <link rel="canonical" href="http://www.example.com/">
        -->
        
        <!-- Chrome Add to Homescreen -->
        <link rel="shortcut icon" sizes="196x196" href="images/touch/touch-icon-196x196.png">

        <!-- build:css styles/components/main.min.css -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
            WebFontConfig = {
                google: { families: [ 'Dosis:600:latin', 'Asap:400:latin', 'Armata:400:latin', 'Exo:500,500italic:latin', 'Ubuntu+Mono:700:latin' ] }
            };
            (function() {
                var wf = document.createElement('script');
                wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                wf.type = 'text/javascript';
                wf.async = 'true';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(wf, s);
            })(); 
        </script>
        <link rel="stylesheet" href="styles/h5bp.css">
        <link rel="stylesheet" href="styles/components/components.css">
        <link rel="stylesheet" href="styles/main.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles/flag-icon.css">
        <link rel="stylesheet" href="styles/tabbar.css">
        <link rel="stylesheet" href="styles/sw-style.css">
        <!-- endbuild -->
</head>
<body>
    <nav class="tab-bar">
        <div class="tab-selected-bg"></div>
        <button class="tab-btn tab-1" data-tabsection="achievement-tab-content"><i class="fa fa-star-half-o sw-font-awesome"></i></button>
        <button class="tab-btn tab-2" data-tabsection="performance-tab-content"><i class="fa fa-history sw-font-awesome"></i></button>
        <button class="tab-btn tab-3" data-tabsection="info-tab-content"><i class="fa fa-user sw-font-awesome"></i></button>
        <button class="tab-btn tab-4" data-tabsection="comment-tab-content"><i class="fa fa-comments sw-font-awesome"></i></button>
        <button class="tab-btn tab-5" data-tabsection="download-tab-content"><i class="fa fa-download sw-font-awesome"></i></button>
    </nav>

    <div class="content-container">
        <section class="achievement-tab-content tab-content">
            <h1 class="sw-centerize sw-big-header">Achievement Statistics</h1>
            <div class="g--half g--centered">
                <div class="g--half g--last">
                    <p class="sw-achievement-typograph sw-sub-head sw-p-clear">Total Hitkeys</p>
                    <p class="sw-achievement-typograph sw-sub-head-child sw-p-clear">
                        <?php
                            if ($count_total > 999 && $count_total <= 999999) {
                            $result_raw = $count_total / 1000;
                            $result = number_format($result_raw, 2) . ' K';
                            } elseif ($count_total > 999999) {
                            $result_raw = $count_total / 1000000;
                            $result = number_format($result_raw, 2) . ' M';
                            } else {
                            $result = $count_total;
                            }
                            echo $result;
                        ?>
                    </p>
                </div>
                <div class="g--half g--last">
                    <p class="sw-achievement-typograph sw-sub-head sw-p-clear">Total High Ranked Beatmap</p>
                    <p class="sw-achievement-typograph sw-sub-head-child sw-p-clear"><?php echo $count_rank_total; ?></p>
                </div>
            </div>
            <div class="g--half g--last">
                <div class="g-medium--2 g-medium--push-1 g-medium--last g-wide--3 g-wide--push-1 g-wide--last g--centered">
                    <div class="g--third">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">300 Hitkeys</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo $data_user['count300']; ?></p>
                    </div>
                    <div class="g--third">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">100 Hitkeys</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo $data_user['count100']; ?></p>
                    </div>
                    <div class="g--third g--last">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">50 Hitkeys</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo $data_user['count50']; ?></p>
                    </div>
                </div>
            </div>
            <div class="g--half g--last">
                <div class="g-medium--2 g-medium--push-1 g-medium--last g-wide--3 g-wide--push-1 g-wide--last g--centered">
                    <div class="g--third">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">SS Ranked</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo $data_user['count_rank_ss']; ?></p>
                    </div>
                    <div class="g--third">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">S Ranked</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo $data_user['count_rank_s']; ?></p>
                    </div>
                    <div class="g--third g--last">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">A Ranked</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo $data_user['count_rank_a']; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="performance-tab-content tab-content sw-bgperformance-tab-content">
            <h1 class="sw-centerize sw-big-header">Performance Statistics</h1>
            <div class="g-medium--1 g-wide--1 g-wide--push-1 sw-wide-fix sw-clear">
                <p class="sw-performance-typograph sw-sub-head sw-p-clear">Level</p>
                <p class="sw-performance-typograph sw-sub-head-child sw-p-clear"><?php echo floor($data_user['level']); ?></p>
            </div>
            <div class="g-medium--1 g-wide--1 sw-wide-fix sw-clear">
                <p class="sw-performance-typograph sw-sub-head sw-p-clear">Mode</p>
                <div class="sw-performance-typograph sw-sub-head-child sw-p-clear">
                    <div class="sw-icon sw-icon-mania"></div>
                    <p class="sw-performance-typograph sw-p-clear"><?php echo $game_mode;?></p>
                </div>
            </div>
            <div class="g-medium--1 g-wide--1 g-wide--pull-1 sw-wide-fix sw-wide-right-fix sw-clear">
                <p class="sw-performance-typograph sw-sub-head sw-p-clear">World Ranking</p>
                <p class="sw-performance-typograph sw-sub-head-child sw-p-clear">#<?php echo $data_user['pp_rank'] ;?></p>
            </div>
            <div class="g--half">
                <div class="g-medium--2 g-medium--push-1 g-medium--last g-wide--3 g-wide--push-1 g-wide--last">
                    <p class="sw-performance-typograph sw-sub-bighead sw-p-clear sw-border-top sw-border-bottom">Profile History</p>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-performance-typograph sw-sub-head sw-p-clear"># PP Point #</p>
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['pp_raw']) ;?></p>
                    </div>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-performance-typograph sw-sub-head sw-p-clear"># Accuracy #</p>
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['accuracy'], 2)?>%</p>
                    </div>
                    <div class="g--third g--last sw-padding-space-up">
                        <p class="sw-performance-typograph sw-sub-head sw-p-clear"># Play Count #</p>
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['playcount']) ;?></p>
                    </div>
                </div>
            </div>
            <div class="g--half g--last">
                <div class="g-medium--2 g-medium--last g-wide--3">
                    <p class="sw-performance-typograph sw-sub-bighead sw-p-clear sw-border-top sw-border-bottom">Score</p>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-performance-typograph sw-sub-head sw-p-clear"># Total #</p>
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear"><?php
                        if ($data_user['total_score'] > 999999 && $data_user['total_score'] <= 999999999) {
                        $result_raw = $data_user['total_score'] / 1000000;
                        $result = number_format($result_raw, 2) . ' M';
                        } elseif ($data_user['total_score'] > 999999999) {
                        $result_raw = $data_user['total_score'] / 1000000000;
                        $result = number_format($result_raw, 2) . ' B';
                        } else {
                        $result = $data_user['total_score'];
                        }
                        echo $result;
                        ?></p>
                    </div>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-performance-typograph sw-sub-head sw-p-clear"># Ranked #</p>
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear">
                            <?php
                            if ($data_user['ranked_score'] > 999999 && $data_user['ranked_score'] <= 999999999) {
                            $result_raw = $data_user['ranked_score'] / 1000000;
                            $result = number_format($result_raw, 2) . ' M';
                            } elseif ($data_user['ranked_score'] > 999999999) {
                            $result_raw = $data_user['ranked_score'] / 1000000000;
                            $result = number_format($result_raw, 2) . ' B';
                            } else {
                            $result = $data_user['ranked_score'];
                            }
                            echo $result;
                            ?>
                        </p>
                    </div>
                    <div class="g--third g--last sw-padding-space-up">
                        <p class="sw-performance-typograph sw-sub-head sw-p-clear"># Unranked #</p>
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear">
                            <?php
                            if ($unranked_score > 999999 && $unranked_score <= 999999999) {
                            $result_raw = $unranked_score / 1000000;
                            $result = number_format($result_raw, 2) . ' M';
                            } elseif ($unranked_score > 999999999) {
                            $result_raw = $unranked_score / 1000000000;
                            $result = number_format($result_raw, 2) . ' B';
                            } else {
                            $result = $unranked_score;
                            }
                            echo $result;
                        ?>
                        </p>
                    </div>
                </div>
            </div>
         
        </section>
        <section class="info-tab-content tab-content sw-bginfo-tab-content">
            <h1 class="sw-centerize sw-big-header">Personal Info</h1>
            <div class="color--user g--half g--centered sw-clear sw-marginize">
                <img class="sw-img-centerize sw-img-borderize" src="https://s.ppy.sh/a/<?php echo $data_user['user_id'];?>" alt="avatar">
            </div>
            <div class="color--user g--third sw-info-typograph sw-clear sw-marginize sw-center-align">
                <p class="sw-info-typograph sw-sub-title">#ID</p>
                <p class="sw-grid-separator"></p>
                <p class="sw-info-typograph sw-sub-content"><?php echo $data_user['user_id'] ;?></p>
            </div>
            <div class="color--user g--third sw-info-typograph sw-clear sw-marginize sw-center-align">
                <p class="sw-info-typograph sw-sub-title">Username</p>
                <p class="sw-grid-separator"></p>
                <p class="sw-info-typograph sw-sub-content"><?php echo $data_user['username'] ;?></p>
            </div>
            <div class="color--user g--third g--last sw-info-typograph sw-clear sw-marginize sw-center-align">
                <p class="sw-info-typograph sw-sub-title">Country</p>
                <p class="sw-info-typograph sw-sub-content"><?php echo $country_name ;?></p>
                <p class="flag flag-icon-background flag-icon-DE"></p>
            </div>
        </section>
        <section class="comment-tab-content tab-content">
            <h1 class="sw-centerize sw-big-header">Commentary</h1>
        </section>
        <section class="download-tab-content tab-content">
            <h1 class="sw-centerize sw-big-header">Download Source Code</h1>
        </section>
    </div>
    <script src="scripts/tabbar.js" type="text/javascript"></script>
    <script>
      var tabBtns = document.querySelectorAll('.tab-bar > button');
      for(var i = 0; i < tabBtns.length; i++) {
        tabBtns[i].addEventListener('click', tabBarBtnClick, true);
      }

      function tabBarBtnClick() {
        sampleCompleted('index.php-tabbtnclick');
      }
    </script>
</body>
    <?php //echo strftime("%A, %d %B %Y %H:%M:%S %Z", $data_user['updated']);?></div>
</html>
