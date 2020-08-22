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
        <link rel="stylesheet" href="styles/h5bp.css">
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/components/components.css">
        <link rel="stylesheet" href="styles/main.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles/flag-icon.css">
        <link rel="stylesheet" href="styles/tabbar.css">
        <link rel="stylesheet" href="styles/sw-style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Asap:wght@400&family=Dosis:wght@600&family=Armata:wght@400&family=Exo:ital,wght@0,500;1,500&family=Ubuntu+Mono:wght@700&display=swap">
        <!-- endbuild -->
</head>
<body>
    <nav class="tab-bar">
        <div class="tab-selected-bg"></div>
        <button class="tab-btn tab-1" data-tabsection="achievement-tab-content"><i class="fa fa-star-half-o sw-font-awesome"></i></button>
        <button class="tab-btn tab-2" data-tabsection="performance-tab-content"><i class="fa fa-history sw-font-awesome"></i></button>
        <button class="tab-btn tab-3" data-tabsection="info-tab-content"><i class="fa fa-user sw-font-awesome"></i></button>
        <button class="tab-btn tab-4" data-tabsection="thanks-tab-content"><i class="fa fa-heart sw-font-awesome"></i></button>
        <button class="tab-btn tab-5" data-tabsection="download-tab-content"><i class="fa fa-download sw-font-awesome"></i></button>
    </nav>

    <div class="content-container">
        <section class="achievement-tab-content tab-content sw-bgachievement-tab-content">
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
                    <p class="sw-achievement-typograph sw-sub-head-child sw-p-clear"><?php echo number_format($count_rank_total); ?></p>
                </div>
            </div>
            <div class="g--half g--last">
                <div class="g-medium--2 g-medium--push-1 g-medium--last g-wide--3 g-wide--push-1 g-wide--last g--centered">
                    <p class="sw-achievement-typograph sw-sub-bighead sw-p-clear sw-border-top sw-border-bottom">Hitkey Score</p>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">300 Hitkeys</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['count300']); ?></p>
                    </div>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">100 Hitkeys</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['count100']); ?></p>
                    </div>
                    <div class="g--third g--last sw-padding-space-up">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">50 Hitkeys</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['count50']); ?></p>
                    </div>
                </div>
            </div>
            <div class="g--half g--last">
                <div class="g-medium--2 g-medium--push-1 g-medium--last g-wide--3 g-wide--push-1 g-wide--last g--centered">
                    <p class="sw-achievement-typograph sw-sub-bighead sw-p-clear sw-border-top sw-border-bottom">Beatmap Passed</p>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">SS Ranked</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['count_rank_ss']); ?></p>
                    </div>
                    <div class="g--third sw-padding-space-up">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">S Ranked</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['count_rank_s']); ?></p>
                    </div>
                    <div class="g--third g--last sw-padding-space-up">
                        <p class="sw-achievement-typograph sw-sub-head sw-p-clear">A Ranked</p>
                        <p class="sw-achievement-typograph sw-sub-head-child-small sw-p-clear"><?php echo number_format($data_user['count_rank_a']); ?></p>
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
                    <div class="sw-icon sw-icon-<?php echo $game_mode_id ;?>"></div>
                    <p class="sw-performance-typograph sw-p-clear"><?php echo $game_mode;?></p>
                </div>
            </div>
            <div class="g-medium--1 g-wide--1 g-wide--pull-1 sw-wide-fix sw-wide-right-fix sw-clear">
                <p class="sw-performance-typograph sw-sub-head sw-p-clear">World Ranking</p>
                <p class="sw-performance-typograph sw-sub-head-child sw-p-clear">#<?php echo $data_user['pp_rank'] ;?></p>
            </div>
            <div class="g--half g--centered">
              <p class="sw-performance-typograph sw-sub-head sw-p-clear sw-padding-space-down">Data Updated : <?php echo strftime("%A, %d %B %Y %H:%M:%S %Z", $data_user['updated']);?></p>
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
                        <p class="sw-performance-typograph sw-sub-head-child-small sw-p-clear">
                            <?php
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
                            ?>
                        </p>
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
            <div class="g--half g--centered sw-padding-space-down-medium">
              <div class="g--half g--last sw-centerize">
                <img class="sw-img-borderize" src="https://s.ppy.sh/a/<?php echo $data_user['user_id'];?>" alt="avatar">
              </div>
              <div class="g--half g--last sw-centerize sw-padding-space-down-medium">
                <div class="sw-flag-container sw-centerize">
                  <p class="sw-img-borderize flag flag-icon-background flag-icon-<?php echo $country_id ;?> sw-flag"></p>
                </div>
              </div>
            </div>
            <div class="g--half g--centered">
              <div class="g--third sw-padding-space-up-medium">
                <p class="sw-info-typograph sw-sub-bighead sw-p-clear sw-border-bottom"># ID #</p>
                <p class="sw-info-typograph sw-sub-head-child-small sw-p-clear sw-info-typograph-fontsize-fix sw-padding-space-up"><?php echo $data_user['user_id'] ;?></p>
              </div>
              <div class="g--third sw-padding-space-up-medium">
                  <p class="sw-info-typograph sw-sub-bighead sw-p-clear sw-border-bottom"># Username #</p>
                  <p class="sw-info-typograph sw-sub-head-child-small sw-p-clear sw-info-typograph-fontsize-fix sw-padding-space-up"><?php echo $data_user['username'] ;?></p>
              </div>
              <div class="g--third g--last sw-padding-space-up-medium">
                  <p class="sw-info-typograph sw-sub-bighead sw-p-clear sw-border-bottom"># Country #</p>
                  <p class="sw-info-typograph sw-sub-head-child-small sw-p-clear sw-info-typograph-fontsize-fix sw-padding-space-up"><?php echo $country_name ;?></p>
              </div>
            </div>
        </section>
        <section class="thanks-tab-content tab-content">
            <h1 class="sw-centerize sw-big-header">Special Thanks To</h1>
            <p class="sw-padding-space-down"></p>
            <div class="g--third">
               <div class="g--centered sw-centerize">
                 <img class="sw-img-borderize sw-img-height-fix" src="https://s.ppy.sh/a/922812" alt="avatar">
               </div>
               <p class="sw-thanks-typograph sw-sub-head sw-p-clear">[Kitty]</p>
               <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Code Concept</p>
            </div>
            <div class="g--third">
              <div class="g--centered sw-centerize">
                <img class="sw-img-borderize sw-img-height-fix" src="https://s.ppy.sh/a/3835107" alt="avatar">
              </div>
              <p class="sw-thanks-typograph sw-sub-head sw-p-clear">rendra123</p>
              <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Classmates & Idea Maker</p>
            </div>
            <div class="g--third g--last">
              <div class="g--centered sw-centerize">
                <img class="sw-img-borderize sw-img-height-fix" src="https://s.ppy.sh/a/2" alt="avatar">
              </div>
              <p class="sw-thanks-typograph sw-sub-head sw-p-clear">peppy</p>
              <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Creator of osu! and its API</p>
            </div>
            <div class="g--half sw-padding-space-up-medium">
                <div class="g--centered sw-centerize">
                    <img class="sw-img-height-fix sw-svg-github-fix" src="/images/github.svg" alt="logo">
                </div>
                <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Github</p>
                <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Source Code Hosting</p>
            </div>
            <div class="g--half g--last sw-padding-space-up-medium">
                <div class="g--centered sw-centerize">
                    <img class="sw-img-height-fix sw-svg-google-dev-fix" src="/images/google-dev.svg" alt="logo">
                </div>
                <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Web Starter Kit</p>
                <p class="sw-thanks-typograph sw-sub-head sw-p-clear">Design Framework</p>
            </div>
        </section>
        <section class="download-tab-content tab-content">
            <h1 class="sw-centerize sw-big-header">Download Source Code</h1>
            <div class="g-medium--2 g-medium--last g-wide--3 g--centered">
                <p class="sw-download-typograph sw-p-clear sw-justified">
                    <span class="fa fa-code sw-drop-caps sw-drop-caps-left sw-drop-caps-code"></span><span class="sw-headline-bold">Project Odelyt!a</span> is an open-source project that recustomize back user-profile statistics from official user-page on osu! website by using osu!api implementation. This project is written in PHP language as a server-side script, and using MySQL backend as a cache server whenever official osu! website is offline. This project is licensed under MIT License.
                </p>
                <p class="sw-download-typograph sw-p-clear sw-justified sw-padding-space-up">
                    <span class="fa fa-git sw-drop-caps sw-drop-caps-right sw-drop-caps-git"></span>Interested to build your own customized osu! statistics profile or get involved in this project? You can clone or fork this project (porting into another programming language) to make this project becoming more better or you can download the source tarball if you want to get ready to make your own custom osu statistics website.
                    <p class="sw-centerize">
                        <span>Clone the project by using git via terminal (command prompt)</span><br>
                        <code class="sw-code">$ git clone https://github.com/sandycorzeta/odelytia-project</code>
                    </p>
                    <p class="sw-centerize">OR</p>
                    <p class="sw-centerize">
                        <span class="sw-headline-bold">You can download the source tarball by clicking "fork me on github" button on the top right of the page</span>
                    </p>
                </p>
            </div>
            <a href="https://github.com/sandycorzeta/odelytia-project"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
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