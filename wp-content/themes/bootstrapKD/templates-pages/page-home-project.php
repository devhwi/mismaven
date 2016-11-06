<?php
/**
 * Template Name: Page - Home Hero Project
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();
include('./dbconfig.php');
?>
<style>
.box2 {
    height: auto;
    width:90%;
    background-color:#f4f4f4;
}
    .box4 {
        display:table;
        margin-top:10px;
        margin-left:15px;
        float:left;
        height:60px;
        width:35%;
        background-color: #9a1629;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;   
    }
    .box5 {
        display:table;
        margin-top:10px;
        float:left;
        height:60px;
        width:55%;
        background-color: #dedede;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
    }
    .box6 {
        display:table;
        margin-top:10px;
        margin-left:15px;
        float:left;
        height:60px;
        width:35%;
        background-color: #d6a771;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;   
    }
    .box3:after {
        content: "";
        display: table;
        clear: both;
    }
    .box4 p {
        font-size:12px;
        color: white;
        display:table-cell; 
        text-align:center; 
        vertical-align:middle;
    }
    .box5 p {
        font-size: 16px;
        color: black;
        display:table-cell; 
        text-align:center; 
        vertical-align:middle;
    }
    .box6 p {
        font-size:12px;
        color: white;
        display:table-cell; 
        text-align:center; 
        vertical-align:middle;
    }
</style>


<div class="container">
    <div class="row">
        <div class="span4" id="pageboxline">
            <ul class="nav">
            <p class="hubp">한눈에 보는 <span>프로젝트</span></p>
                <div class="box1">
                    <?php
                    $week = date("w"); 
                    switch ($week) { 
                        case 0 : $week_nm = "일"; break; 
                        case 1 : $week_nm = "월"; break; 
                        case 2 : $week_nm = "화"; break; 
                        case 3 : $week_nm = "수"; break; 
                        case 4 : $week_nm = "목"; break; 
                        case 5 : $week_nm = "금"; break; 
                        case 6 : $week_nm = "토"; break; 
                        default : 
                    };
                    ?>
                    <p><?php echo date("Y.m.d")." (".$week_nm.")"; ?> 기준</p>

                    <div class="box2">
                    <?php
                    $sql = "SELECT   category1 category, COUNT( uid ) count
                            FROM     wp_kboard_board_content
                            WHERE    board_id = 14
                            AND      notice != 'true'
                            GROUP BY category1
                            ORDER BY count DESC";
                    $result = mysqli_query($connect, $sql);

                    $i = 1;

                    if($result)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            if($i % 2 != 0)
                            {
                    ?>
                                <div class="box3">
                                    <div class="box4">
                                        <p><?php echo $row['category']; ?></p>
                                    </div>
                                    <div class="box5">
                                        <p><?php echo $row['count'];    ?>개</p>
                                    </div>
                                </div>
                    <?php
                            }
                            else
                            {
                    ?>
                                <div class="box3">
                                    <div class="box6">
                                        <p><?php echo $row['category']; ?></p>
                                    </div>
                                    <div class="box5">
                                        <p><?php echo $row['count'];    ?>개</p>
                                    </div>
                                </div>
                    <?php
                            }
                            $i++;
                        }
                    }
                    ?>
                    </div>
                </div>
            </ul>
        </div>
        <div class="span8" id="pageboxline">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <br>
                <?php the_content(); ?>
            <?php endwhile; endif; ?>
        </div>

    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>