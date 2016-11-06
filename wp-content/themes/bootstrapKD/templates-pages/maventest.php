
<?php
/**
 * Template Name: Page - maven_portfolio
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); 
?>
<style>
/* -------------------------------- 

Primary style

-------------------------------- */
*, *::after, *::before {
  box-sizing: border-box;
}

html {
  font-size: 62.5%;
}

body {
  font-size: 1.6rem;
  color: #0f1926;
  background-color: #ebebeb;
}

a {
  color: #eebb00;
  text-decoration: none;
}

img {
  max-width: 100%;
}

/* -------------------------------- 

Patterns - reusable parts of our design

-------------------------------- */
.cd-btn {
  display: inline-block;
  padding: 1.4em 2em;
  border:1px solid;
  color: #ffffff;
  font-size: 1.3rem;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  -webkit-transition: box-shadow 0.2s;
  -moz-transition: box-shadow 0.2s;
  transition: box-shadow 0.2s;
}
.no-touch .cd-btn:hover {
  box-shadow: 0 1px 30px rgba(238, 187, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.4);
}

.cd-img-replace {
  /* replace text with image */
  color: transparent;
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
}

/* -------------------------------- 

Intro page

-------------------------------- */
.cd-intro-block {
  position: relative;
  z-index: 2;
  height: 100vh;
  width: 100%;
  background: #262f3b;
  /* used to vertical align its content */
  display: table;
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  transition: transform 0.5s;
  -webkit-transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
  -moz-transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
  transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
}
.cd-intro-block::after {
  /* arrow icon visible when .cd-intro-block slides out */
  content: '';
  position: absolute;
  left: 50%;
  top: 50%;
  bottom: auto;
  right: auto;
  -webkit-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -ms-transform: translateX(-50%) translateY(-50%);
  -o-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
  top: 95%;
  height: 24px;
  width: 24px;
  background: url(/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/cd-arrow-back.svg) no-repeat center center;
  opacity: 0;
  -webkit-transition: opacity 0.2s;
  -moz-transition: opacity 0.2s;
  transition: opacity 0.2s;
}
.cd-intro-block .content-wrapper {
  /* vertical align the .cd-intro-block content */
  display: table-cell;
  vertical-align: middle;
  text-align: center;
}
.cd-intro-block h1 {
  width: 90%;
  margin: 0 auto .6em;
  font-size: 2.4rem;
  color: #ebebeb;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.cd-intro-block.projects-visible {
  /* translate the .cd-intro-block element to reveal the projects slider */
  -webkit-transform: translateY(-90%);
  -moz-transform: translateY(-90%);
  -ms-transform: translateY(-90%);
  -o-transform: translateY(-90%);
  transform: translateY(-90%);
  box-shadow: 0 4px 40px rgba(0, 0, 0, 0.6);
  cursor: pointer;
}
.cd-intro-block.projects-visible:after {
  /* show arrow icon */
  opacity: 1;
}
@media only screen and (min-width: 900px) {
  .cd-intro-block::after {
    top: 97.5%;
  }
  .cd-intro-block h1 {
    font-size: 4.4rem;
    font-weight: 300;
  }
  .cd-intro-block.projects-visible {
    -webkit-transform: translateY(-95%);
    -moz-transform: translateY(-95%);
    -ms-transform: translateY(-95%);
    -o-transform: translateY(-95%);
    transform: translateY(-95%);
  }
}

/* -------------------------------- 

Projects Slider

-------------------------------- */
.cd-projects-wrapper {
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  visibility: hidden;
  background-color: #0f1926;
  -webkit-transition: visibility 0s 0.5s;
  -moz-transition: visibility 0s 0.5s;
  transition: visibility 0s 0.5s;
}
.cd-projects-wrapper::before {
  /* never visible - this is used in jQuery to check the current MQ */
  content: 'mobile';
  display: none;
}
.cd-projects-wrapper.projects-visible {
  visibility: visible;
  -webkit-transition: visibility 0s 0s;
  -moz-transition: visibility 0s 0s;
  transition: visibility 0s 0s;
}
@media only screen and (min-width: 900px) {
  .cd-projects-wrapper::before {
    /* never visible - this is used in jQuery to check the current MQ */
    content: 'desktop';
  }
}

.cd-slider {
  padding-top: 10vh;
  height: 100%;
  overflow-y: auto;
}
.projects-visible .cd-slider {
  /* smooth scrolling on iOS */
  -webkit-overflow-scrolling: touch;
}
.cd-slider li {
  margin: 4%;
  opacity: 0;
  border-radius: .25em;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
  -webkit-transition: opacity 0s 0.5s;
  -moz-transition: opacity 0s 0.5s;
  transition: opacity 0s 0.5s;
  /* Force hardware acceleration */
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.cd-slider li.slides-in {
  -webkit-transition: opacity 0s 0s;
  -moz-transition: opacity 0s 0s;
  transition: opacity 0s 0s;
  opacity: 1;
  -webkit-animation: cd-translate 0.5s;
  -moz-animation: cd-translate 0.5s;
  animation: cd-translate 0.5s;
}
.cd-slider a {
  display: block;
  height: 100%;
  width: 100%;
}
.cd-slider img {
  display: block;
  border-radius: .25em .25em 0 0;
  width: 100%;
}
.cd-slider .project-info {
  padding: 1em 1.6em;
  background-color: #ebebeb;
  border-radius: 0 0 .25em .25em;
}
.cd-slider h2 {
  font-size: 2.5rem;
  font-weight: bold;
  line-height: 1.2;
}
.cd-slider p {
  font-size: 1.4rem;
  opacity: .6;
  padding: .4em 0;
  /* truncate text with ellipsis if too long */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.cd-slider h2, .cd-slider p {
  line-height: 1.2;
  color: #0f1926;
}
@media only screen and (min-width: 900px) {
  .cd-slider {
    padding: 0;
    overflow: hidden;
    -webkit-transition: -webkit-transform 0.5s;
    -moz-transition: -moz-transform 0.5s;
    transition: transform 0.5s;
    /* Force hardware acceleration */
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }
  .cd-slider::after {
    clear: both;
    content: "";
    display: table;
  }
  .cd-slider li {
    position: relative;
    float: left;
    width: 26vw;
    margin: 0 0 0 2vw;
    top: 50%;
    -webkit-transform: translateX(400%) translateY(-50%) rotate(-10deg);
    -moz-transform: translateX(400%) translateY(-50%) rotate(-10deg);
    -ms-transform: translateX(400%) translateY(-50%) rotate(-10deg);
    -o-transform: translateX(400%) translateY(-50%) rotate(-10deg);
    transform: translateX(400%) translateY(-50%) rotate(-10deg);
    -webkit-transition: opacity 0s 0.3s, -webkit-transform 0s 0.3s;
    -moz-transition: opacity 0s 0.3s, -moz-transform 0s 0.3s;
    transition: opacity 0s 0.3s, transform 0s 0.3s;
  }
  .cd-slider li:first-of-type {
    margin-left: 9vw;
  }
  .cd-slider li.slides-in {
    /* this class is used to trigger the entrance animation */
    -webkit-animation: none;
    -moz-animation: none;
    animation: none;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  .cd-slider li.slides-in:first-of-type {
    /* change transition duration/delay for the entrance animation */
    -webkit-transition: -webkit-transform 0.55s 0s;
    -moz-transition: -moz-transform 0.55s 0s;
    transition: transform 0.55s 0s;
  }
  .cd-slider li.slides-in:nth-of-type(2) {
    -webkit-transition: -webkit-transform 0.53s 0.05s;
    -moz-transition: -moz-transform 0.53s 0.05s;
    transition: transform 0.53s 0.05s;
  }
  .cd-slider li.slides-in:nth-of-type(3) {
    -webkit-transition: -webkit-transform 0.5s 0.1s;
    -moz-transition: -moz-transform 0.5s 0.1s;
    transition: transform 0.5s 0.1s;
  }
  .cd-slider li.slides-in:nth-of-type(4) {
    -webkit-transition: -webkit-transform 0.48s 0.15s;
    -moz-transition: -moz-transform 0.48s 0.15s;
    transition: transform 0.48s 0.15s;
  }
  .cd-slider.next li.current {
    /* next slide animation */
    -webkit-animation: cd-slide-1 0.5s;
    -moz-animation: cd-slide-1 0.5s;
    animation: cd-slide-1 0.5s;
  }
  .cd-slider.next li.current + li {
    -webkit-animation: cd-slide-2 0.5s;
    -moz-animation: cd-slide-2 0.5s;
    animation: cd-slide-2 0.5s;
  }
  .cd-slider.next li.current + li + li {
    -webkit-animation: cd-slide-3 0.5s;
    -moz-animation: cd-slide-3 0.5s;
    animation: cd-slide-3 0.5s;
  }
  .cd-slider.next li.current + li + li + li + li {
    -webkit-animation: cd-slide-4 0.5s;
    -moz-animation: cd-slide-4 0.5s;
    animation: cd-slide-4 0.5s;
  }
  .cd-slider.next li.current + li + li + li + li + li {
    -webkit-animation: cd-slide-5 0.5s;
    -moz-animation: cd-slide-5 0.5s;
    animation: cd-slide-5 0.5s;
  }
  .cd-slider.next li.current + li + li + li + li + li ~ li {
    -webkit-animation: cd-slide-6 0.5s;
    -moz-animation: cd-slide-6 0.5s;
    animation: cd-slide-6 0.5s;
  }
  .cd-slider.prev li {
    /* previous slide animation */
    -webkit-animation: cd-slide-7 0.5s;
    -moz-animation: cd-slide-7 0.5s;
    animation: cd-slide-7 0.5s;
  }
  .cd-slider.prev li.previous {
    /* previous slide animation - the previous class is used to target the slide which was visible right before the current one */
    -webkit-animation: cd-slide-1 0.5s;
    -moz-animation: cd-slide-1 0.5s;
    animation: cd-slide-1 0.5s;
  }
  .cd-slider.prev li.previous + li {
    -webkit-animation: cd-slide-2 0.5s;
    -moz-animation: cd-slide-2 0.5s;
    animation: cd-slide-2 0.5s;
  }
  .cd-slider.prev li.previous + li + li {
    -webkit-animation: cd-slide-3 0.5s;
    -moz-animation: cd-slide-3 0.5s;
    animation: cd-slide-3 0.5s;
  }
  .cd-slider.prev li.current + li {
    -webkit-animation: cd-slide-4 0.5s;
    -moz-animation: cd-slide-4 0.5s;
    animation: cd-slide-4 0.5s;
  }
  .cd-slider.prev li.current + li + li {
    -webkit-animation: cd-slide-5 0.5s;
    -moz-animation: cd-slide-5 0.5s;
    animation: cd-slide-5 0.5s;
  }
  .cd-slider.prev li.current, .cd-slider.prev li.current + li + li ~ li {
    -webkit-animation: none;
    -moz-animation: none;
    animation: none;
  }
}

@-webkit-keyframes cd-slide-1 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-85%);
  }
}
@-moz-keyframes cd-slide-1 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(-85%);
  }
}
@keyframes cd-slide-1 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-85%);
    -moz-transform: translateY(-50%) translateX(-85%);
    -ms-transform: translateY(-50%) translateX(-85%);
    -o-transform: translateY(-50%) translateX(-85%);
    transform: translateY(-50%) translateX(-85%);
  }
}
@-webkit-keyframes cd-slide-2 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-55%);
  }
}
@-moz-keyframes cd-slide-2 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(-55%);
  }
}
@keyframes cd-slide-2 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-55%);
    -moz-transform: translateY(-50%) translateX(-55%);
    -ms-transform: translateY(-50%) translateX(-55%);
    -o-transform: translateY(-50%) translateX(-55%);
    transform: translateY(-50%) translateX(-55%);
  }
}
@-webkit-keyframes cd-slide-3 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-23%);
  }
}
@-moz-keyframes cd-slide-3 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(-23%);
  }
}
@keyframes cd-slide-3 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-23%);
    -moz-transform: translateY(-50%) translateX(-23%);
    -ms-transform: translateY(-50%) translateX(-23%);
    -o-transform: translateY(-50%) translateX(-23%);
    transform: translateY(-50%) translateX(-23%);
  }
}
@-webkit-keyframes cd-slide-4 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(23%);
  }
}
@-moz-keyframes cd-slide-4 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(23%);
  }
}
@keyframes cd-slide-4 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(23%);
    -moz-transform: translateY(-50%) translateX(23%);
    -ms-transform: translateY(-50%) translateX(23%);
    -o-transform: translateY(-50%) translateX(23%);
    transform: translateY(-50%) translateX(23%);
  }
}
@-webkit-keyframes cd-slide-5 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(55%);
  }
}
@-moz-keyframes cd-slide-5 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(55%);
  }
}
@keyframes cd-slide-5 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(55%);
    -moz-transform: translateY(-50%) translateX(55%);
    -ms-transform: translateY(-50%) translateX(55%);
    -o-transform: translateY(-50%) translateX(55%);
    transform: translateY(-50%) translateX(55%);
  }
}
@-webkit-keyframes cd-slide-6 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(65%);
  }
}
@-moz-keyframes cd-slide-6 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(65%);
  }
}
@keyframes cd-slide-6 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(65%);
    -moz-transform: translateY(-50%) translateX(65%);
    -ms-transform: translateY(-50%) translateX(65%);
    -o-transform: translateY(-50%) translateX(65%);
    transform: translateY(-50%) translateX(65%);
  }
}
@-webkit-keyframes cd-slide-7 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-95%);
  }
}
@-moz-keyframes cd-slide-7 {
  0%, 100% {
    -moz-transform: translateY(-50%);
  }
  50% {
    -moz-transform: translateY(-50%) translateX(-95%);
  }
}
@keyframes cd-slide-7 {
  0%, 100% {
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  50% {
    -webkit-transform: translateY(-50%) translateX(-95%);
    -moz-transform: translateY(-50%) translateX(-95%);
    -ms-transform: translateY(-50%) translateX(-95%);
    -o-transform: translateY(-50%) translateX(-95%);
    transform: translateY(-50%) translateX(-95%);
  }
}
/* -------------------------------- 

Project slider navigation

-------------------------------- */
.cd-slider-navigation {
  display: none;
}
.cd-slider-navigation a {
  position: absolute;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  left: 0;
  height: 60px;
  width: 4%;
  background: url(/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/cd-arrow.svg) no-repeat center center;
  -webkit-transition: opacity 0.2s 0s, visibility 0s 0s;
  -moz-transition: opacity 0.2s 0s, visibility 0s 0s;
  transition: opacity 0.2s 0s, visibility 0s 0s;
}
.cd-slider-navigation a.next {
  right: 0;
  left: auto;
}
.cd-slider-navigation a.prev {
  -webkit-transform: translateY(-50%) rotate(180deg);
  -moz-transform: translateY(-50%) rotate(180deg);
  -ms-transform: translateY(-50%) rotate(180deg);
  -o-transform: translateY(-50%) rotate(180deg);
  transform: translateY(-50%) rotate(180deg);
}
.cd-slider-navigation a.inactive {
  visibility: hidden;
  opacity: 0;
  -webkit-transition: opacity 0.2s 0s, visibility 0s 0.2s;
  -moz-transition: opacity 0.2s 0s, visibility 0s 0.2s;
  transition: opacity 0.2s 0s, visibility 0s 0.2s;
}
@media only screen and (min-width: 900px) {
  .cd-slider-navigation {
    display: block;
  }
}

/* -------------------------------- 

Project content panel 

-------------------------------- */
.cd-project-content {
  position: fixed;
  z-index: 3;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  visibility: hidden;
  background-color: #ebebeb;
  /* Force Hardware Acceleration */
  -webkit-transform: translateZ(0);
  -moz-transform: translateZ(0);
  -ms-transform: translateZ(0);
  -o-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform: translateY(100%);
  -moz-transform: translateY(100%);
  -ms-transform: translateY(100%);
  -o-transform: translateY(100%);
  transform: translateY(100%);
  -webkit-transition: -webkit-transform 0.4s 0s, visibility 0s 0.4s;
  -moz-transition: -moz-transform 0.4s 0s, visibility 0s 0.4s;
  transition: transform 0.4s 0s, visibility 0s 0.4s;
  -webkit-transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
  -moz-transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
  transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
}
.cd-project-content > div {
  height: 100%;
  overflow-y: auto;
  padding: 4em 2em;
}
.cd-project-content > div > * {
  max-width: 800px;
  margin-left: auto;
  margin-right: auto;
}
.cd-project-content.is-visible {
  visibility: visible;
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -ms-transform: translateY(0);
  -o-transform: translateY(0);
  transform: translateY(0);
  -webkit-transition: -webkit-transform 0.4s 0s, visibility 0s 0s;
  -moz-transition: -moz-transform 0.4s 0s, visibility 0s 0s;
  transition: transform 0.4s 0s, visibility 0s 0s;
  -webkit-transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
  -moz-transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
  transition-timing-function: cubic-bezier(0.67, 0.15, 0.83, 0.83);
}
.cd-project-content.is-visible > div {
  /* smooth scrolling on iOS */
  -webkit-overflow-scrolling: touch;
}
.cd-project-content h2 {
  font-size: 2.4rem;
  font-weight: bold;
}
.cd-project-content em {
  display: block;
  font-size: 1.8rem;
  font-style: italic;
  margin: 1em auto;
}
.cd-project-content p {
  margin-bottom: 1em;
  font-size: 1.4rem;
  color: #6f757c;
}
.cd-project-content em, .cd-project-content p {
  line-height: 1.6;
}
.cd-project-content .close {
  display: block;
  height: 32px;
  width: 32px;
  position: absolute;
  top: 10px;
  right: 10px;
  background: url(/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/cd-close-dark.svg) no-repeat center center;
}
@media only screen and (min-width: 900px) {
  .cd-project-content h2 {
    font-size: 6rem;
  }
  .cd-project-content em {
    font-size: 2.4rem;
  }
  .cd-project-content p {
    font-size: 1.8rem;
  }
  .cd-project-content .close {
    top: 30px;
    right: 5%;
  }
}

/* -------------------------------- 

Keyframes

-------------------------------- */
@-webkit-keyframes cd-translate {
  0% {
    opacity: 0;
    -webkit-transform: translateY(100px);
  }
  100% {
    -webkit-transform: translateY(0);
    opacity: 1;
  }
}
@-moz-keyframes cd-translate {
  0% {
    opacity: 0;
    -moz-transform: translateY(100px);
  }
  100% {
    -moz-transform: translateY(0);
    opacity: 1;
  }
}
@keyframes cd-translate {
  0% {
    opacity: 0;
    -webkit-transform: translateY(100px);
    -moz-transform: translateY(100px);
    -ms-transform: translateY(100px);
    -o-transform: translateY(100px);
    transform: translateY(100px);
  }
  100% {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

</style>
<body>
  <div class="cd-intro-block">
    <div class="content-wrapper">
      <h1>MAVEN PORTFOLIO</h1>
      <a href="#0" class='cd-btn' data-action="show-projects">Show Portfolio</a>
    </div>
  </div> <!-- .cd-intro-block -->

  <div class="cd-projects-wrapper">
    <ul class="cd-slider">
      <li class="current">
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/2015jeil.png" alt="project image">
          <div class="project-info">
            <h2>제일교육사</h2>
            <p>제일교육사 기업 웹사이트 제작</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/2016bosung.png" alt="project image">
          <div class="project-info">
            <h2>Bosung-Indonesia</h2>
            <p>인도네시아 기업 웹사이트 제작</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/2016maven.png" alt="project image">
          <div class="project-info">
            <h2>2016 MAVEN</h2>
            <p>2016년 메이븐 자체 웹사이트 제작</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/pkdportfolio1.png" alt="project image">
          <div class="project-info">
            <h2>2016 박경두 포트폴리오</h2>
            <p>멋쟁이 사자처럼 4기 과제 원페이지 포트폴리오입니다.</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/img.png" alt="project image">
          <div class="project-info">
            <h2>Project 5</h2>
            <p>Lorem ipsum dolor sit amet, consectetur.</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/img.png" alt="project image">
          <div class="project-info">
            <h2>Project 6</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat.</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/img.png" alt="project image">
          <div class="project-info">
            <h2>Project 7</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
          </div>
        </a>
      </li>
      
      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/img.png" alt="project image">
          <div class="project-info">
            <h2>Project 8</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
          </div>
        </a>
      </li>

      <li>
        <a href="#0">
          <img src="/wordpress-bootstrap/wp-content/themes/bootstrapKD/templates-pages/img/img.png" alt="project image">
          <div class="project-info">
            <h2>Project 9</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
          </div>
        </a>
      </li>
    </ul>

    <ul class="cd-slider-navigation cd-img-replace">
      <li><a href="#0" class="prev inactive">Prev</a></li>
      <li><a href="#0" class="next">Next</a></li>
    </ul> <!-- .cd-slider-navigation -->
  </div> <!-- .cd-projects-wrapper -->

  <div class="cd-project-content">
    <div>
      <h2>Project title here</h2>
      <em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, ullam.</em>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus. 
      </p>
      <p>
        Illum quaerat asperiores aliquam voluptate saepe omnis porro excepturi in atque veritatis sapiente ipsam voluptates iste amet deserunt ullam error pariatur, magni consectetur optio nostrum minima dolorum. Soluta animi nihil doloremque ipsa incidunt vitae architecto beatae, maxime libero, dolore corporis vero porro tenetur ipsam modi repudiandae magnam enim, quibusdam sit.
      </p>
      <p>
        Illum quaerat asperiores aliquam voluptate saepe omnis porro excepturi in atque veritatis sapiente ipsam voluptates iste amet deserunt ullam error pariatur, magni consectetur optio nostrum minima dolorum. Soluta animi nihil doloremque ipsa incidunt vitae architecto beatae, maxime libero, dolore corporis vero porro tenetur ipsam modi repudiandae magnam enim, quibusdam sit.
      </p>
    </div>
    <a href="#0" class="close cd-img-replace">Close</a>
  </div> <!-- .cd-project-content -->
<script src="js/jquery-2.1.4.js"></script>

<script type="text/javascript">
/*! jQuery Mobile v1.4.5 | Copyright 2010, 2014 jQuery Foundation, Inc. | jquery.org/license */

(function(e,t,n){typeof define=="function"&&define.amd?define(["jquery"],function(r){return n(r,e,t),r.mobile}):n(e.jQuery,e,t)})(this,document,function(e,t,n,r){(function(e,t,n,r){function T(e){while(e&&typeof e.originalEvent!="undefined")e=e.originalEvent;return e}function N(t,n){var i=t.type,s,o,a,l,c,h,p,d,v;t=e.Event(t),t.type=n,s=t.originalEvent,o=e.event.props,i.search(/^(mouse|click)/)>-1&&(o=f);if(s)for(p=o.length,l;p;)l=o[--p],t[l]=s[l];i.search(/mouse(down|up)|click/)>-1&&!t.which&&(t.which=1);if(i.search(/^touch/)!==-1){a=T(s),i=a.touches,c=a.changedTouches,h=i&&i.length?i[0]:c&&c.length?c[0]:r;if(h)for(d=0,v=u.length;d<v;d++)l=u[d],t[l]=h[l]}return t}function C(t){var n={},r,s;while(t){r=e.data(t,i);for(s in r)r[s]&&(n[s]=n.hasVirtualBinding=!0);t=t.parentNode}return n}function k(t,n){var r;while(t){r=e.data(t,i);if(r&&(!n||r[n]))return t;t=t.parentNode}return null}function L(){g=!1}function A(){g=!0}function O(){E=0,v.length=0,m=!1,A()}function M(){L()}function _(){D(),c=setTimeout(function(){c=0,O()},e.vmouse.resetTimerDuration)}function D(){c&&(clearTimeout(c),c=0)}function P(t,n,r){var i;if(r&&r[t]||!r&&k(n.target,t))i=N(n,t),e(n.target).trigger(i);return i}function H(t){var n=e.data(t.target,s),r;!m&&(!E||E!==n)&&(r=P("v"+t.type,t),r&&(r.isDefaultPrevented()&&t.preventDefault(),r.isPropagationStopped()&&t.stopPropagation(),r.isImmediatePropagationStopped()&&t.stopImmediatePropagation()))}function B(t){var n=T(t).touches,r,i,o;n&&n.length===1&&(r=t.target,i=C(r),i.hasVirtualBinding&&(E=w++,e.data(r,s,E),D(),M(),d=!1,o=T(t).touches[0],h=o.pageX,p=o.pageY,P("vmouseover",t,i),P("vmousedown",t,i)))}function j(e){if(g)return;d||P("vmousecancel",e,C(e.target)),d=!0,_()}function F(t){if(g)return;var n=T(t).touches[0],r=d,i=e.vmouse.moveDistanceThreshold,s=C(t.target);d=d||Math.abs(n.pageX-h)>i||Math.abs(n.pageY-p)>i,d&&!r&&P("vmousecancel",t,s),P("vmousemove",t,s),_()}function I(e){if(g)return;A();var t=C(e.target),n,r;P("vmouseup",e,t),d||(n=P("vclick",e,t),n&&n.isDefaultPrevented()&&(r=T(e).changedTouches[0],v.push({touchID:E,x:r.clientX,y:r.clientY}),m=!0)),P("vmouseout",e,t),d=!1,_()}function q(t){var n=e.data(t,i),r;if(n)for(r in n)if(n[r])return!0;return!1}function R(){}function U(t){var n=t.substr(1);return{setup:function(){q(this)||e.data(this,i,{});var r=e.data(this,i);r[t]=!0,l[t]=(l[t]||0)+1,l[t]===1&&b.bind(n,H),e(this).bind(n,R),y&&(l.touchstart=(l.touchstart||0)+1,l.touchstart===1&&b.bind("touchstart",B).bind("touchend",I).bind("touchmove",F).bind("scroll",j))},teardown:function(){--l[t],l[t]||b.unbind(n,H),y&&(--l.touchstart,l.touchstart||b.unbind("touchstart",B).unbind("touchmove",F).unbind("touchend",I).unbind("scroll",j));var r=e(this),s=e.data(this,i);s&&(s[t]=!1),r.unbind(n,R),q(this)||r.removeData(i)}}}var i="virtualMouseBindings",s="virtualTouchID",o="vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split(" "),u="clientX clientY pageX pageY screenX screenY".split(" "),a=e.event.mouseHooks?e.event.mouseHooks.props:[],f=e.event.props.concat(a),l={},c=0,h=0,p=0,d=!1,v=[],m=!1,g=!1,y="addEventListener"in n,b=e(n),w=1,E=0,S,x;e.vmouse={moveDistanceThreshold:10,clickDistanceThreshold:10,resetTimerDuration:1500};for(x=0;x<o.length;x++)e.event.special[o[x]]=U(o[x]);y&&n.addEventListener("click",function(t){var n=v.length,r=t.target,i,o,u,a,f,l;if(n){i=t.clientX,o=t.clientY,S=e.vmouse.clickDistanceThreshold,u=r;while(u){for(a=0;a<n;a++){f=v[a],l=0;if(u===r&&Math.abs(f.x-i)<S&&Math.abs(f.y-o)<S||e.data(u,s)===f.touchID){t.preventDefault(),t.stopPropagation();return}}u=u.parentNode}}},!0)})(e,t,n),function(e){e.mobile={}}(e),function(e,t){var r={touch:"ontouchend"in n};e.mobile.support=e.mobile.support||{},e.extend(e.support,r),e.extend(e.mobile.support,r)}(e),function(e,t,r){function l(t,n,i,s){var o=i.type;i.type=n,s?e.event.trigger(i,r,t):e.event.dispatch.call(t,i),i.type=o}var i=e(n),s=e.mobile.support.touch,o="touchmove scroll",u=s?"touchstart":"mousedown",a=s?"touchend":"mouseup",f=s?"touchmove":"mousemove";e.each("touchstart touchmove touchend tap taphold swipe swipeleft swiperight scrollstart scrollstop".split(" "),function(t,n){e.fn[n]=function(e){return e?this.bind(n,e):this.trigger(n)},e.attrFn&&(e.attrFn[n]=!0)}),e.event.special.scrollstart={enabled:!0,setup:function(){function s(e,n){r=n,l(t,r?"scrollstart":"scrollstop",e)}var t=this,n=e(t),r,i;n.bind(o,function(t){if(!e.event.special.scrollstart.enabled)return;r||s(t,!0),clearTimeout(i),i=setTimeout(function(){s(t,!1)},50)})},teardown:function(){e(this).unbind(o)}},e.event.special.tap={tapholdThreshold:750,emitTapOnTaphold:!0,setup:function(){var t=this,n=e(t),r=!1;n.bind("vmousedown",function(s){function a(){clearTimeout(u)}function f(){a(),n.unbind("vclick",c).unbind("vmouseup",a),i.unbind("vmousecancel",f)}function c(e){f(),!r&&o===e.target?l(t,"tap",e):r&&e.preventDefault()}r=!1;if(s.which&&s.which!==1)return!1;var o=s.target,u;n.bind("vmouseup",a).bind("vclick",c),i.bind("vmousecancel",f),u=setTimeout(function(){e.event.special.tap.emitTapOnTaphold||(r=!0),l(t,"taphold",e.Event("taphold",{target:o}))},e.event.special.tap.tapholdThreshold)})},teardown:function(){e(this).unbind("vmousedown").unbind("vclick").unbind("vmouseup"),i.unbind("vmousecancel")}},e.event.special.swipe={scrollSupressionThreshold:30,durationThreshold:1e3,horizontalDistanceThreshold:30,verticalDistanceThreshold:30,getLocation:function(e){var n=t.pageXOffset,r=t.pageYOffset,i=e.clientX,s=e.clientY;if(e.pageY===0&&Math.floor(s)>Math.floor(e.pageY)||e.pageX===0&&Math.floor(i)>Math.floor(e.pageX))i-=n,s-=r;else if(s<e.pageY-r||i<e.pageX-n)i=e.pageX-n,s=e.pageY-r;return{x:i,y:s}},start:function(t){var n=t.originalEvent.touches?t.originalEvent.touches[0]:t,r=e.event.special.swipe.getLocation(n);return{time:(new Date).getTime(),coords:[r.x,r.y],origin:e(t.target)}},stop:function(t){var n=t.originalEvent.touches?t.originalEvent.touches[0]:t,r=e.event.special.swipe.getLocation(n);return{time:(new Date).getTime(),coords:[r.x,r.y]}},handleSwipe:function(t,n,r,i){if(n.time-t.time<e.event.special.swipe.durationThreshold&&Math.abs(t.coords[0]-n.coords[0])>e.event.special.swipe.horizontalDistanceThreshold&&Math.abs(t.coords[1]-n.coords[1])<e.event.special.swipe.verticalDistanceThreshold){var s=t.coords[0]>n.coords[0]?"swipeleft":"swiperight";return l(r,"swipe",e.Event("swipe",{target:i,swipestart:t,swipestop:n}),!0),l(r,s,e.Event(s,{target:i,swipestart:t,swipestop:n}),!0),!0}return!1},eventInProgress:!1,setup:function(){var t,n=this,r=e(n),s={};t=e.data(this,"mobile-events"),t||(t={length:0},e.data(this,"mobile-events",t)),t.length++,t.swipe=s,s.start=function(t){if(e.event.special.swipe.eventInProgress)return;e.event.special.swipe.eventInProgress=!0;var r,o=e.event.special.swipe.start(t),u=t.target,l=!1;s.move=function(t){if(!o||t.isDefaultPrevented())return;r=e.event.special.swipe.stop(t),l||(l=e.event.special.swipe.handleSwipe(o,r,n,u),l&&(e.event.special.swipe.eventInProgress=!1)),Math.abs(o.coords[0]-r.coords[0])>e.event.special.swipe.scrollSupressionThreshold&&t.preventDefault()},s.stop=function(){l=!0,e.event.special.swipe.eventInProgress=!1,i.off(f,s.move),s.move=null},i.on(f,s.move).one(a,s.stop)},r.on(u,s.start)},teardown:function(){var t,n;t=e.data(this,"mobile-events"),t&&(n=t.swipe,delete t.swipe,t.length--,t.length===0&&e.removeData(this,"mobile-events")),n&&(n.start&&e(this).off(u,n.start),n.move&&i.off(f,n.move),n.stop&&i.off(a,n.stop))}},e.each({scrollstop:"scrollstart",taphold:"tap",swipeleft:"swipe.left",swiperight:"swipe.right"},function(t,n){e.event.special[t]={setup:function(){e(this).bind(n,e.noop)},teardown:function(){e(this).unbind(n)}}})}(e,this)});
</script>
<!-- Resource jQuery -->
<script type="text/javascript">
jQuery(document).ready(function(){
  var intro = $('.cd-intro-block'),
    projectsContainer = $('.cd-projects-wrapper'),
    projectsSlider = projectsContainer.children('.cd-slider'),
    singleProjectContent = $('.cd-project-content'),
    sliderNav = $('.cd-slider-navigation');

  var resizing = false;
  
  //if on desktop - set a width for the projectsSlider element
  setSliderContainer();
  $(window).on('resize', function(){
    //on resize - update projectsSlider width and translate value
    if( !resizing ) {
      (!window.requestAnimationFrame) ? setSliderContainer() : window.requestAnimationFrame(setSliderContainer);
      resizing = true;
    }
  });

  //show the projects slider if user clicks the show-projects button
  intro.on('click', 'a[data-action="show-projects"]', function(event) {
    event.preventDefault();
    intro.addClass('projects-visible');
    projectsContainer.addClass('projects-visible');
    //animate single project - entrance animation
    setTimeout(function(){
      showProjectPreview(projectsSlider.children('li').eq(0));
    }, 200);
  });

  intro.on('click', function(event) {
    //projects slider is visible - hide slider and show the intro panel
    if( intro.hasClass('projects-visible') && !$(event.target).is('a[data-action="show-projects"]') ) {
      intro.removeClass('projects-visible');
      projectsContainer.removeClass('projects-visible');
    }
  });

  //select a single project - open project-content panel
  projectsContainer.on('click', '.cd-slider a', function(event) {
    var mq = checkMQ();
    event.preventDefault();
    if( $(this).parent('li').next('li').is('.current') && (mq == 'desktop') ) {
      prevSides(projectsSlider);
    } else if ( $(this).parent('li').prev('li').prev('li').prev('li').is('.current')  && (mq == 'desktop') ) {
      nextSides(projectsSlider);
    } else {
      singleProjectContent.addClass('is-visible');
    }
  });

  //close single project content
  singleProjectContent.on('click', '.close', function(event){
    event.preventDefault();
    singleProjectContent.removeClass('is-visible');
  });

  //go to next/pre slide - clicking on the next/prev arrow
  sliderNav.on('click', '.next', function(){
    nextSides(projectsSlider);
  });
  sliderNav.on('click', '.prev', function(){
    prevSides(projectsSlider);
  });

  //go to next/pre slide - keyboard navigation
  $(document).keyup(function(event){
    var mq = checkMQ();
    if(event.which=='37' &&  intro.hasClass('projects-visible') && !(sliderNav.find('.prev').hasClass('inactive')) && (mq == 'desktop') ) {
      prevSides(projectsSlider);
    } else if( event.which=='39' &&  intro.hasClass('projects-visible') && !(sliderNav.find('.next').hasClass('inactive')) && (mq == 'desktop') ) {
      nextSides(projectsSlider);
    } else if(event.which=='27' && singleProjectContent.hasClass('is-visible')) {
      singleProjectContent.removeClass('is-visible');
    }
  });

  projectsSlider.on('swipeleft', function(){
    var mq = checkMQ();
    if( !(sliderNav.find('.next').hasClass('inactive')) && (mq == 'desktop') ) nextSides(projectsSlider);
  });

  projectsSlider.on('swiperight', function(){
    var mq = checkMQ();
    if ( !(sliderNav.find('.prev').hasClass('inactive')) && (mq == 'desktop') ) prevSides(projectsSlider);
  });

  function showProjectPreview(project) {
    if(project.length > 0 ) {
      setTimeout(function(){
        project.addClass('slides-in');
        showProjectPreview(project.next());
      }, 50);
    }
  }

  function checkMQ() {
    //check if mobile or desktop device
    return window.getComputedStyle(document.querySelector('.cd-projects-wrapper'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
  }

  function setSliderContainer() {
    var mq = checkMQ();
    if(mq == 'desktop') {
      var slides = projectsSlider.children('li'),
        slideWidth = slides.eq(0).width(),
        marginLeft = Number(projectsSlider.children('li').eq(1).css('margin-left').replace('px', '')),
        sliderWidth = ( slideWidth + marginLeft )*( slides.length + 1 ) + 'px',
        slideCurrentIndex = projectsSlider.children('li.current').index();
      projectsSlider.css('width', sliderWidth);
      ( slideCurrentIndex != 0 ) && setTranslateValue(projectsSlider, (  slideCurrentIndex * (slideWidth + marginLeft) + 'px'));
    } else {
      projectsSlider.css('width', '');
      setTranslateValue(projectsSlider, 0);
    }
    resizing = false;
  }

  function nextSides(slider) {
    var actual = slider.children('.current'),
      index = actual.index(),
      following = actual.nextAll('li').length,
      width = actual.width(),
      marginLeft = Number(slider.children('li').eq(1).css('margin-left').replace('px', ''));

    index = (following > 4 ) ? index + 3 : index + following - 2;
    //calculate the translate value of the slider container
    translate = index * (width + marginLeft) + 'px';

    slider.addClass('next');
    setTranslateValue(slider, translate);
    slider.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
      updateSlider('next', actual, slider, following);
    });

    if( $('.no-csstransitions').length > 0 ) updateSlider('next', actual, slider, following);
  }

  function prevSides(slider) {
    var actual = slider.children('.previous'),
      index = actual.index(),
      width = actual.width(),
      marginLeft = Number(slider.children('li').eq(1).css('margin-left').replace('px', ''));

    translate = index * (width + marginLeft) + 'px';

    slider.addClass('prev');
    setTranslateValue(slider, translate);
    slider.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
      updateSlider('prev', actual, slider);
    });

    if( $('.no-csstransitions').length > 0 ) updateSlider('prev', actual, slider);
  }

  function updateSlider(direction, actual, slider, numerFollowing) {
    if( direction == 'next' ) {
      
      slider.removeClass('next').find('.previous').removeClass('previous');
      actual.removeClass('current');
      if( numerFollowing > 4 ) {
        actual.addClass('previous').next('li').next('li').next('li').addClass('current');
      } else if ( numerFollowing == 4 ) {
        actual.next('li').next('li').addClass('current').prev('li').prev('li').addClass('previous');
      } else {
        actual.next('li').addClass('current').end().addClass('previous');
      }
    } else {
      
      slider.removeClass('prev').find('.current').removeClass('current');
      actual.removeClass('previous').addClass('current');
      if(actual.prevAll('li').length > 2 ) {
        actual.prev('li').prev('li').prev('li').addClass('previous');
      } else {
        ( !slider.children('li').eq(0).hasClass('current') ) && slider.children('li').eq(0).addClass('previous');
      }
    }
    
    updateNavigation();
  }

  function updateNavigation() {
    //update visibility of next/prev buttons according to the visible slides
    var current = projectsContainer.find('li.current');
    (current.is(':first-child')) ? sliderNav.find('.prev').addClass('inactive') : sliderNav.find('.prev').removeClass('inactive');
    (current.nextAll('li').length < 3 ) ? sliderNav.find('.next').addClass('inactive') : sliderNav.find('.next').removeClass('inactive');
  }

  function setTranslateValue(item, translate) {
    item.css({
        '-moz-transform': 'translateX(-' + translate + ')',
        '-webkit-transform': 'translateX(-' + translate + ')',
      '-ms-transform': 'translateX(-' + translate + ')',
      '-o-transform': 'translateX(-' + translate + ')',
      'transform': 'translateX(-' + translate + ')',
    });
  }
});
</script>
</body>

<?php get_footer(); ?>