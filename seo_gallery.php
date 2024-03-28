



<?php
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class seo_gallery extends \Elementor\Widget_Base {
    public function get_name() {
        return 'seo_gallery';
    }

    public function get_title() {
        return 'گالری سئو';
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
            'cs_gallery',
            [
                'label' => __( 'لیست موارد', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'cs_gallery_image',
            [
                'label' => esc_html__( 'انتخاب تصویر', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'cs_gallery_title',
            [
                'label' => esc_html__( 'عنوان', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'cs_gallery_link',
            [
                'label' => esc_html__( 'لینک', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'cs_gallery_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ cs_gallery_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->style_tab();
    }

    private function style_tab() {
        // کدهای استایل همانند قسمت قبل
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $gallery_list = $settings['cs_gallery_list'];
        ?>
        <div class="row">
            <?php
            if (!empty($gallery_list)) {
                foreach ($gallery_list as $item) {
                    $image_url = $item['cs_gallery_image']['url'];
                    $title = $item['cs_gallery_title'];
                    $link = $item['cs_gallery_link']['url'];
                    ?>
                    <figure itemscope="" itemtype="http://schema.org/SingleFamilyResidence" class="col-xs-12 col-md-4 col-sm-6 pull-right">
                        <div class="article">
                            <div class="article-image  lazy-wrap">
                                <a href="<?php echo esc_url($link); ?>" itemtype="http://schema.org/ImageObject">
                                    <img alt="<?php echo esc_attr($title); ?>" class="img-responsive" height="200" src="<?php echo esc_url($image_url); ?>" width="350">
                                </a>
                            </div>
                            <div class="article-info">
                                <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a>
                            </div>
                        </div>
                    </figure>
                    <?php
                }
            }
            ?>
        </div>

    <?php }

    protected function content_template() {
    }
}

\Elementor\Plugin::instance()->widgets_manager->register(new seo_gallery());
