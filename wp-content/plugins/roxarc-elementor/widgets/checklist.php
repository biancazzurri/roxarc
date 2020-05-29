<?php
namespace RoxarcElementor\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
class Checklist extends Widget_Base {

  public function get_name() {
    return 'awesomesauce';
  }
 
  public function get_title() {
    return __( 'Awesomesauce', 'roxarc-elementor' );
  }
 
  public function get_icon() {
    return 'fa fa-pencil';
  }
 
  public function get_categories() {
    return [ 'basic' ];
  }
 
  protected function _register_controls() {
    $this->start_controls_section(
      'section_content',
      [
        'label' => __( 'Content', 'roxarc-elementor' ),
      ]
    );
 
    $this->add_control(
      'title',
      [
        'label' => __( 'Title', 'roxarc-elementor' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Title', 'roxarc-elementor' ),
      ]
    );
 
    $this->add_control(
      'description',
      [
        'label' => __( 'Description', 'roxarc-elementor' ),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __( 'Description', 'roxarc-elementor' ),
      ]
    );
 
    $this->add_control(
      'content',
      [
        'label' => __( 'Content', 'roxarc-elementor' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'Content', 'roxarc-elementor' ),
      ]
    );
 
 
    $this->end_controls_section();
  }
 
  protected function render() {
    $settings = $this->get_settings_for_display();
 
    $this->add_inline_editing_attributes( 'title', 'none' );
    $this->add_inline_editing_attributes( 'description', 'basic' );
    $this->add_inline_editing_attributes( 'content', 'advanced' );
    ?>
    <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
    <div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $settings['description']; ?></div>
    <div <?php echo $this->get_render_attribute_string( 'content' ); ?>><?php echo $settings['content']; ?></div>
    <?php
  }
 
  protected function _content_template() {
    ?>
    <#
    view.addInlineEditingAttributes( 'title', 'none' );
    view.addInlineEditingAttributes( 'description', 'basic' );
    view.addInlineEditingAttributes( 'content', 'advanced' );
    #>
    <h2 {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
    <div {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
    <div {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
    <?php
  }
}