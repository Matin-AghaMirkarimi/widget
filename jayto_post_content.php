<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_post_content extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_post_content';
	}

	public function get_title() {
		return 'متن مطلب';
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

		$this->style_tab();
	}

	private function style_tab() {


	}

	protected function render() {

		$post_id = '';
		$get     = $_GET;
		$action  = $get['action'];
		if ( $action=='elementor' ) {
			$post_id = create_posts_id();
		} else {
			$post_id = get_the_ID();
		}


		$content = get_the_content( $post_id );
		?>
		<h1 class="post_title"><?php echo $content ;?></h1>
		<?php


		?>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_post_content() );

