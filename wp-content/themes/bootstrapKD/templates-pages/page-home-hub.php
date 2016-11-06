<?php
/**
 * Template Name: Page - Home Hero Hub
 * Description: Template for MavHub
 * Writer: Jonghwi, Lee
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();

/* ----- Calculate Member's Point with post, board, comment count ----- */
include('./dbconfig.php');

//Post Count
$sql = "SELECT a.id, display_name, COUNT( b.id ) count
          FROM wp_users a
          LEFT OUTER JOIN wp_posts b ON a.id = b.post_author
           AND post_status =  'publish'
           AND comment_status =  'open'
      GROUP BY display_name
      ORDER BY count DESC
         LIMIT 5";
$post_result = mysqli_query($connect, $sql);

//KBoard Count
$sql = "SELECT b.id, display_name, count(a.uid) count
          FROM wp_kboard_board_content a, wp_users b
         WHERE a.member_uid = b.id
           AND a.board_id in (1,2,3,4,5,6,7,8,9,11,15,16,17)
      GROUP BY a.member_uid
      ORDER BY count DESC
         LIMIT 5";
$board_result = mysqli_query($connect, $sql);

//Comment Count
$sql = "SELECT a.id, display_name, count(uid) count
          FROM wp_users a
          LEFT OUTER JOIN wp_kboard_comments b ON a.id = b.user_uid
      GROUP BY display_name
      ORDER BY count DESC
         LIMIT 5";
$comment_result = mysqli_query($connect, $sql);

//Member's Point
$sql = "SELECT a.id
              ,a.display_name
              ,(a.count + b.count) * 5 + c.count as point
        FROM(
            SELECT a.id, display_name, COUNT( b.id ) count
            FROM wp_users a
            LEFT OUTER JOIN wp_posts b ON a.id = b.post_author
            AND post_status =  'publish'
            AND comment_status =  'open'
            GROUP BY display_name
            ) a,
            (
            SELECT b.id, display_name, count(a.uid) count
            FROM wp_kboard_board_content a, wp_users b
            WHERE a.member_uid = b.id
            AND a.board_id in (1,2,3,4,5,6,7,8,9,11,15,16,17)
            GROUP BY a.member_uid
            ) b,
            (
            SELECT a.id, display_name, count(uid) count
            FROM wp_users a
            LEFT OUTER JOIN wp_kboard_comments b ON a.id = b.user_uid
            GROUP BY display_name
            ORDER BY count DESC
            ) c
        WHERE a.id = b.id
        AND a.id = c.id
        ORDER BY point DESC
        LIMIT 5";
$point_result = mysqli_query($connect, $sql);

//View Rank
$sql = "SELECT title
              ,member_display
              ,view
        FROM   wp_kboard_board_content
        WHERE  board_id in (1,2,4,5,6,7,8,9,15,16,17)
        AND    notice != true
        ORDER BY view DESC
        LIMIT 5";
$view_rank = mysqli_query($connect, $sql);

//Comment Rank
$sql = "SELECT title
              ,member_display
              ,comment
        FROM   wp_kboard_board_content
        WHERE  board_id in (1,2,4,5,6,7,8,9,15,16,17)
        AND    notice != true
        ORDER BY comment DESC
        LIMIT 5";
$comment_rank = mysqli_query($connect, $sql);

//Latest true? false?
$sql = "SELECT MAX( uid )
              ,b.id, a.member_uid
              ,name
              ,member_display
              ,IF( DATEDIFF( NOW( ) , STR_TO_DATE( MAX( DATE ) ,  '%Y%m%d %H%i%s' ) ) <=1, true, false ) latest
        FROM wp_kboard_board_content a
        RIGHT OUTER JOIN wp_members b ON b.name = a.member_display
        AND board_id
        IN ( 1, 2, 4, 5, 6, 7, 8, 9, 15, 16, 17 )
        AND notice != true
        GROUP BY member_uid
        ORDER BY b.id";
$latest_result = mysqli_query($connect, $sql);
$latest_alarm = array('','','','','','','','','','','');
if($latest_result){
    $a = 0;
    while($latest_row = mysqli_fetch_array($latest_result)){
        if($latest_row['latest'] == 1){
            $latest_alarm[$a] = '&nbsp&nbsp&nbsp<span class="badge" style="background-color:rgba(232, 98, 86, 0.8);">new</span>';
        }else{
            $latest_alarm[$a] = '';
        }
        $a++;
    }
}

//Latest Public Board
$sql = "SELECT MAX( uid )
              ,IF( DATEDIFF( NOW( ) , STR_TO_DATE( MAX( DATE ) ,  '%Y%m%d %H%i%s' ) ) <=1, true, false ) latest
        FROM wp_kboard_board_content
        WHERE board_id = 11
        AND notice != true";
$public_result = mysqli_query($connect, $sql);
if($public_result){
    while($public_row = mysqli_fetch_array($public_result)){
        if($public_row['latest'] == 1){
            $public_alarm = '<span class="badge" style="background-color:rgba(232, 98, 86, 0.8);">new</span>';
        }else{
            $public_alarm = '';
        }
    }
}

/* ----- END ----- */


$address = $_SERVER['REQUEST_URI'];
$page_number = substr($address, -3);

//For echoing tags
$first  = array("", "");
$second = array("", "");
$third  = array("", "");
$p784   = array("", "");
$p343   = array("", "");
$p110   = array("", "");
$p103   = array("", "");
$p118   = array("", "");
$p122   = array("", "");
$p114   = array("", "");
$p294   = array("", "");
$p385   = array("", "");
$p508   = array("", "");
$p1789  = array("", "");
$p1791  = array("", "");
$p1793  = array("", "");

//Page Address Variables
$hub = "http://mismaven.kr/?page_id=784";
$ljh = "http://mismaven.kr/?page_id=110";
$pkd = "http://mismaven.kr/?page_id=103";
$ksh = "http://mismaven.kr/?page_id=118";
$msy = "http://mismaven.kr/?page_id=122";
$cyh = "http://mismaven.kr/?page_id=114";
$wjm = "http://mismaven.kr/?page_id=294";
$psm = "http://mismaven.kr/?page_id=385";
$ljw = "http://mismaven.kr/?page_id=508";
$kkt = "http://mismaven.kr/?page_id=1789";
$kjs = "http://mismaven.kr/?page_id=1791";
$kjy = "http://mismaven.kr/?page_id=1793";

switch($page_number){
    // 허브
    case 784:
    $p784[0] = "<b>";
    $p784[1] = "</b>";
    break;

    //공용
    case 343:
    $p343[0] = "<b>";
    $p343[1] = "</b>";
    break;

    //이종휘
    case 110:
    $p110[0] = "<b>";
    $p110[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    break;

    //박경두
    case 103:
    $p103[0] = "<b>";
    $p103[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    break;

    //김수현
    case 118:
    $p118[0] = "<b>";
    $p118[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    break;

    //문수연
    case 122:
    $p122[0] = "<b>";
    $p122[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    break;

    //조용환
    case 114:
    $p114[0] = "<b>";
    $p114[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    break;

    //우종민
    case 294:
    $p294[0] = "<b>";
    $p294[1] = "</b>";
    $second[0] = "<b>";
    $second[1] = "</b>";
    break;

    //박성민
    case 385:
    $p385[0] = "<b>";
    $p385[1] = "</b>";
    $second[0] = "<b>";
    $second[1] = "</b>";
    break;

    //이정웅
    case 508:
    $p508[0] = "<b>";
    $p508[1] = "</b>";
    $second[0] = "<b>";
    $second[1] = "</b>";
    break;

    //김경태
    case 1789:
    $p1789[0] = "<b>";
    $p1789[1] = "</b>";
    $third[0] = "<b>";
    $third[1] = "</b>";
    break;

    //김진석
    case 1791:
    $p1791[0] = "<b>";
    $p1791[1] = "</b>";
    $third[0] = "<b>";
    $third[1] = "</b>";
    break;

    //김진영
    case 1793:
    $p1793[0] = "<b>";
    $p1793[1] = "</b>";
    $third[0] = "<b>";
    $third[1] = "</b>";
    break;

    default:
}
?>
<style>
ul{
    padding-left: 20px;
}

.span2.wall{
    margin: 0 15px;
    padding: 0 15px;
}
.span4.wall{
    margin: 0 15px;
    padding: 0 15px;
}

.fa-comment {
    color: orange;
    -webkit-animation-name: change_color; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 5s; /* Chrome, Safari, Opera */
    animation-name: change_color;
    animation-duration: 5s;
    animation-iteration-count: infinite;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes change_color {
    from {color: orange;}
    to {color: #ad132f;}
}

/* Standard syntax */
@keyframes change_color {
    from {color: orange;}
    to {color: #ad132f;}
}
</style>
<div class="container">
   <div class="row hubmargin">
        <div class="span2" style="margin-top:20px;">
            <ul class="nav">
            <p class="hubp">MavHub <span>LIST</span></p>
                <?=$p784[0]?><li><a href="http://mismaven.kr/?page_id=784">Hub Main</a></li><?=$p784[1]?>
                <?=$p343[0]?><li><a href="http://mismaven.kr/?page_id=343">공용자료실</a><?=$public_alarm?></li><?=$p343[1]?>
                <li> <?=$first[0]?>MAVEN 1기<?=$first[1]?>
                    <ul>
                        <?=$p110[0]?><li class="hub-menu-item"><a href="<?php echo $ljh;?>">이종휘</a><?=$latest_alarm[0]?></li><?=$p110[1]?>
                        <?=$p103[0]?><li class="hub-menu-item"><a href="<?php echo $pkd;?>">박경두</a><?=$latest_alarm[1]?></li><?=$p103[1]?>
                        <?=$p118[0]?><li class="hub-menu-item"><a href="<?php echo $ksh;?>">김수현</a><?=$latest_alarm[2]?></li><?=$p118[1]?>
                        <?=$p122[0]?><li class="hub-menu-item"><a href="<?php echo $msy;?>">문수연</a><?=$latest_alarm[3]?></li><?=$p122[1]?>
                        <?=$p114[0]?><li class="hub-menu-item"><a href="<?php echo $cyh;?>">조용환</a><?=$latest_alarm[4]?></li><?=$p114[1]?>
                    </ul>
                </li>
                <li><?=$second[0]?>MAVEN 2기<?=$second[1]?>
                    <ul>
                        <?=$p294[0]?><li class="hub-menu-item"><a href="<?php echo $wjm;?>">우종민</a><?=$latest_alarm[5]?></li><?=$p294[1]?>
                        <?=$p385[0]?><li class="hub-menu-item"><a href="<?php echo $psm;?>">박성민</a><?=$latest_alarm[6]?></li><?=$p385[1]?>
                        <?=$p508[0]?><li class="hub-menu-item"><a href="<?php echo $ljw;?>">이정웅</a><?=$latest_alarm[7]?></li><?=$p508[1]?>
                    </ul>
                </li>
                <li><?=$third[0]?>MAVEN 3기<?=$third[1]?>
                    <ul>
                        <?=$p1789[0]?><li class="hub-menu-item"><a href="<?php echo $kkt;?>">김경태</a><?=$latest_alarm[8]?></li><?=$p1789[1]?>
                        <?=$p1791[0]?><li class="hub-menu-item"><a href="<?php echo $kjs;?>">김진석</a><?=$latest_alarm[9]?></li><?=$p1791[1]?>
                        <?=$p1793[0]?><li class="hub-menu-item"><a href="<?php echo $kjy;?>">김진영</a><?=$latest_alarm[10]?></li><?=$p1793[1]?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="span10" id="pageboxline">
            <ul class="nav nav-tabs" style="margin-bottom: 0">
                <li class="active"><a data-toggle="tab" href="#tab1">Dashboard</a></li>
                <li><a data-toggle="tab" href="#tab2">Latest Hubs</a></li>
            </ul>
            <div class="tab-content" style="border:1px solid #ddd;border-radius:0px 0px 5px 5px;border-top:0px">
                <div id="tab1" class="tab-pane fade in active" style="padding-left:10px">
                    <div class="row" style="margin-left:0;">
                        <div class="span2 wall" style="color:#000;border:0px">
                            <p class="mainpa">포인트</p>
                            <table class="table">
                                <tr style="color:#ad132f">
                                    <th class="span3" style="text-align:center;">순위</th>
                                    <th class="span6" style="text-align:center;">이름</th>
                                    <th class="span3" style="text-align:right;">포인트</th>
                                </tr>
                            <?php
                            if($point_result){
                                $l = 1;
                                while($point_row = mysqli_fetch_array($point_result)){
                            ?>
                                <tr>
                                    <td class="span3" style="text-align:center;"><?php echo $l; ?></td>
                                    <td class="span3" style="text-align:center;"><?php echo $point_row[1]; ?></td>
                                    <td class="span3" style="text-align:right;"><?php echo $point_row[2]; ?></td>
                                </tr>
                            <?php
                                    $l++;
                                }
                            }
                            ?>
                            </table>
                        </div>
                        <div class="span2 wall" style="color:#000;border:0px">
                            <p class="mainpa">포스팅</p>
                            <table class="table">
                                <tr style="color:#ad132f">
                                    <th class="span3" style="text-align:center;">순위</th>
                                    <th class="span6" style="text-align:center;">이름</th>
                                    <th class="span3" style="text-align:right;">개수</th>
                                </tr>
                            <?php
                            if($post_result){
                                $i = 1;
                                while($post_row = mysqli_fetch_array($post_result)){
                            ?>
                                <tr>
                                    <td class="span3" style="text-align:center;"><?php echo $i; ?></td>
                                    <td class="span3" style="text-align:center;"><?php echo $post_row[1]; ?></td>
                                    <td class="span3" style="text-align:right"><?php echo $post_row[2]; ?></td>
                                </tr>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                            </table>
                        </div>
                        <div class="span2 wall" style="color:#000;border:0px">
                            <p class="mainpa">게시판 게시물</p>
                            <table class="table">
                                <tr style="color:#ad132f">
                                    <th class="span3" style="text-align:center;">순위</th>
                                    <th class="span6" style="text-align:center;">이름</th>
                                    <th class="span3" style="text-align:right;">개수</th>
                                </tr>
                            <?php
                            if($board_result){
                                $j = 1;
                                while($board_row = mysqli_fetch_array($board_result)){
                            ?>
                                <tr>
                                    <td class="span3" style="text-align:center;"><?php echo $j; ?></td>
                                    <td class="span3" style="text-align:center;"><?php echo $board_row[1]; ?></td>
                                    <td class="span3" style="text-align:right"><?php echo $board_row[2]; ?></td>
                                </tr>
                            <?php
                                    $j++;
                                }
                            }
                            ?>
                            </table>
                        </div>
                        <div class="span2 wall" style="color:#000;border:0px">
                            <p class="mainpa">댓글</p>
                            <table class="table">
                                <tr style="color:#ad132f">
                                    <th class="span3" style="text-align:center;">순위</th>
                                    <th class="span6" style="text-align:center;">이름</th>
                                    <th class="span3" style="text-align:right;">개수</th>
                                </tr>
                            <?php
                            if($comment_result){
                                $k = 1;
                                while($comment_row = mysqli_fetch_array($comment_result)){
                            ?>
                                <tr>
                                    <td class="span3" style="text-align:center;"><?php echo $k; ?></td>
                                    <td class="span3" style="text-align:center;"><?php echo $comment_row[1]; ?></td>
                                    <td class="span3" style="text-align:right;"><?php echo $comment_row[2]; ?></td>
                                </tr>
                            <?php
                                    $k++;
                                }
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-left:0;">
                        <div class="span9 wall" style="color:#000;border:0px;">
                            <p class="mainpa">조회수 Best</p>
                            <table class="table">
                                <tr style="color:#ad132f">
                                    <th class="span1" style="text-align:center;">순위</th>
                                    <th class="span6" style="text-align:center;">제목</th>
                                    <th class="span1" style="text-align:center;">작성자</th>
                                    <th class="span2" style="text-align:right;">조회수</th>
                                </tr>
                            <?php
                            if($view_rank){
                                $m = 1;
                                while($view_rank_row = mysqli_fetch_array($view_rank)){
                            ?>
                                <tr>
                                    <td class="span1" style="text-align:center;"><?php echo $m; ?></td>
                                    <td class="span5" style="text-align:center;"><?php echo $view_rank_row[0]; ?></td>
                                    <td class="span1" style="text-align:center;"><?php echo $view_rank_row[1]; ?></td>
                                    <td class="span2" style="text-align:right;"><?php echo $view_rank_row[2]; ?></td>
                                </tr>
                            <?php
                                    $m++;
                                }
                            }
                            ?>
                            </table>
                        </div>
                        <div class="span9 wall" style="color:#000;border:0px;">
                            <p class="mainpa">댓글수 Best</p>
                            <table class="table">
                                <tr style="color:#ad132f">
                                    <th class="span1" style="text-align:center;">순위</th>
                                    <th class="span6" style="text-align:center;">제목</th>
                                    <th class="span1" style="text-align:center;">작성자</th>
                                    <th class="span2" style="text-align:right;">댓글수</th>
                                </tr>
                            <?php
                            if($comment_rank){
                                $n = 1;
                                while($comment_rank_row = mysqli_fetch_array($comment_rank)){
                            ?>
                                <tr>
                                    <td class="span1" style="text-align:center;"><?php echo $n; ?></td>
                                    <td class="span5" style="text-align:center;"><?php echo $comment_rank_row[0]; ?></td>
                                    <td class="span1" style="text-align:center;"><?php echo $comment_rank_row[1]; ?></td>
                                    <td class="span2" style="text-align:right;"><?php echo $comment_rank_row[2]; ?></td>
                                </tr>
                            <?php
                                    $n++;
                                }
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                </div><!-- end tab1 -->

                <div id="tab2"class="tab-pane fade" style="padding:5px">
                    <div class="row" style="margin-left:0;">
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">이종휘<span id="moremore"><a href="<?php echo $ljh;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=1 url='.$ljh.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">박경두<span id="moremore"><a href="<?php echo $pkd;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=2 url='.$pkd.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">김수현<span id="moremore"><a href="<?php echo $ksh;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=4 url='.$ksh.' rpp=5]'); ?>
                        </div>
                    </div>
                    <div class="row" style="margin-left:0;">
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">문수연<span id="moremore"><a href="<?php echo $msy;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=5 url='.$msy.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">조용환<span id="moremore"><a href="<?php echo $cyh;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=6 url='.$cyh.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">우종민<span id="moremore"><a href="<?php echo $wjm;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=7 url='.$wjm.' rpp=5]'); ?>
                        </div>
                    </div>
                    <div class="row" style="margin-left:0;">
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">박성민<span id="moremore"><a href="<?php echo $psm;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=8 url='.$psm.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">이정웅<span id="moremore"><a href="<?php echo $ljw?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=9 url='.$ljw.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">김경태<span id="moremore"><a href="<?php echo $kkt?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=15 url='.$kkt.' rpp=5]'); ?>
                        </div>
                    </div>
                    <div class="row" style="margin-left:0;">
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">김진석<span id="moremore"><a href="<?php echo $kjs;?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=16 url='.$kjs.' rpp=5]'); ?>
                        </div>
                        <div class="span3 wall" style="color:#000">
                            <p class="mainpa">김진영<span id="moremore"><a href="<?php echo $kjy?>"><i class="fa fa-plus"></i></a></span></p>
                            <?php echo do_shortcode('[kboard_latest id=17 url='.$kjy.' rpp=5]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span2">
        </div>

    </div><!--/.row -->
</div><!--/.container -->
<div style="margin-top:8px"></div>

<?php get_footer(); ?>
