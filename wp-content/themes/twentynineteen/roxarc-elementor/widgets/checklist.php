<?php

namespace Roxarc\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Checklist extends Widget_Base{

  public function get_name(){
    return 'roxarc checklist';
  }

  public function get_title(){
    return 'Roxarc Checklist';
  }

  public function get_icon(){
    return 'fa fa-camera';
  }

  public function get_categories(){
    return ['basic'];
  }

  protected function _register_controls(){

    $this->start_controls_section(
      'section_content',
      [
        'label' => 'Settings',
      ]
    );

    $this->add_control(
      'checklist_name',
      [
        'label' => 'Checklist Name',
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'צ׳קליסט'
      ]
    );

    $repeater = new Repeater();
    
    $repeater->add_control(
      'checklist_item_content',
      [
        'label' => 'Content',
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => 'Some example content. Start Editing Here.'
      ]
		);

    $this->add_control(
			'checklist_list',
			[
				'label' => 'Checklist Sections',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

    $this->end_controls_section();
  }
  
  protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['checklist_list'] ) {
      echo '<div class="roxarc-checklist">';
      echo '<h2 class="roxarc-checklist-title">' . $settings['checklist_name'] . '</h2>';
      for ($x = 0; $x < count($settings['checklist_list']); $x++) {
        echo '<div class="roxarc-checklist-item">' . $settings['checklist_list'][$x]['checklist_item_content'] . '</div>';
        if ($x < count($settings['checklist_list']) -1 ) {
          echo '<hr class="roxarc-checklist-hr">';
        }
      }
      echo '</div>';
		}
  }
  
  public function get_style_depends() {
    return [ 'checklistStyle' ];
  }


  protected function _content_template(){
    ?>
    <#
        view.addInlineEditingAttributes( 'label_heading', 'basic' );
    view.addRenderAttribute(
        'label_heading',
        {
            'class': [ 'advertisement__label-heading' ],
        }
    );
        #>
        <div class="advertisement">
      <div {{{ view.getRenderAttributeString( 'label_heading' ) }}}>{{{ settings.label_heading }}}</div>
      <div class="advertisement__content">
        <div class="advertisement__content__heading">{{{ settings.content_heading }}}</div>
        <div class="advertisement__content__copy">
          {{{ settings.content }}}
        </div>
      </div>
    </div>
        <?php
  }
}