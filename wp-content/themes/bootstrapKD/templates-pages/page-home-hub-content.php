<?php
/**
 * Template Name: Page - Home Hero Hub Content
 * Description: Template for MavHub Contents
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();
include('./dbconfig.php');

$address = $_SERVER['REQUEST_URI'];
$address_array = explode('=', $address);
if(sizeof($address_array) > 3)
{
    $page_number = substr($address_array[1], 0, 3);
}
else if(sizeof($address_array) == 3)
{
    $page_number = substr($address_array[2], 0, 4);
}
else
{
    $page_number = substr($address_array[1], 0, 4);
}

//Latest ture? false?
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
            $public_alarm = '&nbsp&nbsp&nbsp<span class="badge" style="background-color:rgba(232, 98, 86, 0.8);">new</span>';
        }else{
            $public_alarm = '';
        }
    }
}

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

$gitname = "";

switch($page_number){
    case 784:
    $p784[0] = "<b>";
    $p784[1] = "</b>";
    break;

    case 343:
    $p343[0] = "<b>";
    $p343[1] = "</b>";
    break;

    case 110:
    $p110[0] = "<b>";
    $p110[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    $gitname = "zziller03";
    break;

    case 103:
    $p103[0] = "<b>";
    $p103[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    $gitname = "ruden91";
    break;

    case 118:
    $p118[0] = "<b>";
    $p118[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    $gitname = "";
    break;

    case 122:
    $p122[0] = "<b>";
    $p122[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    $gitname = "MintCookie";
    break;

    case 114:
    $p114[0] = "<b>";
    $p114[1] = "</b>";
    $first[0] = "<b>";
    $first[1] = "</b>";
    $gitname = "cyh132";
    break;

    case 294:
    $p294[0] = "<b>";
    $p294[1] = "</b>";
    $second[0] = "<b>";
    $second[1] = "</b>";
    $gitname = "";
    break;

    case 385:
    $p385[0] = "<b>";
    $p385[1] = "</b>";
    $second[0] = "<b>";
    $second[1] = "</b>";
    $gitname = "lowder119";
    break;

    case 508:
    $p508[0] = "<b>";
    $p508[1] = "</b>";
    $second[0] = "<b>";
    $second[1] = "</b>";
    $gitname = "dnd88";
    break;

    case 1789:
    $p1789[0] = "<b>";
    $p1789[1] = "</b>";
    $third[0] = "<b>";
    $third[1] = "</b>";
    break;

    case 1791:
    $p1791[0] = "<b>";
    $p1791[1] = "</b>";
    $third[0] = "<b>";
    $third[1] = "</b>";
    break;

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
.span2.wall{
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

li {
    /*list-style-type: none;*/
}
</style>

<div class="container">
   <div class="row-fluid hubmargin">
        <div class="span2">
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
        <div class="span8">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <br>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
        </div>
        <div class="span2" style="margin-top:auto;">
        <?php if($gitname == ""){}else{?>
            <h5>GitHub Info.</h5>
            <?php echo do_shortcode('[github-profile username="'.$gitname.'" limit="100"]'); ?>
            <h5>Repositories</h5>
            <?php echo do_shortcode('[github-repos username="'.$gitname.'" limit="100"]'); ?>
        <?php } ?>
        </div>

    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>
