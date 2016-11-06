<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); ?>
    <style type="text/css">
/* portfolio page 기본 css */
        header.post-title {
            border:1px solid #e3e3e3;
            margin:20px 0;
            padding:15px 15px;
        }
        div.maincontent {
            border:1px solid #e3e3e3;
            margin:20px 0 ;
        }

        .maincontent p {
            padding:0 18px;
        }

        .row.content {
            margin-top:20px;
        }

/*  Portfolio page Button */

  input[type="submit"],
  input[type="reset"],
  input[type="button"],
  button,
  .button {
    -moz-appearance: none;
    -webkit-appearance: none;
    -ms-appearance: none;
    appearance: none;
    -moz-transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out;
    -webkit-transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out;
    -ms-transition: background-color 0.4s ease-in-out, color 0.4s ease-in-out;
    transition: background-color 0.7s ease-in-out, color 0.7s ease-in-out;
    border: 0;
    cursor: pointer;
    display: inline-block;
    font-weight: 700;
    height: 2.85em;
    line-height: 2.95em;
    min-width: 10em;
    padding: 0 1.5em;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    white-space: nowrap;
  }

    input[type="submit"].icon,
    input[type="reset"].icon,
    input[type="button"].icon,
    button.icon,
    .button.icon {
      padding-left: 1.35em;
    }

      input[type="submit"].icon:before,
      input[type="reset"].icon:before,
      input[type="button"].icon:before,
      button.icon:before,
      .button.icon:before {
        margin-right: 0.5em;
      }

    input[type="submit"].fit,
    input[type="reset"].fit,
    input[type="button"].fit,
    button.fit,
    .button.fit {
      display: block;
      margin: 0 0 1em 0;
      width: 100%;
    }

    input[type="submit"].small,
    input[type="reset"].small,
    input[type="button"].small,
    button.small,
    .button.small {
      font-size: 0.8em;
    }

    input[type="submit"].big,
    input[type="reset"].big,
    input[type="button"].big,
    button.big,
    .button.big {
      font-size: 1.2em;
      height: 3.25em;
      line-height: 3.25em;
      padding: 0 2.5em;
    }

    input[type="submit"].disabled, input[type="submit"]:disabled,
    input[type="reset"].disabled,
    input[type="reset"]:disabled,
    input[type="button"].disabled,
    input[type="button"]:disabled,
    button.disabled,
    button:disabled,
    .button.disabled,
    .button:disabled {
      cursor: default;
      opacity: 0.25;
    }

    @media screen and (max-width: 980px) {

      input[type="submit"].big,
      input[type="reset"].big,
      input[type="button"].big,
      button.big,
      .button.big {
        font-size: 1em;
      }

    }

    @media screen and (max-width: 480px) {

      input[type="submit"],
      input[type="reset"],
      input[type="button"],
      button,
      .button {
        padding: 0;
      }

    }

  input[type="submit"],
  input[type="reset"],
  input[type="button"],
  button,
  .button {
    background-color: #ff5757;
    box-shadow: none;
    color: #fff !important;
  }

    input[type="submit"].icon:before,
    input[type="reset"].icon:before,
    input[type="button"].icon:before,
    button.icon:before,
    .button.icon:before {
      color: #999;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover,
    input[type="button"]:hover,
    button:hover,
    .button:hover {
      background-color: rgba(255,87,87,0.65);
    }

    input[type="submit"]:active,
    input[type="reset"]:active,
    input[type="button"]:active,
    button:active,
    .button:active {
      background-color: #1b292b;
    }

    input[type="submit"].special,
    input[type="reset"].special,
    input[type="button"].special,
    button.special,
    .button.special {
      background-color: #ff5757;
      box-shadow: none;
      color: #fff !important;
    }

      input[type="submit"].special:hover,
      input[type="reset"].special:hover,
      input[type="button"].special:hover,
      button.special:hover,
      .button.special:hover {
        background-color: #63c1ae;
      }

      input[type="submit"].special:active,
      input[type="reset"].special:active,
      input[type="button"].special:active,
      button.special:active,
      .button.special:active {
        background-color: #45ad97;
      }

    input[type="submit"].alt,
    input[type="reset"].alt,
    input[type="button"].alt,
    button.alt,
    .button.alt {
      background-color: transparent;
      box-shadow: inset 0 0 0 2px #ff5757;
      color: #ff5757 !important;
    }

      input[type="submit"].alt:hover,
      input[type="reset"].alt:hover,
      input[type="button"].alt:hover,
      button.alt:hover,
      .button.alt:hover {
        background-color: rgba(144, 144, 144, 0.075);
      }

      input[type="submit"].alt:active,
      input[type="reset"].alt:active,
      input[type="button"].alt:active,
      button.alt:active,
      .button.alt:active {
        background-color: rgba(144, 144, 144, 0.2);
      }

    </style>
    <body>
          <div class="container">
            <div class="row content" <?php post_class(); ?>>
                <div class="span8">
                    <?php
            // Rewind the loop back
            rewind_posts();
            ?>

            <?php while (have_posts()) : the_post(); ?>
            <header class="post-title">
                <h1><?php the_title();?></h1>
                <p class="meta"><?php echo bootstrapwp_posted_on();?></p>
            </header>
            <div class="maincontent">
                    <?php // Post thumbnail conditional display.
                    if ( bootstrapwp_autoset_featured_img() != false ){
                    ?>
                            <a class="caption-style-5" href="<?php the_permalink(); ?>" title="<?php  the_title_attribute( 'echo=0' ); ?>">
                                <?php echo bootstrapwp_autoset_featured_img(); ?>
                            </a>
                    <?php
                    }else{
                    ?>
                    <?php
                    }
                    ?>
                    
                    <p><?php custom_length_excerpt(400);?></p>
                    </div>
<?php if ( function_exists( 'pgntn_display_pagination' ) ) pgntn_display_pagination( 'multipage' );?>
                <?php endwhile; ?>
                
                </div><!-- /.span8 -->

                <div class="span4 wall archive">
                  <div class="caption-style-4">
                    <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/assets/img/CodingSnippet.jpg" />
                    <div class="caption">
                        <div class="blur"></div>
                        <div class="caption-text">
                            프로그래밍을 하고 싶다면 ?
                        </div>
                    </div>
                 </div>
                </div>
                <div class="span4 wall archive">
                  <?php get_sidebar('blog3'); ?>
                </div>
             </div>
         </div>



</body>


    <?php get_footer(); ?>