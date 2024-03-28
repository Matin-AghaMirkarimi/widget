<?php


use Elementor\Plugin;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class image_slider extends Widget_Base {
	public function get_name() {
		return 'select_img_slider';
	}

	public function get_title() {
		return 'اسلایدر تصاویر منتخب';
	}

	public function get_script_depends() {
		return [ 'jayto_script' ];
	}

	public function get_icon() {
		return 'dashicons dashicons-embed-generic';
	}

	public function get_categories() {
		return [ 'jayto' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'ndgSlides_setting',
			[
				'label' => __( 'تنظیمات اسلاید ها', 'jayto' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ndg_slide_image',
			[
				'label'   => __( 'انتخاب تصویر', 'jayto' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater->add_control(
			'ndg_link',
			[
				'label'         => __( 'لینک تصویر', 'jayto' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'jayto' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);


		$this->add_control(
			'ndg_slide_pics',
			[
				'label'  => __( ' اسلاید ها', 'jayto' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
//				'title_field' => '{{{ vit_slide_image}}}',
			]
		);

		$this->end_controls_section();

		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'ndg_section',
			[
				'label' => esc_html__( 'استایل تصاویر', 'jayto' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jndg_border',
				'selector' => '{{WRAPPER}} .tile_fig',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jndg_shadow',
				'selector' => '{{WRAPPER}} .tile_fig',
			]
		);
		$this->add_control(
			'jndg_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tile_fig' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	}

	protected function render() {
		$values = $this->get_settings_for_display();
		$images    = $values['ndg_slide_pics'];

		?>
       <div class="tile_image_box">
	       <div class="tile_image_inner">
               <?php
               $i=1;
               foreach ($images as $row){?>
                   <figure class='tile_fig' data-sec=<?php  echo $i?>>
                       <a href="<?php  echo $row['ndg_link']['url']?>">
                           <img src="<?php  echo $row['ndg_slide_image']['url']?>" alt="">
                       </a>

                   </figure>
          <?php  $i++ ;  }
               ?>
	       </div>
       </div>

	<?php }

	protected function content_template() {

	}
}


Plugin::instance()->widgets_manager->register( new image_slider() );

