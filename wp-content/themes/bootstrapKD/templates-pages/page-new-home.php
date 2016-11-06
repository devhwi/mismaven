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
?>
<html>
<head>
  <title>fullPage.js - Hwi Test</title>
  <link rel="stylesheet" type="text/css" href="javascript.fullPage.css" />

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
  <script src="../vendors/jquery.easings.min.js"></script>

  <!-- This following line is only necessary in the case of using the plugin option `scrollOverflow:true` -->
  <!--<script type="text/javascript" src="../vendors/scrolloverflow.min.js"></script>-->
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
  <script type="text/javascript" src="javascript.fullPage.js"></script>
  <script type="text/javascript">
  	fullpage.initialize('#fullpage', {
  		anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', 'lastPage', 'realLast'],
  		menu: '#menu',
  		css3:true
  	});
  </script>
</body>
</html>
