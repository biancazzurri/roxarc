<?php
namespace Roxarc;

// use Elementor\Plugin; ?????
class Roxarc_Elementor_Loader{

  private static $_instance = null;

  public static function instance()
  {
    if (is_null(self::$_instance)) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }


  private function include_widgets_files(){
    require_once(__DIR__ . '/widgets/checklist.php');
  }

  public function register_widgets(){

    $this->include_widgets_files();

    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Checklist());

  }

  public function enqueue_widget_styles() {
    wp_enqueue_style( 'checklistStyle' );
  }

  public function register_widget_styles() {
    wp_register_style( 'checklistStyle', get_template_directory_uri() .  '/roxarc-elementor/css/checklist.css'); 
  }

  public function __construct(){
    add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets'], 99);
    add_action('elementor/frontend/after_enqueue_styles', [ $this, 'register_widget_styles']);
    // add_action('elementor/preview/enqueue_styles', [ $this , 'enqueue_widget_styles'] );
  }
}

// Instantiate Plugin Class
Roxarc_Elementor_Loader::instance();