<?php

/*
  Plugin Name: Quiz Block Plugin
  Description: Multiple choice question block.
  Version: 1.0
  Author: Andrew
  Author URI: https://adstrat.github.io/portfolio/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class QuizBlock {
  function __construct() {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('mynewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    register_block_type('myplugin/quiz', array(
      'editor_script' => 'mynewblocktype',
      'editor_style' => 'quizeditcss',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes) {
    if (!is_admin()) {
      wp_enqueue_script('quizFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'));
      wp_enqueue_style('quizFrontendStyles', plugin_dir_url(__FILE__) . 'build/frontend.css');
    }
    
    ob_start(); ?>
    <div class="quiz-update-me"><pre style="display: none;"><?php echo wp_json_encode($attributes) ?></pre></div>
    <?php return ob_get_clean();
  }
}

$quizBlock = new QuizBlock();