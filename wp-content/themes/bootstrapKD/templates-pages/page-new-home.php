<?php
/**
 * Template Name: Page - New Home
 * Description: Maven New Home
 * Writer: Jonghwi, Lee
 * Creation Date: 2016.11.6
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();
?>
<html>
<head>
  <title>fullPage.js - Hwi Test</title>
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/fullPage/javascript.fullPage.css" />

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
  <div id="fullpage">
    <div class="section" id="section0"><h1>Some section1</h1></div>
    <div class="section" id="section1"><h1>Some section2</h1></div>
    <div class="section" id="section2"><h1>Some section3</h1></div>
    <div class="section" id="section3"><h1>Some section4</h1></div>
    <div class="section" id="section4"><h1>Some section5</h1></div>
    <div class="section" id="section5"><h1>Some section6</h1></div>
  </div>
  <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/fullPage/javascript.fullPage.js"></script>
  <script type="text/javascript">
  	fullpage.initialize('#fullpage', {
  		anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage', 'realLast'],
  		menu: '#menu',
  		css3:true
  	});
  </script>
</body>
</html>
<?php get_footer(); ?>
