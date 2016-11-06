
<?php
/**
 * Template Name: Page - maven_intro
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); 
?>
<style>

/*
  전체 메이븐 소개페이지 꾸며주기 css
*/


/* Box Model */

  *, *:before, *:after {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }


  @media screen and (max-width: 1680px) {

    .container.\31 25\25 {
      width: 100%;
      max-width: 100em;
      min-width: 80em;
    }

    .container.\37 5\25 {
      width: 60em;
    }

    .container.\35 0\25 {
      width: 40em;
    }

    .container.\32 5\25 {
      width: 20em;
    }

    .container {
      width: 80em;
    }

  }

  @media screen and (max-width: 1280px) {

    .container.\31 25\25 {
      width: 100%;
      max-width: 81.25em;
      min-width: 65em;
    }

    .container.\37 5\25 {
      width: 48.75em;
    }

    .container.\35 0\25 {
      width: 32.5em;
    }

    .container.\32 5\25 {
      width: 16.25em;
    }

    .container {
      width: 65em;
    }

  }

  @media screen and (max-width: 980px) {

    .container.\31 25\25 {
      width: 100%;
      max-width: 112.5%;
      min-width: 90%;
    }

    .container.\37 5\25 {
      width: 67.5%;
    }

    .container.\35 0\25 {
      width: 45%;
    }

    .container.\32 5\25 {
      width: 22.5%;
    }

    .container {
      width: 90% !important;
    }

  }

  @media screen and (max-width: 736px) {

    .container.\31 25\25 {
      width: 100%;
      max-width: 112.5%;
      min-width: 90%;
    }

    .container.\37 5\25 {
      width: 67.5%;
    }

    .container.\35 0\25 {
      width: 45%;
    }

    .container.\32 5\25 {
      width: 22.5%;
    }

    .container {
      width: 90% !important;
    }

  }

  @media screen and (max-width: 480px) {

    .container.\31 25\25 {
      width: 100%;
      max-width: 112.5%;
      min-width: 90%;
    }

    .container.\37 5\25 {
      width: 67.5%;
    }

    .container.\35 0\25 {
      width: 45%;
    }

    .container.\32 5\25 {
      width: 22.5%;
    }

    .container {
      width: 90% !important;
    }

  }

/* Grid */

  .row {
    border-bottom: solid 1px transparent;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }

  .row > * {
    float: left;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }

  .row:after, .row:before {
    content: '';
    display: block;
    clear: both;
    height: 0;
  }

  .row.uniform > * > :first-child {
    margin-top: 0;
  }

  .row.uniform > * > :last-child {
    margin-bottom: 0;
  }

  .row.\30 \25 > * {
    padding: 0 0 0 0em;
  }

  .row.\30 \25 {
    margin: 0 0 -1px 0em;
  }

  .row.uniform.\30 \25 > * {
    padding: 0em 0 0 0em;
  }

  .row.uniform.\30 \25 {
    margin: 0em 0 -1px 0em;
  }

  .row > * {
    padding: 0 0 0 2em;
  }

  .row {
    margin: 0 0 -1px -2em;
  }

  .row.uniform > * {
    padding: 2em 0 0 2em;
  }

  .row.uniform {
    margin: -2em 0 -1px -2em;
  }

  .row.\32 00\25 > * {
    padding: 0 0 0 4em;
  }

  .row.\32 00\25 {
    margin: 0 0 -1px -4em;
  }

  .row.uniform.\32 00\25 > * {
    padding: 4em 0 0 4em;
  }

  .row.uniform.\32 00\25 {
    margin: -4em 0 -1px -4em;
  }

  .row.\31 50\25 > * {
    padding: 0 0 0 3em;
  }

  .row.\31 50\25 {
    margin: 0 0 -1px -3em;
  }

  .row.uniform.\31 50\25 > * {
    padding: 3em 0 0 3em;
  }

  .row.uniform.\31 50\25 {
    margin: -3em 0 -1px -3em;
  }

  .row.\35 0\25 > * {
    padding: 0 0 0 1em;
  }

  .row.\35 0\25 {
    margin: 0 0 -1px -1em;
  }

  .row.uniform.\35 0\25 > * {
    padding: 1em 0 0 1em;
  }

  .row.uniform.\35 0\25 {
    margin: -1em 0 -1px -1em;
  }

  .row.\32 5\25 > * {
    padding: 0 0 0 0.5em;
  }

  .row.\32 5\25 {
    margin: 0 0 -1px -0.5em;
  }

  .row.uniform.\32 5\25 > * {
    padding: 0.5em 0 0 0.5em;
  }

  .row.uniform.\32 5\25 {
    margin: -0.5em 0 -1px -0.5em;
  }

  .\31 2u, .\31 2u\24 {
    width: 100%;
    clear: none;
    margin-left: 0;
  }

  .\31 1u, .\31 1u\24 {
    width: 91.6666666667%;
    clear: none;
    margin-left: 0;
  }

  .\31 0u, .\31 0u\24 {
    width: 83.3333333333%;
    clear: none;
    margin-left: 0;
  }

  .\39 u, .\39 u\24 {
    width: 75%;
    clear: none;
    margin-left: 0;
  }

  .\38 u, .\38 u\24 {
    width: 66.6666666667%;
    clear: none;
    margin-left: 0;
  }

  .\37 u, .\37 u\24 {
    width: 58.3333333333%;
    clear: none;
    margin-left: 0;
  }

  .\36 u, .\36 u\24 {
    width: 50%;
    clear: none;
    margin-left: 0;
  }

  .\35 u, .\35 u\24 {
    width: 41.6666666667%;
    clear: none;
    margin-left: 0;
  }

  .\34 u, .\34 u\24 {
    width: 33.3333333333%;
    clear: none;
    margin-left: 0;
  }

  .\33 u, .\33 u\24 {
    width: 25%;
    clear: none;
    margin-left: 0;
  }

  .\32 u, .\32 u\24 {
    width: 16.6666666667%;
    clear: none;
    margin-left: 0;
  }

  .\31 u, .\31 u\24 {
    width: 8.3333333333%;
    clear: none;
    margin-left: 0;
  }

  .\31 2u\24 + *,
  .\31 1u\24 + *,
  .\31 0u\24 + *,
  .\39 u\24 + *,
  .\38 u\24 + *,
  .\37 u\24 + *,
  .\36 u\24 + *,
  .\35 u\24 + *,
  .\34 u\24 + *,
  .\33 u\24 + *,
  .\32 u\24 + *,
  .\31 u\24 + * {
    clear: left;
  }

  .\-11u {
    margin-left: 91.66667%;
  }

  .\-10u {
    margin-left: 83.33333%;
  }

  .\-9u {
    margin-left: 75%;
  }

  .\-8u {
    margin-left: 66.66667%;
  }

  .\-7u {
    margin-left: 58.33333%;
  }

  .\-6u {
    margin-left: 50%;
  }

  .\-5u {
    margin-left: 41.66667%;
  }

  .\-4u {
    margin-left: 33.33333%;
  }

  .\-3u {
    margin-left: 25%;
  }

  .\-2u {
    margin-left: 16.66667%;
  }

  .\-1u {
    margin-left: 8.33333%;
  }

  @media screen and (max-width: 1680px) {

    .row > * {
      padding: 0 0 0 2em;
    }

    .row {
      margin: 0 0 -1px -2em;
    }

    .row.uniform > * {
      padding: 2em 0 0 2em;
    }

    .row.uniform {
      margin: -2em 0 -1px -2em;
    }

    .row.\32 00\25 > * {
      padding: 0 0 0 4em;
    }

    .row.\32 00\25 {
      margin: 0 0 -1px -4em;
    }

    .row.uniform.\32 00\25 > * {
      padding: 4em 0 0 4em;
    }

    .row.uniform.\32 00\25 {
      margin: -4em 0 -1px -4em;
    }

    .row.\31 50\25 > * {
      padding: 0 0 0 3em;
    }

    .row.\31 50\25 {
      margin: 0 0 -1px -3em;
    }

    .row.uniform.\31 50\25 > * {
      padding: 3em 0 0 3em;
    }

    .row.uniform.\31 50\25 {
      margin: -3em 0 -1px -3em;
    }

    .row.\35 0\25 > * {
      padding: 0 0 0 1em;
    }

    .row.\35 0\25 {
      margin: 0 0 -1px -1em;
    }

    .row.uniform.\35 0\25 > * {
      padding: 1em 0 0 1em;
    }

    .row.uniform.\35 0\25 {
      margin: -1em 0 -1px -1em;
    }

    .row.\32 5\25 > * {
      padding: 0 0 0 0.5em;
    }

    .row.\32 5\25 {
      margin: 0 0 -1px -0.5em;
    }

    .row.uniform.\32 5\25 > * {
      padding: 0.5em 0 0 0.5em;
    }

    .row.uniform.\32 5\25 {
      margin: -0.5em 0 -1px -0.5em;
    }

    .\31 2u\28xlarge\29, .\31 2u\24\28xlarge\29 {
      width: 100%;
      clear: none;
      margin-left: 0;
    }

    .\31 1u\28xlarge\29, .\31 1u\24\28xlarge\29 {
      width: 91.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 0u\28xlarge\29, .\31 0u\24\28xlarge\29 {
      width: 83.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\39 u\28xlarge\29, .\39 u\24\28xlarge\29 {
      width: 75%;
      clear: none;
      margin-left: 0;
    }

    .\38 u\28xlarge\29, .\38 u\24\28xlarge\29 {
      width: 66.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\37 u\28xlarge\29, .\37 u\24\28xlarge\29 {
      width: 58.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\36 u\28xlarge\29, .\36 u\24\28xlarge\29 {
      width: 50%;
      clear: none;
      margin-left: 0;
    }

    .\35 u\28xlarge\29, .\35 u\24\28xlarge\29 {
      width: 41.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\34 u\28xlarge\29, .\34 u\24\28xlarge\29 {
      width: 33.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\33 u\28xlarge\29, .\33 u\24\28xlarge\29 {
      width: 25%;
      clear: none;
      margin-left: 0;
    }

    .\32 u\28xlarge\29, .\32 u\24\28xlarge\29 {
      width: 16.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 u\28xlarge\29, .\31 u\24\28xlarge\29 {
      width: 8.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\31 2u\24\28xlarge\29 + *,
    .\31 1u\24\28xlarge\29 + *,
    .\31 0u\24\28xlarge\29 + *,
    .\39 u\24\28xlarge\29 + *,
    .\38 u\24\28xlarge\29 + *,
    .\37 u\24\28xlarge\29 + *,
    .\36 u\24\28xlarge\29 + *,
    .\35 u\24\28xlarge\29 + *,
    .\34 u\24\28xlarge\29 + *,
    .\33 u\24\28xlarge\29 + *,
    .\32 u\24\28xlarge\29 + *,
    .\31 u\24\28xlarge\29 + * {
      clear: left;
    }

    .\-11u\28xlarge\29 {
      margin-left: 91.66667%;
    }

    .\-10u\28xlarge\29 {
      margin-left: 83.33333%;
    }

    .\-9u\28xlarge\29 {
      margin-left: 75%;
    }

    .\-8u\28xlarge\29 {
      margin-left: 66.66667%;
    }

    .\-7u\28xlarge\29 {
      margin-left: 58.33333%;
    }

    .\-6u\28xlarge\29 {
      margin-left: 50%;
    }

    .\-5u\28xlarge\29 {
      margin-left: 41.66667%;
    }

    .\-4u\28xlarge\29 {
      margin-left: 33.33333%;
    }

    .\-3u\28xlarge\29 {
      margin-left: 25%;
    }

    .\-2u\28xlarge\29 {
      margin-left: 16.66667%;
    }

    .\-1u\28xlarge\29 {
      margin-left: 8.33333%;
    }

  }

  @media screen and (max-width: 1280px) {

    .row > * {
      padding: 0 0 0 1.5em;
    }

    .row {
      margin: 0 0 -1px -1.5em;
    }

    .row.uniform > * {
      padding: 1.5em 0 0 1.5em;
    }

    .row.uniform {
      margin: -1.5em 0 -1px -1.5em;
    }

    .row.\32 00\25 > * {
      padding: 0 0 0 3em;
    }

    .row.\32 00\25 {
      margin: 0 0 -1px -3em;
    }

    .row.uniform.\32 00\25 > * {
      padding: 3em 0 0 3em;
    }

    .row.uniform.\32 00\25 {
      margin: -3em 0 -1px -3em;
    }

    .row.\31 50\25 > * {
      padding: 0 0 0 2.25em;
    }

    .row.\31 50\25 {
      margin: 0 0 -1px -2.25em;
    }

    .row.uniform.\31 50\25 > * {
      padding: 2.25em 0 0 2.25em;
    }

    .row.uniform.\31 50\25 {
      margin: -2.25em 0 -1px -2.25em;
    }

    .row.\35 0\25 > * {
      padding: 0 0 0 0.75em;
    }

    .row.\35 0\25 {
      margin: 0 0 -1px -0.75em;
    }

    .row.uniform.\35 0\25 > * {
      padding: 0.75em 0 0 0.75em;
    }

    .row.uniform.\35 0\25 {
      margin: -0.75em 0 -1px -0.75em;
    }

    .row.\32 5\25 > * {
      padding: 0 0 0 0.375em;
    }

    .row.\32 5\25 {
      margin: 0 0 -1px -0.375em;
    }

    .row.uniform.\32 5\25 > * {
      padding: 0.375em 0 0 0.375em;
    }

    .row.uniform.\32 5\25 {
      margin: -0.375em 0 -1px -0.375em;
    }

    .\31 2u\28large\29, .\31 2u\24\28large\29 {
      width: 100%;
      clear: none;
      margin-left: 0;
    }

    .\31 1u\28large\29, .\31 1u\24\28large\29 {
      width: 91.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 0u\28large\29, .\31 0u\24\28large\29 {
      width: 83.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\39 u\28large\29, .\39 u\24\28large\29 {
      width: 75%;
      clear: none;
      margin-left: 0;
    }

    .\38 u\28large\29, .\38 u\24\28large\29 {
      width: 66.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\37 u\28large\29, .\37 u\24\28large\29 {
      width: 58.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\36 u\28large\29, .\36 u\24\28large\29 {
      width: 50%;
      clear: none;
      margin-left: 0;
    }

    .\35 u\28large\29, .\35 u\24\28large\29 {
      width: 41.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\34 u\28large\29, .\34 u\24\28large\29 {
      width: 33.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\33 u\28large\29, .\33 u\24\28large\29 {
      width: 25%;
      clear: none;
      margin-left: 0;
    }

    .\32 u\28large\29, .\32 u\24\28large\29 {
      width: 16.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 u\28large\29, .\31 u\24\28large\29 {
      width: 8.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\31 2u\24\28large\29 + *,
    .\31 1u\24\28large\29 + *,
    .\31 0u\24\28large\29 + *,
    .\39 u\24\28large\29 + *,
    .\38 u\24\28large\29 + *,
    .\37 u\24\28large\29 + *,
    .\36 u\24\28large\29 + *,
    .\35 u\24\28large\29 + *,
    .\34 u\24\28large\29 + *,
    .\33 u\24\28large\29 + *,
    .\32 u\24\28large\29 + *,
    .\31 u\24\28large\29 + * {
      clear: left;
    }

    .\-11u\28large\29 {
      margin-left: 91.66667%;
    }

    .\-10u\28large\29 {
      margin-left: 83.33333%;
    }

    .\-9u\28large\29 {
      margin-left: 75%;
    }

    .\-8u\28large\29 {
      margin-left: 66.66667%;
    }

    .\-7u\28large\29 {
      margin-left: 58.33333%;
    }

    .\-6u\28large\29 {
      margin-left: 50%;
    }

    .\-5u\28large\29 {
      margin-left: 41.66667%;
    }

    .\-4u\28large\29 {
      margin-left: 33.33333%;
    }

    .\-3u\28large\29 {
      margin-left: 25%;
    }

    .\-2u\28large\29 {
      margin-left: 16.66667%;
    }

    .\-1u\28large\29 {
      margin-left: 8.33333%;
    }

  }

  @media screen and (max-width: 980px) {

    .row > * {
      padding: 0 0 0 1.5em;
    }

    .row {
      margin: 0 0 -1px -1.5em;
    }

    .row.uniform > * {
      padding: 1.5em 0 0 1.5em;
    }

    .row.uniform {
      margin: -1.5em 0 -1px -1.5em;
    }

    .row.\32 00\25 > * {
      padding: 0 0 0 3em;
    }

    .row.\32 00\25 {
      margin: 0 0 -1px -3em;
    }

    .row.uniform.\32 00\25 > * {
      padding: 3em 0 0 3em;
    }

    .row.uniform.\32 00\25 {
      margin: -3em 0 -1px -3em;
    }

    .row.\31 50\25 > * {
      padding: 0 0 0 2.25em;
    }

    .row.\31 50\25 {
      margin: 0 0 -1px -2.25em;
    }

    .row.uniform.\31 50\25 > * {
      padding: 2.25em 0 0 2.25em;
    }

    .row.uniform.\31 50\25 {
      margin: -2.25em 0 -1px -2.25em;
    }

    .row.\35 0\25 > * {
      padding: 0 0 0 0.75em;
    }

    .row.\35 0\25 {
      margin: 0 0 -1px -0.75em;
    }

    .row.uniform.\35 0\25 > * {
      padding: 0.75em 0 0 0.75em;
    }

    .row.uniform.\35 0\25 {
      margin: -0.75em 0 -1px -0.75em;
    }

    .row.\32 5\25 > * {
      padding: 0 0 0 0.375em;
    }

    .row.\32 5\25 {
      margin: 0 0 -1px -0.375em;
    }

    .row.uniform.\32 5\25 > * {
      padding: 0.375em 0 0 0.375em;
    }

    .row.uniform.\32 5\25 {
      margin: -0.375em 0 -1px -0.375em;
    }

    .\31 2u\28medium\29, .\31 2u\24\28medium\29 {
      width: 100%;
      clear: none;
      margin-left: 0;
    }

    .\31 1u\28medium\29, .\31 1u\24\28medium\29 {
      width: 91.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 0u\28medium\29, .\31 0u\24\28medium\29 {
      width: 83.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\39 u\28medium\29, .\39 u\24\28medium\29 {
      width: 75%;
      clear: none;
      margin-left: 0;
    }

    .\38 u\28medium\29, .\38 u\24\28medium\29 {
      width: 66.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\37 u\28medium\29, .\37 u\24\28medium\29 {
      width: 58.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\36 u\28medium\29, .\36 u\24\28medium\29 {
      width: 50%;
      clear: none;
      margin-left: 0;
    }

    .\35 u\28medium\29, .\35 u\24\28medium\29 {
      width: 41.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\34 u\28medium\29, .\34 u\24\28medium\29 {
      width: 33.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\33 u\28medium\29, .\33 u\24\28medium\29 {
      width: 25%;
      clear: none;
      margin-left: 0;
    }

    .\32 u\28medium\29, .\32 u\24\28medium\29 {
      width: 16.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 u\28medium\29, .\31 u\24\28medium\29 {
      width: 8.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\31 2u\24\28medium\29 + *,
    .\31 1u\24\28medium\29 + *,
    .\31 0u\24\28medium\29 + *,
    .\39 u\24\28medium\29 + *,
    .\38 u\24\28medium\29 + *,
    .\37 u\24\28medium\29 + *,
    .\36 u\24\28medium\29 + *,
    .\35 u\24\28medium\29 + *,
    .\34 u\24\28medium\29 + *,
    .\33 u\24\28medium\29 + *,
    .\32 u\24\28medium\29 + *,
    .\31 u\24\28medium\29 + * {
      clear: left;
    }

    .\-11u\28medium\29 {
      margin-left: 91.66667%;
    }

    .\-10u\28medium\29 {
      margin-left: 83.33333%;
    }

    .\-9u\28medium\29 {
      margin-left: 75%;
    }

    .\-8u\28medium\29 {
      margin-left: 66.66667%;
    }

    .\-7u\28medium\29 {
      margin-left: 58.33333%;
    }

    .\-6u\28medium\29 {
      margin-left: 50%;
    }

    .\-5u\28medium\29 {
      margin-left: 41.66667%;
    }

    .\-4u\28medium\29 {
      margin-left: 33.33333%;
    }

    .\-3u\28medium\29 {
      margin-left: 25%;
    }

    .\-2u\28medium\29 {
      margin-left: 16.66667%;
    }

    .\-1u\28medium\29 {
      margin-left: 8.33333%;
    }

  }

  @media screen and (max-width: 736px) {

    .row > * {
      padding: 0 0 0 1.25em;
    }

    .row {
      margin: 0 0 -1px -1.25em;
    }

    .row.uniform > * {
      padding: 1.25em 0 0 1.25em;
    }

    .row.uniform {
      margin: -1.25em 0 -1px -1.25em;
    }

    .row.\32 00\25 > * {
      padding: 0 0 0 2.5em;
    }

    .row.\32 00\25 {
      margin: 0 0 -1px -2.5em;
    }

    .row.uniform.\32 00\25 > * {
      padding: 2.5em 0 0 2.5em;
    }

    .row.uniform.\32 00\25 {
      margin: -2.5em 0 -1px -2.5em;
    }

    .row.\31 50\25 > * {
      padding: 0 0 0 1.875em;
    }

    .row.\31 50\25 {
      margin: 0 0 -1px -1.875em;
    }

    .row.uniform.\31 50\25 > * {
      padding: 1.875em 0 0 1.875em;
    }

    .row.uniform.\31 50\25 {
      margin: -1.875em 0 -1px -1.875em;
    }

    .row.\35 0\25 > * {
      padding: 0 0 0 0.625em;
    }

    .row.\35 0\25 {
      margin: 0 0 -1px -0.625em;
    }

    .row.uniform.\35 0\25 > * {
      padding: 0.625em 0 0 0.625em;
    }

    .row.uniform.\35 0\25 {
      margin: -0.625em 0 -1px -0.625em;
    }

    .row.\32 5\25 > * {
      padding: 0 0 0 0.3125em;
    }

    .row.\32 5\25 {
      margin: 0 0 -1px -0.3125em;
    }

    .row.uniform.\32 5\25 > * {
      padding: 0.3125em 0 0 0.3125em;
    }

    .row.uniform.\32 5\25 {
      margin: -0.3125em 0 -1px -0.3125em;
    }

    .\31 2u\28small\29, .\31 2u\24\28small\29 {
      width: 100%;
      clear: none;
      margin-left: 0;
    }

    .\31 1u\28small\29, .\31 1u\24\28small\29 {
      width: 91.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 0u\28small\29, .\31 0u\24\28small\29 {
      width: 83.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\39 u\28small\29, .\39 u\24\28small\29 {
      width: 75%;
      clear: none;
      margin-left: 0;
    }

    .\38 u\28small\29, .\38 u\24\28small\29 {
      width: 66.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\37 u\28small\29, .\37 u\24\28small\29 {
      width: 58.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\36 u\28small\29, .\36 u\24\28small\29 {
      width: 50%;
      clear: none;
      margin-left: 0;
    }

    .\35 u\28small\29, .\35 u\24\28small\29 {
      width: 41.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\34 u\28small\29, .\34 u\24\28small\29 {
      width: 33.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\33 u\28small\29, .\33 u\24\28small\29 {
      width: 25%;
      clear: none;
      margin-left: 0;
    }

    .\32 u\28small\29, .\32 u\24\28small\29 {
      width: 16.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 u\28small\29, .\31 u\24\28small\29 {
      width: 8.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\31 2u\24\28small\29 + *,
    .\31 1u\24\28small\29 + *,
    .\31 0u\24\28small\29 + *,
    .\39 u\24\28small\29 + *,
    .\38 u\24\28small\29 + *,
    .\37 u\24\28small\29 + *,
    .\36 u\24\28small\29 + *,
    .\35 u\24\28small\29 + *,
    .\34 u\24\28small\29 + *,
    .\33 u\24\28small\29 + *,
    .\32 u\24\28small\29 + *,
    .\31 u\24\28small\29 + * {
      clear: left;
    }

    .\-11u\28small\29 {
      margin-left: 91.66667%;
    }

    .\-10u\28small\29 {
      margin-left: 83.33333%;
    }

    .\-9u\28small\29 {
      margin-left: 75%;
    }

    .\-8u\28small\29 {
      margin-left: 66.66667%;
    }

    .\-7u\28small\29 {
      margin-left: 58.33333%;
    }

    .\-6u\28small\29 {
      margin-left: 50%;
    }

    .\-5u\28small\29 {
      margin-left: 41.66667%;
    }

    .\-4u\28small\29 {
      margin-left: 33.33333%;
    }

    .\-3u\28small\29 {
      margin-left: 25%;
    }

    .\-2u\28small\29 {
      margin-left: 16.66667%;
    }

    .\-1u\28small\29 {
      margin-left: 8.33333%;
    }

  }

  @media screen and (max-width: 480px) {

    .row > * {
      padding: 0 0 0 1.25em;
    }

    .row {
      margin: 0 0 -1px -1.25em;
    }

    .row.uniform > * {
      padding: 1.25em 0 0 1.25em;
    }

    .row.uniform {
      margin: -1.25em 0 -1px -1.25em;
    }

    .row.\32 00\25 > * {
      padding: 0 0 0 2.5em;
    }

    .row.\32 00\25 {
      margin: 0 0 -1px -2.5em;
    }

    .row.uniform.\32 00\25 > * {
      padding: 2.5em 0 0 2.5em;
    }

    .row.uniform.\32 00\25 {
      margin: -2.5em 0 -1px -2.5em;
    }

    .row.\31 50\25 > * {
      padding: 0 0 0 1.875em;
    }

    .row.\31 50\25 {
      margin: 0 0 -1px -1.875em;
    }

    .row.uniform.\31 50\25 > * {
      padding: 1.875em 0 0 1.875em;
    }

    .row.uniform.\31 50\25 {
      margin: -1.875em 0 -1px -1.875em;
    }

    .row.\35 0\25 > * {
      padding: 0 0 0 0.625em;
    }

    .row.\35 0\25 {
      margin: 0 0 -1px -0.625em;
    }

    .row.uniform.\35 0\25 > * {
      padding: 0.625em 0 0 0.625em;
    }

    .row.uniform.\35 0\25 {
      margin: -0.625em 0 -1px -0.625em;
    }

    .row.\32 5\25 > * {
      padding: 0 0 0 0.3125em;
    }

    .row.\32 5\25 {
      margin: 0 0 -1px -0.3125em;
    }

    .row.uniform.\32 5\25 > * {
      padding: 0.3125em 0 0 0.3125em;
    }

    .row.uniform.\32 5\25 {
      margin: -0.3125em 0 -1px -0.3125em;
    }

    .\31 2u\28xsmall\29, .\31 2u\24\28xsmall\29 {
      width: 100%;
      clear: none;
      margin-left: 0;
    }

    .\31 1u\28xsmall\29, .\31 1u\24\28xsmall\29 {
      width: 91.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 0u\28xsmall\29, .\31 0u\24\28xsmall\29 {
      width: 83.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\39 u\28xsmall\29, .\39 u\24\28xsmall\29 {
      width: 75%;
      clear: none;
      margin-left: 0;
    }

    .\38 u\28xsmall\29, .\38 u\24\28xsmall\29 {
      width: 66.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\37 u\28xsmall\29, .\37 u\24\28xsmall\29 {
      width: 58.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\36 u\28xsmall\29, .\36 u\24\28xsmall\29 {
      width: 50%;
      clear: none;
      margin-left: 0;
    }

    .\35 u\28xsmall\29, .\35 u\24\28xsmall\29 {
      width: 41.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\34 u\28xsmall\29, .\34 u\24\28xsmall\29 {
      width: 33.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\33 u\28xsmall\29, .\33 u\24\28xsmall\29 {
      width: 25%;
      clear: none;
      margin-left: 0;
    }

    .\32 u\28xsmall\29, .\32 u\24\28xsmall\29 {
      width: 16.6666666667%;
      clear: none;
      margin-left: 0;
    }

    .\31 u\28xsmall\29, .\31 u\24\28xsmall\29 {
      width: 8.3333333333%;
      clear: none;
      margin-left: 0;
    }

    .\31 2u\24\28xsmall\29 + *,
    .\31 1u\24\28xsmall\29 + *,
    .\31 0u\24\28xsmall\29 + *,
    .\39 u\24\28xsmall\29 + *,
    .\38 u\24\28xsmall\29 + *,
    .\37 u\24\28xsmall\29 + *,
    .\36 u\24\28xsmall\29 + *,
    .\35 u\24\28xsmall\29 + *,
    .\34 u\24\28xsmall\29 + *,
    .\33 u\24\28xsmall\29 + *,
    .\32 u\24\28xsmall\29 + *,
    .\31 u\24\28xsmall\29 + * {
      clear: left;
    }

    .\-11u\28xsmall\29 {
      margin-left: 91.66667%;
    }

    .\-10u\28xsmall\29 {
      margin-left: 83.33333%;
    }

    .\-9u\28xsmall\29 {
      margin-left: 75%;
    }

    .\-8u\28xsmall\29 {
      margin-left: 66.66667%;
    }

    .\-7u\28xsmall\29 {
      margin-left: 58.33333%;
    }

    .\-6u\28xsmall\29 {
      margin-left: 50%;
    }

    .\-5u\28xsmall\29 {
      margin-left: 41.66667%;
    }

    .\-4u\28xsmall\29 {
      margin-left: 33.33333%;
    }

    .\-3u\28xsmall\29 {
      margin-left: 25%;
    }

    .\-2u\28xsmall\29 {
      margin-left: 16.66667%;
    }

    .\-1u\28xsmall\29 {
      margin-left: 8.33333%;
    }

  }

/* Basic */

  @-ms-viewport {
    width: device-width;
  }

  body {
    -ms-overflow-style: scrollbar;
  }

  @media screen and (max-width: 480px) {

    html, body {
      min-width: 320px;
    }

  }

  body {
    background: #fff;
  }

    body.is-loading *, body.is-loading *:before, body.is-loading *:after {
      -moz-animation: none !important;
      -webkit-animation: none !important;
      -ms-animation: none !important;
      animation: none !important;
      -moz-transition: none !important;
      -webkit-transition: none !important;
      -ms-transition: none !important;
      transition: none !important;
    }


  
/* Section/Article */

  section.special, article.special, header.special {
    text-align: center;
  }

  header p {
    margin: 0 0 1.5em 0;
    position: relative;
    text-transform: uppercase;
  }

  header h2 + p {
    font-size: 1.25em;
    margin-top: -1em;
    line-height: 1.85em;
  }

  header h3 + p {
    font-size: 1.1em;
    margin-top: -0.8em;
    line-height: 1.5em;
  }

  header h4 + p,
  header h5 + p,
  header h6 + p {
    font-size: 0.9em;
    margin-top: -0.6em;
    line-height: 1.5em;
  }

  header.major {
    margin-bottom: 4em;
  }

    header.major h2 {
      font-size: 2.5em;
    }

  header.narrow {
    max-width: 60%;
    margin-left: auto;
    margin-right: auto;
  }

  @media screen and (max-width: 1280px) {

    header.narrow {
      max-width: 75%;
    }

  }

  @media screen and (max-width: 980px) {

    header.narrow {
      max-width: 100%;
    }

    header.major {
      margin-bottom: 2em;
    }

      header.major h2 {
        font-size: 2em;
      }

  }

  @media screen and (max-width: 736px) {

    header.major h2 {
      font-size: 1.5em;
    }

    header.major p {
      font-size: 1em;
    }

  }

  header p {
    color: #25383B;
  }

/* Form */

  form {
    margin: 0 0 2em 0;
  }

    form ul.actions {
      margin-top: 4em;
    }

    @media screen and (max-width: 736px) {

      form ul.actions {
        margin-top: 2em;
      }

    }

  label {
    display: block;
    font-size: 0.9em;
    font-weight: 700;
    margin: 0 0 1em 0;
  }

  input[type="text"],
  input[type="password"],
  input[type="email"],
  select,
  textarea {
    -moz-appearance: none;
    -webkit-appearance: none;
    -ms-appearance: none;
    appearance: none;
    border-radius: 4px;
    border-style: solid;
    border-width: 1px;
    display: block;
    outline: 0;
    padding: 0 1em;
    text-decoration: none;
    width: 100%;
  }

    input[type="text"]:invalid,
    input[type="password"]:invalid,
    input[type="email"]:invalid,
    select:invalid,
    textarea:invalid {
      box-shadow: none;
    }

  .select-wrapper {
    text-decoration: none;
    display: block;
    position: relative;
  }

    .select-wrapper:before {
      content: "";
      -moz-osx-font-smoothing: grayscale;
      -webkit-font-smoothing: antialiased;
      font-family: FontAwesome;
      font-style: normal;
      font-weight: normal;
      text-transform: none !important;
    }

    .select-wrapper:before {
      display: block;
      height: 3.5em;
      line-height: 3.5em;
      pointer-events: none;
      position: absolute;
      right: 0;
      text-align: center;
      top: 0;
      width: 3.5em;
    }

    .select-wrapper select::-ms-expand {
      display: none;
    }

  input[type="text"],
  input[type="password"],
  input[type="email"],
  select {
    height: 3.5em;
  }

  textarea {
    padding: 0.75em 1em;
  }

  input[type="checkbox"],
  input[type="radio"] {
    -moz-appearance: none;
    -webkit-appearance: none;
    -ms-appearance: none;
    appearance: none;
    display: block;
    float: left;
    margin-right: -2em;
    opacity: 0;
    width: 1em;
    z-index: -1;
  }

    input[type="checkbox"] + label,
    input[type="radio"] + label {
      text-decoration: none;
      cursor: pointer;
      display: inline-block;
      font-size: 1em;
      font-weight: 400;
      padding-left: 2.85em;
      padding-right: 0.75em;
      position: relative;
    }

      input[type="checkbox"] + label:before,
      input[type="radio"] + label:before {
        -moz-osx-font-smoothing: grayscale;
        -webkit-font-smoothing: antialiased;
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-transform: none !important;
      }

      input[type="checkbox"] + label:before,
      input[type="radio"] + label:before {
        border-radius: 4px;
        border-style: solid;
        border-width: 1px;
        content: '';
        display: inline-block;
        height: 2.1em;
        left: 0;
        line-height: 2.0125em;
        position: absolute;
        text-align: center;
        top: 0;
        width: 2.1em;
      }

    input[type="checkbox"]:checked + label:before,
    input[type="radio"]:checked + label:before {
      content: '\f00c';
    }

  input[type="checkbox"] + label:before {
    border-radius: 4px;
  }

  input[type="radio"] + label:before {
    border-radius: 100%;
  }

  ::-webkit-input-placeholder {
    opacity: 1.0;
  }

  :-moz-placeholder {
    opacity: 1.0;
  }

  ::-moz-placeholder {
    opacity: 1.0;
  }

  :-ms-input-placeholder {
    opacity: 1.0;
  }

  .formerize-placeholder {
    opacity: 1.0;
  }

  label {
    color: #25383B;
  }

  input[type="text"],
  input[type="password"],
  input[type="email"],
  select,
  textarea {
    background-color: rgba(144, 144, 144, 0.075);
    border-color: rgba(144, 144, 144, 0.25);
    color: inherit;
  }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus,
    select:focus,
    textarea:focus {
      border-color: #ff5757;
      box-shadow: 0 0 0 1px #ff5757;
    }

  .select-wrapper:before {
    color: rgba(144, 144, 144, 0.25);
  }

  input[type="checkbox"] + label,
  input[type="radio"] + label {
    color: #777;
  }

    input[type="checkbox"] + label:before,
    input[type="radio"] + label:before {
      background-color: rgba(144, 144, 144, 0.075);
      border-color: rgba(144, 144, 144, 0.25);
    }

  input[type="checkbox"]:checked + label:before,
  input[type="radio"]:checked + label:before {
    background-color: rgba(144, 144, 144, 0.075);
    border-color: #ff5757;
    color: #25383B;
  }

  input[type="checkbox"]:focus + label:before,
  input[type="radio"]:focus + label:before {
    border-color: #ff5757;
    box-shadow: 0 0 0 1px #ff5757;
  }

  ::-webkit-input-placeholder {
    color: #999 !important;
  }

  :-moz-placeholder {
    color: #999 !important;
  }

  ::-moz-placeholder {
    color: #999 !important;
  }

  :-ms-input-placeholder {
    color: #999 !important;
  }

  .formerize-placeholder {
    color: #999 !important;
  }

  form.alt input[type="text"],
  form.alt input[type="password"],
  form.alt input[type="email"],
  form.alt select,
  form.alt textarea {
    background-color: transparent;
  }

/* Box */

  .box {
    border-radius: 4px;
    border-style: solid;
    border-width: 1px;
    margin-bottom: 2em;
    padding: 1.5em;
  }

    .box > :last-child,
    .box > :last-child > :last-child,
    .box > :last-child > :last-child > :last-child {
      margin-bottom: 0;
    }

    .box.alt {
      border: 0;
      border-radius: 0;
      padding: 0;
    }

  .box {
    border-color: rgba(144, 144, 144, 0.25);
  }

/* Icon */

  .icon {
    text-decoration: none;
    border-bottom: none;
    position: relative;
  }

    .icon:before {
      -moz-osx-font-smoothing: grayscale;
      -webkit-font-smoothing: antialiased;
      font-family: FontAwesome;
      font-style: normal;
      font-weight: normal;
      text-transform: none !important;
    }

    .icon > .label {
      display: none;
    }

/* Image */

  .image {
    border-radius: 0;
    border: 0;
    display: inline-block;
    position: relative;
  }

    .image img {
      border-radius: 0;
      display: block;
    }

    .image.left, .image.right {
      max-width: 40%;
    }

      .image.left img, .image.right img {
        width: 100%;
      }

    .image.left {
      float: left;
      padding: 0 1.5em 1em 0;
      top: 0.25em;
    }

    .image.right {
      float: right;
      padding: 0 0 1em 1.5em;
      top: 0.25em;
    }

    .image.fit {
      display: block;
      margin: 0 0 2em 0;
      width: 100%;
    }

      .image.fit img {
        width: 100%;
      }

    .image.main {
      display: block;
      margin: 0 0 3em 0;
      width: 100%;
    }

      .image.main img {
        width: 100%;
      }

/* List */

  ol {
    list-style: decimal;
    margin: 0 0 2em 0;
    padding-left: 1.25em;
  }

    ol li {
      padding-left: 0.25em;
    }

  ul {
    list-style: disc;
    margin: 0 0 2em 0;
    padding-left: 1em;
  }


    ul.alt {
      list-style: none;
      padding-left: 0;
    }

      ul.alt > li {
        border-top-style: solid;
        border-top-width: 1px;
        padding: 0.5em 0;
      }

        ul.alt > li:first-child {
          border-top: 0;
          padding-top: 0;
        }

    ul.icons {
      cursor: default;
      list-style: none;
      padding-left: 0;
    }

      ul.icons > li {
        display: inline-block;
        padding: 0 1em 0 0;
      }

        ul.icons > li:last-child {
          padding-right: 0;
        }

        ul.icons > li .icon:before {
          font-size: 2em;
        }

    ul.actions {
      cursor: default;
      list-style: none;
      padding-left: 0;
    }

      ul.actions > li {
        display: inline-block;
        padding: 0 1em 0 0;
        vertical-align: middle;
      }

        ul.actions > li:last-child {
          padding-right: 0;
        }

      ul.actions.small > li {
        padding: 0 0.5em 0 0;
      }

      ul.actions.vertical > li {
        display: block;
        padding: 1em 0 0 0;
      }

        ul.actions.vertical > li:first-child {
          padding-top: 0;
        }

        ul.actions.vertical > li > * {
          margin-bottom: 0;
        }

      ul.actions.vertical.small > li {
        padding: 0.5em 0 0 0;
      }

        ul.actions.vertical.small > li:first-child {
          padding-top: 0;
        }

      ul.actions.fit {
        display: table;
        margin-left: -1em;
        padding: 0;
        table-layout: fixed;
        width: calc(100% + 1em);
      }

        ul.actions.fit > li {
          display: table-cell;
          padding: 0 0 0 1em;
        }

          ul.actions.fit > li > * {
            margin-bottom: 0;
          }

        ul.actions.fit.small {
          margin-left: -0.5em;
          width: calc(100% + 0.5em);
        }

          ul.actions.fit.small > li {
            padding: 0 0 0 0.5em;
          }

      @media screen and (max-width: 480px) {

        ul.actions {
          margin: 0 0 2em 0;
        }

          ul.actions > li {
            padding: 1em 0 0 0;
            display: block;
            text-align: center;
            width: 100%;
          }

            ul.actions > li:first-child {
              padding-top: 0;
            }

            ul.actions > li > * {
              width: 100%;
              margin: 0 !important;
            }

              ul.actions > li > *.icon:before {
                margin-left: -2em;
              }

          ul.actions.small > li {
            padding: 0.5em 0 0 0;
          }

            ul.actions.small > li:first-child {
              padding-top: 0;
            }

      }

  dl {
    margin: 0 0 2em 0;
  }

    dl > dt {
      display: block;
      font-weight: 700;
      margin: 0 0 1em 0;
    }

    dl > dd {
      margin-left: 2em;
    }

  ul.alt > li {
    border-top-color: rgba(144, 144, 144, 0.25);
  }

/* Table */

  .table-wrapper {
    -webkit-overflow-scrolling: touch;
    overflow-x: auto;
  }

  table {
    margin: 0 0 2em 0;
    width: 100%;
  }

    table tbody tr {
      border-style: solid;
      border-width: 1px;
      border-left: 0;
      border-right: 0;
    }

    table td {
      padding: 0.75em 0.75em;
    }

    table th {
      font-size: 0.9em;
      font-weight: 700;
      padding: 0 0.75em 0.75em 0.75em;
      text-align: left;
    }

    table thead {
      border-bottom-style: solid;
      border-bottom-width: 2px;
    }

    table tfoot {
      border-top-style: solid;
      border-top-width: 2px;
    }

    table.alt {
      border-collapse: separate;
    }

      table.alt tbody tr td {
        border-style: solid;
        border-width: 1px;
        border-left-width: 0;
        border-top-width: 0;
      }

        table.alt tbody tr td:first-child {
          border-left-width: 1px;
        }

      table.alt tbody tr:first-child td {
        border-top-width: 1px;
      }

      table.alt thead {
        border-bottom: 0;
      }

      table.alt tfoot {
        border-top: 0;
      }

  table tbody tr {
    border-color: rgba(144, 144, 144, 0.25);
  }

    table tbody tr:nth-child(2n + 1) {
      background-color: rgba(144, 144, 144, 0.075);
    }

  table th {
    color: #25383B;
  }

  table thead {
    border-bottom-color: rgba(144, 144, 144, 0.25);
  }

  table tfoot {
    border-top-color: rgba(144, 144, 144, 0.25);
  }

  table.alt tbody tr td {
    border-color: rgba(144, 144, 144, 0.25);
  }

/* Button */

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
    background-color: #25383B;
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
      background-color: #8f1822;
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
        background-color: rgba(255,87,87,0.65);
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

/* Feature */

  .feature {
    display: -moz-flex;
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    -moz-align-items: center;
    -webkit-align-items: center;
    -ms-align-items: center;
    align-items: center;
    margin-bottom: 6em;
  }

    .feature:last-child {
      margin-bottom: 2em;
    }

    .feature.left {
      -moz-flex-direction: row;
      -webkit-flex-direction: row;
      -ms-flex-direction: row;
      flex-direction: row;
    }

    .feature.right {
      -moz-flex-direction: row-reverse;
      -webkit-flex-direction: row-reverse;
      -ms-flex-direction: row-reverse;
      flex-direction: row-reverse;
    }

    .feature .image {
      width: 48%;
    }

      .feature .image img {
        max-width: 100%;
      }

    .feature .content {
      padding: 2em 3em 0.1em 3em;
      width: 52%;
    }

    @media screen and (max-width: 1280px) {

      .feature {
        margin-bottom: 4em;
      }

        .feature .content {
          padding: 1em 2em 0.1em 2em;
        }

    }

    @media screen and (max-width: 980px) {

      .feature.left, .feature.right {
        -moz-flex-direction: column;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
      }

      .feature .image {
        width: 100%;
      }

        .feature .image img {
          width: 100%;
        }

      .feature .content {
        padding: 2em 2em 0.1em 2em;
        width: 100%;
      }

    }

    @media screen and (max-width: 736px) {

      .feature {
        margin-bottom: 2em;
      }

        .feature .content {
          padding: 2em 1em 0.1em 1em;
        }

    }

  .feature {
    background-color: rgba(144, 144, 144, 0.075);
  }

/* Image Grid */

  .image-grid {
    display: -moz-flex;
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    -moz-flex-wrap: wrap;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-bottom: 4em;
  }

    .image-grid .image {
      margin: 0;
      width: 25%;
    }

      .image-grid .image img {
        width: 100%;
      }

    @media screen and (max-width: 980px) {

      .image-grid {
        margin-bottom: 3em;
      }

        .image-grid .image {
          width: 50%;
        }

    }

    @media screen and (max-width: 480px) {

      .image-grid {
        margin-bottom: 2em;
      }

        .image-grid .image {
          width: 100%;
        }

    }

/* Wrapper */

  .wrapper {
    padding: 8em 0 6em 0;
    position: relative;
  }

    .wrapper > .inner {
      margin: 0 auto;
      width: 70em;
    }

    .wrapper.style1 {
      background-color: #EEE;
      color: #777;
    }

      .wrapper.style1 input, .wrapper.style1 select, .wrapper.style1 textarea {
        color: #555;
      }

      .wrapper.style1 a {
        color: #ff5757;
      }

      .wrapper.style1 strong, .wrapper.style1 b {
        color: #555;
      }

      .wrapper.style1 h1, .wrapper.style1 h2, .wrapper.style1 h3, .wrapper.style1 h4, .wrapper.style1 h5, .wrapper.style1 h6 {
        color: #555;
      }

      .wrapper.style1 blockquote {
        border-left-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 code {
        background: #fff;
        border-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 hr {
        border-bottom-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 header p {
        color: #555;
      }

      .wrapper.style1 .feature {
        background-color: #fff;
      }

      .wrapper.style1 label {
        color: #555;
      }

      .wrapper.style1 input[type="text"],
      .wrapper.style1 input[type="password"],
      .wrapper.style1 input[type="email"],
      .wrapper.style1 select,
      .wrapper.style1 textarea {
        background-color: #fff;
        border-color: rgba(144, 144, 144, 0.25);
        color: inherit;
      }

        .wrapper.style1 input[type="text"]:focus,
        .wrapper.style1 input[type="password"]:focus,
        .wrapper.style1 input[type="email"]:focus,
        .wrapper.style1 select:focus,
        .wrapper.style1 textarea:focus {
          border-color: #ff5757;
          box-shadow: 0 0 0 1px #ff5757;
        }

      .wrapper.style1 .select-wrapper:before {
        color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 input[type="checkbox"] + label,
      .wrapper.style1 input[type="radio"] + label {
        color: #777;
      }

        .wrapper.style1 input[type="checkbox"] + label:before,
        .wrapper.style1 input[type="radio"] + label:before {
          background-color: #fff;
          border-color: rgba(144, 144, 144, 0.25);
        }

      .wrapper.style1 input[type="checkbox"]:checked + label:before,
      .wrapper.style1 input[type="radio"]:checked + label:before {
        background-color: #fff;
        border-color: #ff5757;
        color: #555;
      }

      .wrapper.style1 input[type="checkbox"]:focus + label:before,
      .wrapper.style1 input[type="radio"]:focus + label:before {
        border-color: #ff5757;
        box-shadow: 0 0 0 1px #ff5757;
      }

      .wrapper.style1 ::-webkit-input-placeholder {
        color: #bbb !important;
      }

      .wrapper.style1 :-moz-placeholder {
        color: #bbb !important;
      }

      .wrapper.style1 ::-moz-placeholder {
        color: #bbb !important;
      }

      .wrapper.style1 :-ms-input-placeholder {
        color: #bbb !important;
      }

      .wrapper.style1 .formerize-placeholder {
        color: #bbb !important;
      }

      .wrapper.style1 form.alt input[type="text"],
      .wrapper.style1 form.alt input[type="password"],
      .wrapper.style1 form.alt input[type="email"],
      .wrapper.style1 form.alt select,
      .wrapper.style1 form.alt textarea {
        background-color: transparent;
      }

      .wrapper.style1 ul.alt > li {
        border-top-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 table tbody tr {
        border-color: rgba(144, 144, 144, 0.25);
      }

        .wrapper.style1 table tbody tr:nth-child(2n + 1) {
          background-color: #fff;
        }

      .wrapper.style1 table th {
        color: #555;
      }

      .wrapper.style1 table thead {
        border-bottom-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 table tfoot {
        border-top-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 table.alt tbody tr td {
        border-color: rgba(144, 144, 144, 0.25);
      }

      .wrapper.style1 input[type="submit"],
      .wrapper.style1 input[type="reset"],
      .wrapper.style1 input[type="button"],
      .wrapper.style1 button,
      .wrapper.style1 .button {
        background-color: #555;
        box-shadow: none;
        color: #EEE !important;
      }

        .wrapper.style1 input[type="submit"].icon:before,
        .wrapper.style1 input[type="reset"].icon:before,
        .wrapper.style1 input[type="button"].icon:before,
        .wrapper.style1 button.icon:before,
        .wrapper.style1 .button.icon:before {
          color: #bbb;
        }

        .wrapper.style1 input[type="submit"]:hover,
        .wrapper.style1 input[type="reset"]:hover,
        .wrapper.style1 input[type="button"]:hover,
        .wrapper.style1 button:hover,
        .wrapper.style1 .button:hover {
          background-color: #626262;
        }

        .wrapper.style1 input[type="submit"]:active,
        .wrapper.style1 input[type="reset"]:active,
        .wrapper.style1 input[type="button"]:active,
        .wrapper.style1 button:active,
        .wrapper.style1 .button:active {
          background-color: #484848;
        }

        .wrapper.style1 input[type="submit"].special,
        .wrapper.style1 input[type="reset"].special,
        .wrapper.style1 input[type="button"].special,
        .wrapper.style1 button.special,
        .wrapper.style1 .button.special {
          background-color: #ff5757;
          box-shadow: none;
          color: #fff !important;
        }

          .wrapper.style1 input[type="submit"].special:hover,
          .wrapper.style1 input[type="reset"].special:hover,
          .wrapper.style1 input[type="button"].special:hover,
          .wrapper.style1 button.special:hover,
          .wrapper.style1 .button.special:hover {
            background-color: rgba(255,87,87,0.65);
          }

          .wrapper.style1 input[type="submit"].special:active,
          .wrapper.style1 input[type="reset"].special:active,
          .wrapper.style1 input[type="button"].special:active,
          .wrapper.style1 button.special:active,
          .wrapper.style1 .button.special:active {
            background-color: #45ad97;
          }

        .wrapper.style1 input[type="submit"].alt,
        .wrapper.style1 input[type="reset"].alt,
        .wrapper.style1 input[type="button"].alt,
        .wrapper.style1 button.alt,
        .wrapper.style1 .button.alt {
          background-color: transparent;
          box-shadow: inset 0 0 0 2px #ff5757;
          color: #ff5757 !important;
        }

          .wrapper.style1 input[type="submit"].alt:hover,
          .wrapper.style1 input[type="reset"].alt:hover,
          .wrapper.style1 input[type="button"].alt:hover,
          .wrapper.style1 button.alt:hover,
          .wrapper.style1 .button.alt:hover {
            background-color: #fff;
          }

          .wrapper.style1 input[type="submit"].alt:active,
          .wrapper.style1 input[type="reset"].alt:active,
          .wrapper.style1 input[type="button"].alt:active,
          .wrapper.style1 button.alt:active,
          .wrapper.style1 .button.alt:active {
            background-color: rgba(144, 144, 144, 0.2);
          }

    .wrapper.style2 {
      background-color: #1E2832;
      color: rgba(255, 255, 255, 0.75);
    }

      .wrapper.style2 input, .wrapper.style2 select, .wrapper.style2 textarea {
        color: #fff;
      }

      .wrapper.style2 a {
        color: #ff5757;
      }

      .wrapper.style2 strong, .wrapper.style2 b {
        color: #fff;
      }

      .wrapper.style2 h1, .wrapper.style2 h2, .wrapper.style2 h3, .wrapper.style2 h4, .wrapper.style2 h5, .wrapper.style2 h6 {
        color: #fff;
      }

      .wrapper.style2 blockquote {
        border-left-color: transparent;
      }

      .wrapper.style2 code {
        background: rgba(255, 255, 255, 0.05);
        border-color: transparent;
      }

      .wrapper.style2 hr {
        border-bottom-color: transparent;
      }

      .wrapper.style2 header p {
        color: #fff;
      }

      .wrapper.style2 .feature {
        background-color: rgba(255, 255, 255, 0.05);
      }

      .wrapper.style2 label {
        color: #fff;
      }

      .wrapper.style2 input[type="text"],
      .wrapper.style2 input[type="password"],
      .wrapper.style2 input[type="email"],
      .wrapper.style2 select,
      .wrapper.style2 textarea {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: transparent;
        color: inherit;
      }

        .wrapper.style2 input[type="text"]:focus,
        .wrapper.style2 input[type="password"]:focus,
        .wrapper.style2 input[type="email"]:focus,
        .wrapper.style2 select:focus,
        .wrapper.style2 textarea:focus {
          border-color: #ff5757;
          box-shadow: 0 0 0 1px #ff5757;
        }

      .wrapper.style2 .select-wrapper:before {
        color: transparent;
      }

      .wrapper.style2 input[type="checkbox"] + label,
      .wrapper.style2 input[type="radio"] + label {
        color: rgba(255, 255, 255, 0.75);
      }

        .wrapper.style2 input[type="checkbox"] + label:before,
        .wrapper.style2 input[type="radio"] + label:before {
          background-color: rgba(255, 255, 255, 0.05);
          border-color: transparent;
        }

      .wrapper.style2 input[type="checkbox"]:checked + label:before,
      .wrapper.style2 input[type="radio"]:checked + label:before {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: #ff5757;
        color: #fff;
      }

      .wrapper.style2 input[type="checkbox"]:focus + label:before,
      .wrapper.style2 input[type="radio"]:focus + label:before {
        border-color: #ff5757;
        box-shadow: 0 0 0 1px #ff5757;
      }

      .wrapper.style2 ::-webkit-input-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style2 :-moz-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style2 ::-moz-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style2 :-ms-input-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style2 .formerize-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style2 form.alt input[type="text"],
      .wrapper.style2 form.alt input[type="password"],
      .wrapper.style2 form.alt input[type="email"],
      .wrapper.style2 form.alt select,
      .wrapper.style2 form.alt textarea {
        background-color: transparent;
      }

      .wrapper.style2 ul.alt > li {
        border-top-color: transparent;
      }

      .wrapper.style2 table tbody tr {
        border-color: transparent;
      }

        .wrapper.style2 table tbody tr:nth-child(2n + 1) {
          background-color: rgba(255, 255, 255, 0.05);
        }

      .wrapper.style2 table th {
        color: #fff;
      }

      .wrapper.style2 table thead {
        border-bottom-color: transparent;
      }

      .wrapper.style2 table tfoot {
        border-top-color: transparent;
      }

      .wrapper.style2 table.alt tbody tr td {
        border-color: transparent;
      }

      .wrapper.style2 input[type="submit"],
      .wrapper.style2 input[type="reset"],
      .wrapper.style2 input[type="button"],
      .wrapper.style2 button,
      .wrapper.style2 .button {
        background-color: #fff;
        box-shadow: none;
        color: #1E2832 !important;
      }

        .wrapper.style2 input[type="submit"].icon:before,
        .wrapper.style2 input[type="reset"].icon:before,
        .wrapper.style2 input[type="button"].icon:before,
        .wrapper.style2 button.icon:before,
        .wrapper.style2 .button.icon:before {
          color: #a5a9ad;
        }

        .wrapper.style2 input[type="submit"]:hover,
        .wrapper.style2 input[type="reset"]:hover,
        .wrapper.style2 input[type="button"]:hover,
        .wrapper.style2 button:hover,
        .wrapper.style2 .button:hover {
          background-color: white;
        }

        .wrapper.style2 input[type="submit"]:active,
        .wrapper.style2 input[type="reset"]:active,
        .wrapper.style2 input[type="button"]:active,
        .wrapper.style2 button:active,
        .wrapper.style2 .button:active {
          background-color: #f2f2f2;
        }

        .wrapper.style2 input[type="submit"].special,
        .wrapper.style2 input[type="reset"].special,
        .wrapper.style2 input[type="button"].special,
        .wrapper.style2 button.special,
        .wrapper.style2 .button.special {
          background-color: #ff5757;
          box-shadow: none;
          color: #fff !important;
        }

          .wrapper.style2 input[type="submit"].special:hover,
          .wrapper.style2 input[type="reset"].special:hover,
          .wrapper.style2 input[type="button"].special:hover,
          .wrapper.style2 button.special:hover,
          .wrapper.style2 .button.special:hover {
            background-color: rgba(255,87,87,0.65);
          }

          .wrapper.style2 input[type="submit"].special:active,
          .wrapper.style2 input[type="reset"].special:active,
          .wrapper.style2 input[type="button"].special:active,
          .wrapper.style2 button.special:active,
          .wrapper.style2 .button.special:active {
            background-color: #45ad97;
          }

        .wrapper.style2 input[type="submit"].alt,
        .wrapper.style2 input[type="reset"].alt,
        .wrapper.style2 input[type="button"].alt,
        .wrapper.style2 button.alt,
        .wrapper.style2 .button.alt {
          background-color: transparent;
          box-shadow: inset 0 0 0 2px #fff;
          color: #fff !important;
        }

          .wrapper.style2 input[type="submit"].alt:hover,
          .wrapper.style2 input[type="reset"].alt:hover,
          .wrapper.style2 input[type="button"].alt:hover,
          .wrapper.style2 button.alt:hover,
          .wrapper.style2 .button.alt:hover {
            background-color: rgba(255, 255, 255, 0.05);
          }

          .wrapper.style2 input[type="submit"].alt:active,
          .wrapper.style2 input[type="reset"].alt:active,
          .wrapper.style2 input[type="button"].alt:active,
          .wrapper.style2 button.alt:active,
          .wrapper.style2 .button.alt:active {
            background-color: rgba(255, 255, 255, 0.1);
          }

    .wrapper.style3 {
      background-color: #1E2832;
      color: rgba(255, 255, 255, 0.75);
      background-attachment: fixed;
      background-image: url("<?php echo get_template_directory_uri(); ?>/templates-pages/images/overlay.png"), url("../../images/pic11.jpg");
      background-size: cover;
    }

      .wrapper.style3 input, .wrapper.style3 select, .wrapper.style3 textarea {
        color: #fff;
      }

      .wrapper.style3 a {
        color: #ff5757;
      }

      .wrapper.style3 strong, .wrapper.style3 b {
        color: #fff;
      }

      .wrapper.style3 h1, .wrapper.style3 h2, .wrapper.style3 h3, .wrapper.style3 h4, .wrapper.style3 h5, .wrapper.style3 h6 {
        color: #fff;
      }

      .wrapper.style3 blockquote {
        border-left-color: transparent;
      }

      .wrapper.style3 code {
        background: rgba(255, 255, 255, 0.05);
        border-color: transparent;
      }

      .wrapper.style3 hr {
        border-bottom-color: transparent;
      }

      .wrapper.style3 header p {
        color: #fff;
      }

      .wrapper.style3 .feature {
        background-color: rgba(255, 255, 255, 0.05);
      }

      .wrapper.style3 label {
        color: #fff;
      }

      .wrapper.style3 input[type="text"],
      .wrapper.style3 input[type="password"],
      .wrapper.style3 input[type="email"],
      .wrapper.style3 select,
      .wrapper.style3 textarea {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: transparent;
        color: inherit;
      }

        .wrapper.style3 input[type="text"]:focus,
        .wrapper.style3 input[type="password"]:focus,
        .wrapper.style3 input[type="email"]:focus,
        .wrapper.style3 select:focus,
        .wrapper.style3 textarea:focus {
          border-color: #ff5757;
          box-shadow: 0 0 0 1px #ff5757;
        }

      .wrapper.style3 .select-wrapper:before {
        color: transparent;
      }

      .wrapper.style3 input[type="checkbox"] + label,
      .wrapper.style3 input[type="radio"] + label {
        color: rgba(255, 255, 255, 0.75);
      }

        .wrapper.style3 input[type="checkbox"] + label:before,
        .wrapper.style3 input[type="radio"] + label:before {
          background-color: rgba(255, 255, 255, 0.05);
          border-color: transparent;
        }

      .wrapper.style3 input[type="checkbox"]:checked + label:before,
      .wrapper.style3 input[type="radio"]:checked + label:before {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: #ff5757;
        color: #fff;
      }

      .wrapper.style3 input[type="checkbox"]:focus + label:before,
      .wrapper.style3 input[type="radio"]:focus + label:before {
        border-color: #ff5757;
        box-shadow: 0 0 0 1px #ff5757;
      }

      .wrapper.style3 ::-webkit-input-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style3 :-moz-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style3 ::-moz-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style3 :-ms-input-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style3 .formerize-placeholder {
        color: #a5a9ad !important;
      }

      .wrapper.style3 form.alt input[type="text"],
      .wrapper.style3 form.alt input[type="password"],
      .wrapper.style3 form.alt input[type="email"],
      .wrapper.style3 form.alt select,
      .wrapper.style3 form.alt textarea {
        background-color: transparent;
      }

      .wrapper.style3 ul.alt > li {
        border-top-color: transparent;
      }

      .wrapper.style3 table tbody tr {
        border-color: transparent;
      }

        .wrapper.style3 table tbody tr:nth-child(2n + 1) {
          background-color: rgba(255, 255, 255, 0.05);
        }

      .wrapper.style3 table th {
        color: #fff;
      }

      .wrapper.style3 table thead {
        border-bottom-color: transparent;
      }

      .wrapper.style3 table tfoot {
        border-top-color: transparent;
      }

      .wrapper.style3 table.alt tbody tr td {
        border-color: transparent;
      }

      .wrapper.style3 input[type="submit"],
      .wrapper.style3 input[type="reset"],
      .wrapper.style3 input[type="button"],
      .wrapper.style3 button,
      .wrapper.style3 .button {
        background-color: #fff;
        box-shadow: none;
        color: #1E2832 !important;
      }

        .wrapper.style3 input[type="submit"].icon:before,
        .wrapper.style3 input[type="reset"].icon:before,
        .wrapper.style3 input[type="button"].icon:before,
        .wrapper.style3 button.icon:before,
        .wrapper.style3 .button.icon:before {
          color: #a5a9ad;
        }

        .wrapper.style3 input[type="submit"]:hover,
        .wrapper.style3 input[type="reset"]:hover,
        .wrapper.style3 input[type="button"]:hover,
        .wrapper.style3 button:hover,
        .wrapper.style3 .button:hover {
          background-color: white;
        }

        .wrapper.style3 input[type="submit"]:active,
        .wrapper.style3 input[type="reset"]:active,
        .wrapper.style3 input[type="button"]:active,
        .wrapper.style3 button:active,
        .wrapper.style3 .button:active {
          background-color: #f2f2f2;
        }

        .wrapper.style3 input[type="submit"].special,
        .wrapper.style3 input[type="reset"].special,
        .wrapper.style3 input[type="button"].special,
        .wrapper.style3 button.special,
        .wrapper.style3 .button.special {
          background-color: #ff5757;
          box-shadow: none;
          color: #fff !important;
        }

          .wrapper.style3 input[type="submit"].special:hover,
          .wrapper.style3 input[type="reset"].special:hover,
          .wrapper.style3 input[type="button"].special:hover,
          .wrapper.style3 button.special:hover,
          .wrapper.style3 .button.special:hover {
            background-color: rgba(255,87,87,0.65);
          }

          .wrapper.style3 input[type="submit"].special:active,
          .wrapper.style3 input[type="reset"].special:active,
          .wrapper.style3 input[type="button"].special:active,
          .wrapper.style3 button.special:active,
          .wrapper.style3 .button.special:active {
            background-color: #45ad97;
          }

        .wrapper.style3 input[type="submit"].alt,
        .wrapper.style3 input[type="reset"].alt,
        .wrapper.style3 input[type="button"].alt,
        .wrapper.style3 button.alt,
        .wrapper.style3 .button.alt {
          background-color: transparent;
          box-shadow: inset 0 0 0 2px #fff;
          color: #fff !important;
        }

          .wrapper.style3 input[type="submit"].alt:hover,
          .wrapper.style3 input[type="reset"].alt:hover,
          .wrapper.style3 input[type="button"].alt:hover,
          .wrapper.style3 button.alt:hover,
          .wrapper.style3 .button.alt:hover {
            background-color: rgba(255, 255, 255, 0.05);
          }

          .wrapper.style3 input[type="submit"].alt:active,
          .wrapper.style3 input[type="reset"].alt:active,
          .wrapper.style3 input[type="button"].alt:active,
          .wrapper.style3 button.alt:active,
          .wrapper.style3 .button.alt:active {
            background-color: rgba(255, 255, 255, 0.1);
          }

    @media screen and (max-width: 1280px) {

      .wrapper {
        padding: 6em 0 4em 0;
      }

        .wrapper > .inner {
          width: 65em;
        }

    }

    @media screen and (max-width: 980px) {

      .wrapper {
        padding: 5em 3em 3em 3em;
      }

        .wrapper > .inner {
          width: 100%;
        }

    }

    @media screen and (max-width: 736px) {

      .wrapper {
        padding: 3em 2em 1em 2em;
      }

    }

    @media screen and (max-width: 480px) {

      .wrapper {
        padding: 2em 1em 0.1em 1em;
      }

    }

/* Header */

    body.landing {
      padding-top: 0;
    }

    @media screen and (max-width: 980px) {

      body {
        padding-top: 44px;
      }

    }

  #header {
    background: #07090c;
    color: rgba(255, 255, 255, 0.75);
    cursor: default;
    height: 3.25em;
    left: 0;
    line-height: 3.25em;
    position: fixed;
    text-align: right;
    top: 0;
    width: 100%;
    z-index: 10001;
  }

    #header > h1 {
      color: #fff;
      display: inline-block;
      height: inherit;
      left: 1.25em;
      line-height: inherit;
      margin: 0;
      padding: 0;
      position: absolute;
      top: 0;
    }

      #header > h1 a {
        font-size: 1.25em;
      }

    #header a {
      -moz-transition: color 0.2s ease-in-out;
      -webkit-transition: color 0.2s ease-in-out;
      -ms-transition: color 0.2s ease-in-out;
      transition: color 0.2s ease-in-out;
      color: #fff;
      display: inline-block;
      margin-right: 1.25em;
      text-decoration: none;
    }

      #header a[href="#nav"] {
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
      }

        #header a[href="#nav"]:before {
          content: "";
          -moz-osx-font-smoothing: grayscale;
          -webkit-font-smoothing: antialiased;
          font-family: FontAwesome;
          font-style: normal;
          font-weight: normal;
          text-transform: none !important;
        }

        #header a[href="#nav"]:before {
          margin: 0 0.5em 0 0;
        }

      #header a + a[href="#nav"]:last-child {
        border-left: solid 1px transparent;
        padding-left: 1.25em;
        margin-left: 0.5em;
      }

    #header.alt {
      background-color: transparent;
      font-size: 1.25em;
      padding: 1em 2em;
      position: absolute;
    }

      #header.alt > h1 {
        color: inherit;
        position: static;
        float: left;
      }

      #header.alt a[href="#nav"] {
        margin-right: 0;
      }

  @media screen and (max-width: 980px) {

    body {
      padding-top: 44px;
    }

    #header {
      height: 44px;
      line-height: 44px;
    }

      #header > h1 {
        left: 1em;
      }

        #header > h1 a {
          font-size: 1em;
        }

      #header.alt {
        font-size: 1em;
      }

  }

  @media screen and (max-width: 480px) {

    #header {
      min-width: 320px;
    }

      #header > h1 {
        left: 1em;
      }

      #header.alt {
        padding: 0.5em 1em;
      }

  }


/* Banner */

  #banner {
    padding: 8em 0 6em 0;
    background-color: #1E2832;
    color: rgba(255, 255, 255, 0.75);
    background-attachment: fixed;
    background-image: url("<?php echo get_template_directory_uri(); ?>/templates-pages/images/overlay.png"), url("<?php echo get_template_directory_uri(); ?>/templates-pages/images/banner.jpg");
    background-size: cover;
    text-align: center;
  }

    #banner input, #banner select, #banner textarea {
      color: #fff;
    }

    #banner a {
      color: #ff5757;
    }

    #banner strong, #banner b {
      color: #fff;
    }

    #banner h1, #banner h2, #banner h3, #banner h4, #banner h5, #banner h6 {
      color: #fff;
    }

    #banner blockquote {
      border-left-color: transparent;
    }

    #banner code {
      background: rgba(255, 255, 255, 0.05);
      border-color: transparent;
    }

    #banner hr {
      border-bottom-color: transparent;
    }

    #banner input[type="submit"],
    #banner input[type="reset"],
    #banner input[type="button"],
    #banner button,
    #banner .button {
      background-color: #fff;
      box-shadow: none;
      color: #1E2832 !important;
    }

      #banner input[type="submit"].icon:before,
      #banner input[type="reset"].icon:before,
      #banner input[type="button"].icon:before,
      #banner button.icon:before,
      #banner .button.icon:before {
        color: #a5a9ad;
      }

      #banner input[type="submit"]:hover,
      #banner input[type="reset"]:hover,
      #banner input[type="button"]:hover,
      #banner button:hover,
      #banner .button:hover {
        background-color: #8f1822;
      }

      #banner input[type="submit"]:active,
      #banner input[type="reset"]:active,
      #banner input[type="button"]:active,
      #banner button:active,
      #banner .button:active {
        background-color: #f2f2f2;
      }

      #banner input[type="submit"].special,
      #banner input[type="reset"].special,
      #banner input[type="button"].special,
      #banner button.special,
      #banner .button.special {
        background-color: #ff5757;
        box-shadow: none;
        color: #fff !important;
      }

        #banner input[type="submit"].special:hover,
        #banner input[type="reset"].special:hover,
        #banner input[type="button"].special:hover,
        #banner button.special:hover,
        #banner .button.special:hover {
          background-color: #8f1822;
        }

        #banner input[type="submit"].special:active,
        #banner input[type="reset"].special:active,
        #banner input[type="button"].special:active,
        #banner button.special:active,
        #banner .button.special:active {
          background-color: #45ad97;
        }

      #banner input[type="submit"].alt,
      #banner input[type="reset"].alt,
      #banner input[type="button"].alt,
      #banner button.alt,
      #banner .button.alt {
        background-color: transparent;
        box-shadow: inset 0 0 0 2px #fff;
        color: #fff !important;
      }

        #banner input[type="submit"].alt:hover,
        #banner input[type="reset"].alt:hover,
        #banner input[type="button"].alt:hover,
        #banner button.alt:hover,
        #banner .button.alt:hover {
          background-color: #8f1822;
        }

        #banner input[type="submit"].alt:active,
        #banner input[type="reset"].alt:active,
        #banner input[type="button"].alt:active,
        #banner button.alt:active,
        #banner .button.alt:active {
          background-color: rgba(255, 255, 255, 0.1);
        }

    #banner h2 {
      font-size: 2.5em;
      margin: 0 0 0.5em 0;
      padding: 0;
    }

    #banner p {
      color: #fff;
      font-size: 1.5em;
      margin-bottom: 1.75em;
      text-transform: uppercase;
    }

    #banner .icon {
      border-radius: 100%;
      border: solid 2px #fff;
      color: #fff;
      display: inline-block;
      font-size: 3em;
      height: 2.25em;
      line-height: 1.25em;
      margin-bottom: 0.5em;
      padding: 0.5em;
      width: 2.25em;
    }

    @media screen and (max-width: 1680px) {

      #banner {
        padding: 11em 0 9em 0;
      }

    }

    @media screen and (max-width: 1280px) {

      #banner {
        padding: 9em 0 7em 0;
      }

        #banner h2 {
          font-size: 2em;
        }

    }

    @media screen and (max-width: 980px) {

      #banner {
        padding: 8em 2em 6em 2em;
      }

    }

    @media screen and (max-width: 736px) {

      #banner {
        padding: 5em 2em 3em 2em;
      }

        #banner h2 {
          font-size: 1.5em;
        }

        #banner p {
          font-size: 1em;
        }

        #banner .icon {
          font-size: 2em;
        }

    }

    @media screen and (max-width: 480px) {

      #banner {
        padding: 5em 2em 3em 2em;
      }

        #banner .icon {
          font-size: 1.5em;
        }

    }



    </style>
  <body>

    <!-- Banner -->
      <section id="banner">
        <br>
        <br>
        <br>
        <h2>고려대학교 경영정보학과 소모임</h2>
        <h2>MAVEN</h2>
        <ul class="actions">
          <li><a href="#one" class="button big special">더 알고 싶으면?</a></li>
        </ul>
      </section>

    <!-- One -->
      <section id="one" class="wrapper style1">
        <div class="inner">
          <article class="feature left">
            <span class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic01.jpg" alt="" /></span>
            <div class="content">
              <h3>배움의 장이 아닌 공유의 장</h3>
              <p>기존의 학술 소모임과는 달리 MAVEN에서는 자신이 전문으로 하는 분야에 대해 꾸준히 공부를 합니다. 그리고 서로의 분야에 대해 아는 지식을 공유합니다. 이처럼 모든 IT분야를 섭렵하는 것이 아닌, 주력 분야에 충실하여 이 사회에서 전문가가 되는 것이 저희 MAVEN의 궁극적인 목표입니다.</p>
            </div>
          </article>
          <article class="feature right">
            <span class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic02.jpg" alt="" /></span>
            <div class="content">
              <h3>MAVEN에 지원하려면?</h3>
              <p>MAVEN과 함께하기 위한 방법은 간단합니다!</p>
              <p>아래 지원하기 버튼을 통해 양식을 작성하시고 MAVEN에 지원하여 주세요!</p>
              <ul class="actions">
                <li>
                  <a href="http://goo.gl/forms/heJTfyLdC3" class="button alt">지원하기</a>
                </li>
              </ul>
            </div>
          </article>
        </div>
      </section>

    <!-- Two -->
      <section id="two" class="wrapper special">
        <div class="inner">
          <header class="major narrow">
            <h2>활동</h2>
            <p>메이븐이 지금까지 진행한 활동들입니다.</p>
          </header>
          <div class="image-grid">
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic03.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic04.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic05.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic06.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic07.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic08.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic09.jpg" alt="" /></a>
            <a href="#" class="image"><img src="<?php echo get_template_directory_uri(); ?>/templates-pages/images/pic10.jpg" alt="" /></a>
          </div>
          <ul class="actions">
            <li><a href="http://mismaven.kr/?cat=12" class="button big alt">활동들이 더 궁금하면?</a></li>
          </ul>
        </div>
      </section>

      


    <!-- Four -->
      <section id="four" class="wrapper style2 special">
        <div class="inner">
          <header class="major narrow">
            <h2>메이븐에게 물어보고 싶은게 있다면?</h2>
            <p>주저말고 연락해주세요</p>
          </header>
          <form action="./send_mail.php" method="POST">
            <div class="container 75%">
              <div class="row uniform 50%">
                <div class="6u 12u$(xsmall)">
                  <input name="name" placeholder="Name" type="text" required autocomplete="off"/>
                </div>
                <div class="6u$ 12u$(xsmall)">
                  <input name="email" placeholder="Email" type="email" required autocomplete="off"/>
                </div>
                <div class="12u$">
                  <textarea name="message" placeholder="Message" rows="4" required autocomplete="off"></textarea>
                </div>
              </div>
            </div>
            <ul class="actions">
              <li><input type="submit" class="special" value="Submit" /></li>
              <li><input type="reset" class="alt" value="Reset" /></li>
            </ul>
          </form>
        </div>
      </section>



  </body>

<?php get_footer(); ?>