<?php
/**
 * Main Page
 * Editted by Jonghwi
 */
get_header();
global $wdwt_front;

?>
	</header>
	<style>
    #section0 {
        background-color: #8f1822;
        text-align: center;
    }
    #section0-content{
        width:100%;
        color: #fff;
        margin: auto;
        display:inline-block;
        text-align: center;
        transform: translate(0%, 45%);
    }
    #section1 {
        background-color: #444;
    }
    #section1-content {
        width:100%;
        color: #fff;
        margin: auto;
        display:inline-block;
        text-align: center;
        transform: translate(0%, 45%);
    }
    </style>
</head>
<body>
    <div id="fullpage">
        <!-- Section 0 : Main Page Start -->
        <div class="section" id="section0">
            <div id="section0-content">
                <img src="<?php echo get_template_directory_uri(); ?>/images/mavenFullLogo.gif" width="500px" height="auto"/>
                <h3 style="color:#fff">경영정보학과 IT기술 소모임</h3>
            </div>
        </div>
        <!-- Section 0 : Main Page End -->
        <!-- Section 1 : Main Page Start -->
        <div class="section" id="section1">
            <div id="section1-content">
                <h1>A B O U T</h1>
                <div class="span wall4">

                </div>
            </div>
        </div>
        <!-- Section 1 : Main Page End -->
        <div class="section" id="section2">
            <h1>Some section3</h1>
        </div>
        <div class="section" id="section3">
            <h1>Some section4</h1>
        </div>
        <div class="section" id="section4">
            <h1>Some section5</h1>
        </div>
        <div class="section" id="section5">
            <h1>Some section6</h1>
        </div>
    </div>
    <script type="text/javascript">
        fullpage.initialize('#fullpage', {
            anchors: ['1', '2', '3', '4', '5', '6', '7'],
            menu: '#menu',
            css3: true
        });
    </script>

	<div class="clear"></div>

<?php
get_footer();
