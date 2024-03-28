<?php


use Elementor\Plugin;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_img_slider extends Widget_Base {
	public function get_name() {
		return 'jayto_img_slider';
	}

	public function get_title() {
		return 'اسلایدر تصاویر جایتو';
	}

	public function get_script_depends() {
		return [ 'jayto_script' ];
	}

	public function get_icon() {
		return 'fa fa-chevron-right';
	}

	public function get_categories() {
		return [ 'jayto' ];
	}


	protected function register_controls() {

		$this->style_tab();
	}

	private function style_tab() {

	}

	protected function render() {



	}

	protected function content_template() {

	}
}


Plugin::instance()->widgets_manager->register( new jayto_img_slider() );

