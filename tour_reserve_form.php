<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_reserve_form extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_reserve_form';
	}

	public function get_title() {
		return 'فرم رزرو تور';
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
		if ( ! isset ( $_GET['action'] ) ) {
			$tour_id = get_the_ID();
		} else {
			$tour_id = create_post_id();
		}
		$user_info  = get_currentuserinfo();
		$input_sans = get_user_meta( $user_info->ID, 'sans_session', true );
		$tour_meta  = get_post_meta( $input_sans['tid'], 'all_tour_meta', true );

		if ( $input_sans ) {
			if ( $input_sans['date'] != '' ) {
				$date = change_date_month_word( $input_sans['date'] );
			} else {
				$date = 'تاریخ و ساعت انتخابی';
			}
			if ( $input_sans['sans'] != '' ) {
				$sans = $input_sans['sans'];
			} else {
				$sans = '';
			}

		}

		if ( $input_sans['date'] != '' ) {
			$type = 'general';
		} else {
			$type = 'private';
		}
		?>
        <div class="tform_box d_flex height60">
            <figure><i class="fa-thin fa-calendar-day mt_20 ml_10"></i></figure>
            <div class="w80p">
                <p class="fz12 col_gray">تاریخ و ساعت :</p>
                <p class="fz13 mt_10">  <?php echo $date ?> - ساعت <?php echo $sans ?></p>
            </div>

        </div>
        <div class="tform_box d_flex height60">
            <figure><i class="fa-thin fa-people mt_20 ml_10"></i></figure>
            <p class="fz12 col_gray">تعداد نفرات</p>
            <div class="pm_box w80p justc_end">

                <span class="plus_m imp_mp"><i class="fa fa-plus"></i></span>
                <input type="number" class="w40i bord_no base_capacity " data-maxc="<?php echo $tour_meta['tour_capacity'] ?>" name="base_capacity" value="1">
                <span class="minus_m imp_mp"><i class="fa fa-minus"></i></span>
            </div>


        </div>
        <div class="pinfo_box ">
            <i class="fa-thin fa-address-card"></i>

            <span class="fz13 mr5">اطلاعات مسافر</span>
            <div class="tdb_date">

                <div class="pibox_dt height60">

                    <input type="text" name="psi_name" class="psi_name height35" placeholder="نام">
                    <input type="text" name="psi_lastname" class="psi_lastname height35" placeholder="نام خانوادگی">
                    <input type="text" disabled name="psi_phone" value="<?php echo $user_info->user_login ?>" class="psi_phone height35" placeholder="شماره همراه">

                </div>

            </div>


        </div>
        <span class="line_dash_2">
        <div class="d_flex jcspcbt mbt20 height60 ">
            <p><span> قیمت: </span><span class="topri"><?php echo $tour_meta['tour_price'] ?><span>  تومان   </span></p>
            <span class="tres_send fz14">درخواست رزرو</span>
        </div>
        <script>
            jQuery(document).on('click', '.plus_m', function () {
                let $this = jQuery(this);
                let parents = $this.parents('.pm_box');
                let elem = parents.find('input');
                let input_val = elem.val();
                var max_cap = elem.data('maxc');
                var price = <?php  echo $tour_meta['tour_price']?>;
                if (input_val < max_cap) {
                    var new_num = Number(input_val) + 1
                    elem.val(new_num);
                    jQuery('.topri').text(price * new_num + ' تومان ')
                }
            })
            jQuery(document).on('click', '.minus_m', function () {
                let $this = jQuery(this);
                let parents = $this.parents('.pm_box');
                let elem = parents.find('input');
                let input_val = elem.val();
                var price = <?php  echo $tour_meta['tour_price']?>;
                if (Number(input_val > 1)) {
                    var new_num = Number(input_val) - 1
                    elem.val(new_num)
                    jQuery('.topri').text(price * new_num + ' تومان ')
                }
            })
            jQuery(document).on('click', '.tres_send', function () {

                let $this = jQuery(this);
                let uid = <?php  echo $user_info->ID ?>;
                let tour_id = <?php  echo $input_sans['tid'] ?>;
                let date_request = '<?php  echo jdate( 'Y-m-d H:s', time(), '', '', 'en' )?>'
                var request_type = '<?php echo $type ?>';
                var tour_date = '<?php   echo $input_sans['date']    ?>';
                var sans = '<?php   echo $input_sans['sans']  ?>'
                var people_number = jQuery('.base_capacity').val();
                let order_status = 1
                var price_each = <?php echo $tour_meta['tour_price']    ?>;
                let price = people_number * price_each;
                var pay_status = 1;
                let passenger_phone = jQuery('.psi_phone').val()
                let passenger_name = jQuery('.psi_name').val()
                let passenger_lastname = jQuery('.psi_lastname').val()
                if ( passenger_name.length == 0){
                    jQuery('.psi_name').css({'border-color':'red'})
                }else {
                    jQuery('.psi_name').css({'border-color':'#ddd'})
                }
                if ( passenger_lastname.length == 0){
                    jQuery('.psi_lastname').css({'border-color':'red'})
                }else {
                    jQuery('.psi_lastname').css({'border-color':'#ddd'})
                }
                jQuery.ajax({
                    url: ajax_data.aju,
                    type: "POST",
                    data: {
                        action: "tour_send_order_save", 'uid': uid, 'tour_id': tour_id, 'date_request': date_request,
                        'request_type': request_type, 'tour_date': tour_date, 'sans': sans, 'people_number': people_number,
                        'order_ststus': order_status, 'price': price, 'pay_status': pay_status, 'passenger_phone': passenger_phone,
                        'passenger_name': passenger_name, 'passenger_lastname': passenger_lastname
                    },

                    beforeSend: function () {


                    },
                    success: function (response) {
                        let url = ajax_data.turl + '/experiences'
                        jQuery(location).attr('href', url);
                        jQuery('.no_item').css({'display': 'none'})
                        jQuery('.room_item_box_prbox').append(response)
                    }

                })

            })
        </script>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tour_reserve_form() );

