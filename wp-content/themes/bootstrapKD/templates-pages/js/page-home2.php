
<?php
/**
 * Template Name: Page - Home Hero2
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); 
?>
<style>

@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
/* the important bits */
li {
  -webkit-perspective: 400px;
          perspective: 400px;
}

.info {
  -webkit-transform: rotate3d(1, 0, 0, 90deg);
          transform: rotate3d(1, 0, 0, 90deg);
  width: 100%;
  height: 100%;
  padding: 20px;
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 4px;
  pointer-events: none;
  background-color: rgba(26, 188, 156, 0.9);
}

.in-top .info {
  -webkit-transform-origin: 50% 0%;
          transform-origin: 50% 0%;
  -webkit-animation: in-top 300ms ease 0ms 1 forwards;
          animation: in-top 300ms ease 0ms 1 forwards;
}

.in-right .info {
  -webkit-transform-origin: 100% 0%;
          transform-origin: 100% 0%;
  -webkit-animation: in-right 300ms ease 0ms 1 forwards;
          animation: in-right 300ms ease 0ms 1 forwards;
}

.in-bottom .info {
  -webkit-transform-origin: 50% 100%;
          transform-origin: 50% 100%;
  -webkit-animation: in-bottom 300ms ease 0ms 1 forwards;
          animation: in-bottom 300ms ease 0ms 1 forwards;
}

.in-left .info {
  -webkit-transform-origin: 0% 0%;
          transform-origin: 0% 0%;
  -webkit-animation: in-left 300ms ease 0ms 1 forwards;
          animation: in-left 300ms ease 0ms 1 forwards;
}

.out-top .info {
  -webkit-transform-origin: 50% 0%;
          transform-origin: 50% 0%;
  -webkit-animation: out-top 300ms ease 0ms 1 forwards;
          animation: out-top 300ms ease 0ms 1 forwards;
}

.out-right .info {
  -webkit-transform-origin: 100% 50%;
          transform-origin: 100% 50%;
  -webkit-animation: out-right 300ms ease 0ms 1 forwards;
          animation: out-right 300ms ease 0ms 1 forwards;
}

.out-bottom .info {
  -webkit-transform-origin: 50% 100%;
          transform-origin: 50% 100%;
  -webkit-animation: out-bottom 300ms ease 0ms 1 forwards;
          animation: out-bottom 300ms ease 0ms 1 forwards;
}

.out-left .info {
  -webkit-transform-origin: 0% 0%;
          transform-origin: 0% 0%;
  -webkit-animation: out-left 300ms ease 0ms 1 forwards;
          animation: out-left 300ms ease 0ms 1 forwards;
}

@-webkit-keyframes in-top {
  from {
    -webkit-transform: rotate3d(-1, 0, 0, 90deg);
            transform: rotate3d(-1, 0, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}

@keyframes in-top {
  from {
    -webkit-transform: rotate3d(-1, 0, 0, 90deg);
            transform: rotate3d(-1, 0, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@-webkit-keyframes in-right {
  from {
    -webkit-transform: rotate3d(0, -1, 0, 90deg);
            transform: rotate3d(0, -1, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@keyframes in-right {
  from {
    -webkit-transform: rotate3d(0, -1, 0, 90deg);
            transform: rotate3d(0, -1, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@-webkit-keyframes in-bottom {
  from {
    -webkit-transform: rotate3d(1, 0, 0, 90deg);
            transform: rotate3d(1, 0, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@keyframes in-bottom {
  from {
    -webkit-transform: rotate3d(1, 0, 0, 90deg);
            transform: rotate3d(1, 0, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@-webkit-keyframes in-left {
  from {
    -webkit-transform: rotate3d(0, 1, 0, 90deg);
            transform: rotate3d(0, 1, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@keyframes in-left {
  from {
    -webkit-transform: rotate3d(0, 1, 0, 90deg);
            transform: rotate3d(0, 1, 0, 90deg);
  }
  to {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
}
@-webkit-keyframes out-top {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(-1, 0, 0, 104deg);
            transform: rotate3d(-1, 0, 0, 104deg);
  }
}
@keyframes out-top {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(-1, 0, 0, 104deg);
            transform: rotate3d(-1, 0, 0, 104deg);
  }
}
@-webkit-keyframes out-right {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(0, -1, 0, 104deg);
            transform: rotate3d(0, -1, 0, 104deg);
  }
}
@keyframes out-right {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(0, -1, 0, 104deg);
            transform: rotate3d(0, -1, 0, 104deg);
  }
}
@-webkit-keyframes out-bottom {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(1, 0, 0, 104deg);
            transform: rotate3d(1, 0, 0, 104deg);
  }
}
@keyframes out-bottom {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(1, 0, 0, 104deg);
            transform: rotate3d(1, 0, 0, 104deg);
  }
}
@-webkit-keyframes out-left {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(0, 1, 0, 104deg);
            transform: rotate3d(0, 1, 0, 104deg);
  }
}
@keyframes out-left {
  from {
    -webkit-transform: rotate3d(0, 0, 0, 0deg);
            transform: rotate3d(0, 0, 0, 0deg);
  }
  to {
    -webkit-transform: rotate3d(0, 1, 0, 104deg);
            transform: rotate3d(0, 1, 0, 104deg);
  }
}
/* you can ignore this ones */
ul {
  padding: 0;
  margin: 0 0 50px;
}
ul:after {
  content: "";
  display: table;
  clear: both;
}

li#hoverli {
  position: relative;
  float: left;
  width: 200px;
  height: 200px;
  margin: 5px;
  padding: 0;
  list-style: none;
}
li a {
  display: inline-block;
  vertical-align: top;
  text-decoration: none;
  border-radius: 4px;
}
li h3 {
  margin: 0;
  font-size: 16px;
  color: rgba(255, 255, 255, 0.9);
}
li p {
  font-size: 12px;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.8);
}
li .normal {
  width: 100%;
  height: 100%;
  background-color: #ECF0F1;
  color: rgba(52, 73, 94, 0.6);
  box-shadow: inset 0 2px 20px #e6ebed;
  text-align: center;
  font-size: 50px;
  line-height: 200px;
}
li .normal svg {
  pointer-events: none;
  width: 50px;
}
li .normal svg path {
  fill: rgba(52, 73, 94, 0.2);
}

* {
  box-sizing: border-box;
}

body {
  background-color: #fff;
}

h1 {
  margin: 0 auto 5px;
  text-align: center;
}

h3 {
  font-family: 'Bree Serif', serif;
}

.container {
  width: 840px;
  margin: 0 auto;
}

header {
  font-family: 'Bree Serif', serif;
  text-align: center;
  margin: 50px 0 25px;
  color: #34495E;
}
header p {
  margin: 0;
  color: rgba(52, 73, 94, 0.4);
}

</style>



<div class="container-fluid">
   <div class="row-fluid">
    <header>
  <div class='container'>
    <h1>Direction-aware hover effect</h1>
    <p>CSS &amp; bits of JS</p>
  </div>
</header>

  <ul>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
    <li id="hoverli">
      <a class='normal' href='#'>
        <svg viewBox='0 0 80 76' x='0px' y='0px'>
          <g>
            <path d='M 68.9708 24.8623 L 60.4554 2.3018 C 59.9641 0.7017 58.1628 -0.2583 56.5252 0.3817 L 1.9822 20.2222 C 0.3822 20.7022 -0.4179 22.6222 0.2222 24.2223 L 8.8624 47.7797 L 8.8624 35.1484 C 8.8624 29.5024 13.3425 24.8623 18.8857 24.8623 L 32.9442 24.8623 L 50.63 12.862 L 60.7829 24.8623 L 68.9708 24.8623 L 68.9708 24.8623 ZM 77.098 32.0625 L 18.8857 32.0625 C 17.2512 32.0625 16.0625 33.4511 16.0625 35.1484 L 16.0625 72.8491 C 16.0625 74.5477 17.2512 75.9375 18.8857 75.9375 L 77.098 75.9375 C 78.742 75.9375 79.9376 74.5477 79.9376 72.8491 L 79.9376 35.1484 C 79.9376 33.4511 78.742 32.0625 77.098 32.0625 L 77.098 32.0625 ZM 73.0626 68.0625 L 23.9375 68.0625 L 23.9375 61.0852 L 31.4704 43.7232 L 42.7696 57.6777 L 53.4138 46.8062 L 67.1695 41.9375 L 73.0626 55.0815 L 73.0626 68.0625 L 73.0626 68.0625 Z'></path>
          </g>
        </svg>
      </a>
      <div class='info'>
        <h3>Single-origin coffee whatever</h3>
        <p>Williamsburg tofu polaroid, 90's Bushwick irony locavore ethnic meh messenger bag Truffaut jean shorts.</p>
      </div>
    </li>
  </ul>

    
        <script>


// - Noel Delgado | @pixelia_me


var nodes  = document.querySelectorAll('li'),
    _nodes = [].slice.call(nodes, 0);

var getDirection = function (ev, obj) {
    var w = obj.offsetWidth,
        h = obj.offsetHeight,
        x = (ev.pageX - obj.offsetLeft - (w / 2) * (w > h ? (h / w) : 1)),
        y = (ev.pageY - obj.offsetTop - (h / 2) * (h > w ? (w / h) : 1)),
        d = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4;
  
    return d;
};

var addClass = function ( ev, obj, state ) {
    var direction = getDirection( ev, obj ),
        class_suffix = "";
    
    obj.className = "";
    
    switch ( direction ) {
        case 0 : class_suffix = '-top';    break;
        case 1 : class_suffix = '-right';  break;
        case 2 : class_suffix = '-bottom'; break;
        case 3 : class_suffix = '-left';   break;
    }
    
    obj.classList.add( state + class_suffix );
};

// bind events
_nodes.forEach(function (el) {
    el.addEventListener('mouseover', function (ev) {
        addClass( ev, this, 'in' );
    }, false);

    el.addEventListener('mouseout', function (ev) {
        addClass( ev, this, 'out' );
    }, false);
});
        </script>

    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>