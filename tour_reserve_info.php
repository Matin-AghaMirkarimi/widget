<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_reserve_info extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_reserve_info';
	}

	public function get_title() {
		return 'اطلاعات تور فرم رزرو';
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
//		if ( ! isset ( $_GET['action'] ) ) {
//			$tour_id = get_the_ID();
//		} else {
//			$tour_id = create_post_id();
//		}
        $uid=get_current_user_id();
		$input_sans = get_user_meta( $uid, 'sans_session', true );
		$tmeta = 	get_post_meta( $input_sans['tid'], 'all_tour_meta', true);
		$args       = array(

			'post_type'      => 'tour',
			'posts_per_page' => '1',
			'post_id'        =>$input_sans['tid'],
			'post_status'    => 'publish'
		);
		$tour_information = get_posts( $args );

//print_r($tour_information);
//        echo $tour_information['']
        ?>
        <div class="resf_infbox">
            <div class="d_flex jcspcbt  resf_infhead ">
                <figure class="w50p">
                    <img class="bor7" src="http://127.0.0.1/jayto/wp-content/uploads/2023/06/ae43f4ef-1c7c-4c17-95fb-393a4e5f756d.jpg" alt="">
                </figure>
                <div class="dfcflx ">
                    <p class="fz12"><?php  echo $tour_information[0]->post_title ?></p>
                    <p class="fz12 mt_10">      <i class="fa-thin fa-location-pin-lock col_orng"></i> گیلان ، شفت</p>
                </div>
            </div>
            <span class="line"></span>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/جای تجربه.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">جای تجربه</p>
                    <p class="fz13 fw500 mt_10">کلبه تست</p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/چالش فیزیکی.png" alt="" class="mt_20">                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">چالش فیزیکی</p>
                    <p class="fz13 fw500 mt_10"><?php echo $tmeta['Physical_challenge'] ?></p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/مناسب برای.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">مناسب برای</p>
                    <p class="fz13 fw500 mt_10"><?php  echo $tmeta['age_need'] ?></p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/مدت تجربه.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">مدت تجربه</p>
                    <p class="fz13 fw500 mt_10"><?php  echo $tmeta['tour_time'] ?> ساعت </p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/ظرفیت هر سانس.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">ظرفیت هر سانس</p>
                    <p class="fz13 fw500 mt_10"><?php echo  $tmeta['tour_capacity'] ?>  نفر </p>
                </div>
            </div>

        </div>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tour_reserve_info() );

