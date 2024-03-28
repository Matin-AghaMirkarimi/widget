

<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class seo_slider extends \Elementor\Widget_Base {
    public function get_name() {
        return 'seo_slider';
    }

    public function get_title() {
        return 'اسلایدر سئو';
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
            'qs_section_content',
            [
                'label' => esc_html__( 'عنوان ها', 'textdomain' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'qs_header_title',
            [
                'label'       => esc_html__( 'عنوان', 'textdomain' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
            ]
        );
        $this->add_control(
            'qs_header_desc',
            [
                'label'       => esc_html__( 'توضیح', 'textdomain' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'توضیح  را وارد کنید', 'textdomain' ),
            ]
        );
        $this->add_control(
            'show_each_slide',
            [
                'label' => esc_html__( 'نمایش اسلایدر هر اسلاید', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'نمایش', 'textdomain' ),
                'label_off' => esc_html__( 'مخفی', 'textdomain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'qs_content_section',
            [
                'label' => __( 'کوئری دسته بندی', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $category = get_terms( array(
            'taxonomy'   => 'categories',
            'hide_empty' => false,
            'post_type'  => 'residence'
        ) );

        $items = array();
        foreach ( $category as $cat ) {
            $items[ $cat->slug ] = $cat->name;
        }

        $this->add_control(
            'rqs_shows_id',
            [
                'label'        => esc_html__( 'نمایش شناسه', 'Vitrin-Plugin' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'نمایش', 'Vitrin-Plugin' ),
                'label_off'    => esc_html__( 'مخفی', 'Vitrin-Plugin' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'qs_SliderQueryCat',
            [

                'label'   => esc_html__( 'انتخاب دسته بندی', 'Vitrin-Plugin' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $items
            ]
        );
        $this->add_control(
            'qs_CatQueryList',
            [
                'label'       => __( 'انتخاب دسته بندی', 'haula-Plugin' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{qs_SliderQueryCat}}}',
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'qs_city_content_section',
            [
                'label' => __( 'کوئری شهر', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $cites       = get_terms( array(
            'taxonomy'   => 'city',
            'hide_empty' => false,
            'post_type'  => 'residence'
        ) );
        $cites_array = [];
        foreach ( $cites as $row ) {
            $cites_array[ $row->slug ] = $row->name;
        }

        $repeater_city = new \Elementor\Repeater();
        $repeater_city->add_control(
            'qs_SliderQueryCity',
            [

                'label'   => esc_html__( 'انتخاب شهر', 'Vitrin-Plugin' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $cites_array
            ]
        );
        $this->add_control(
            'qs_CitesQueryList',
            [
                'label'       => __( 'انتخاب شهر', 'haula-Plugin' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater_city->get_controls(),
                'title_field' => '{{{qs_SliderQueryCity}}}',
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'qs_region_content_section',
            [
                'label' => __( 'کوئری منطقه', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $region = get_terms( array(
            'taxonomy'   => 'region',
            'hide_empty' => false,
            'post_type'  => 'residence'
        ) );

        $region_array = [];
        foreach ( $region as $row ) {
            $region_array[ $row->slug ] = $row->name;
        }

        $repeater_region = new \Elementor\Repeater();
        $repeater_region->add_control(
            'qs_SliderQueryRegion',
            [

                'label'   => esc_html__( 'انتخاب منطقه', 'Vitrin-Plugin' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $region_array
            ]
        );
        $this->add_control(
            'qs_RegionQueryList',
            [
                'label'       => __( 'انتخاب منطقه', 'haula-Plugin' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater_region->get_controls(),
                'title_field' => '{{{qs_SliderQueryRegion}}}',
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'qs_tools_content_section',
            [
                'label' => __( 'کوئری امکانات', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $tools = get_terms( array(
            'taxonomy'   => 'tools',
            'hide_empty' => false,
            'post_type'  => 'residence'
        ) );

        $tools_array = [];
        foreach ( $tools as $row ) {
            $tools_array[ $row->slug ] = $row->name;
        }

        $repeater_tools = new \Elementor\Repeater();
        $repeater_tools->add_control(
            'qs_SliderQueryTools',
            [

                'label'   => esc_html__( 'انتخاب امکانات', 'Vitrin-Plugin' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $tools_array
            ]
        );
        $this->add_control(
            'qs_ToolsQueryList',
            [
                'label'       => __( 'انتخاب امکانات', 'haula-Plugin' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater_tools->get_controls(),
                'title_field' => '{{{qs_SliderQueryTools}}}',
            ]
        );


        $this->end_controls_section();
        $this->style_tab();
    }

    private function style_tab() {
        $this->start_controls_section(
            'jt_qslider_style',
            [
                'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'jt_qslider_title_typography',
                'selector' => '{{WRAPPER}} .swiper_header h2',
            ]
        );

        $this->add_control(
            'jt_cat_name1_color',
            [
                'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper_header h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jjt_cat_name1_color_hover',
            [
                'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper_header h2:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_cat_name1_color_margin',
            [
                'label'      => esc_html__( 'فاصله', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper_header h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_cat_name1_color_padding',
            [
                'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper_header h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_desc_style',
            [
                'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'jt_qslider_desc_typography',
                'selector' => '{{WRAPPER}} .swiper_header h5',
            ]
        );

        $this->add_control(
            'jt_qslider_desc_color',
            [
                'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper_header h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_desc_hover',
            [
                'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper_header h5:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_desc_margin',
            [
                'label'      => esc_html__( 'فاصله', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper_header h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_desc_padding',
            [
                'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper_header h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_item_style',
            [
                'label' => __( 'آیتم ها ', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'jt_qslider_item-border',
                'selector' => '{{WRAPPER}} .swiper-slide',
            ]
        );
        $this->add_control(
            'jt_qslider_item_radius',
            [
                'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'jt_qslider_item_shadow',
                'selector' => '{{WRAPPER}} .swiper-slide',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_desc_link_title_one_style',
            [
                'label' => __( 'عنوان اقامتگاه', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'jt_qslider_desc_link_title_one_typography',
                'selector' => '{{WRAPPER}} .n_span',
            ]
        );
        $this->add_control(
            'jt_qslider_desc_link_title_one_color',
            [
                'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_desc_link_title_one_hover',
            [
                'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .n_span:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_desc_link_title_one_margin',
            [
                'label'      => esc_html__( 'فاصله', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .n_span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_desc_link_title_one_padding',
            [
                'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .n_span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_city_style',
            [
                'label' => __( 'نام شهر', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'jt_qslider_city_typography',
                'selector' => '{{WRAPPER}} .scn',
            ]
        );
        $this->add_control(
            'jt_qslider_city_color',
            [
                'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_city_hover',
            [
                'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_city_dot',
            [
                'label'     => esc_html__( 'رنگ جداکننده', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dot_span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_city_margin',
            [
                'label'      => esc_html__( 'فاصله', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .scn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_city_padding',
            [
                'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .scn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_price_style',
            [
                'label' => __( 'قیمت', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'jt_qslider_price_typography',
                'selector' => '{{WRAPPER}} .item_price .p_span',
            ]
        );
        $this->add_control(
            'jt_qslider_price_color',
            [
                'label'     => esc_html__( 'رنگ', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item_price .p_span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_price_dis_color',
            [
                'label'     => esc_html__( 'رنگ قیمت تخفیف', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item_price .dis_span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_price_dis_size',
            [
                'label'      => esc_html__( 'اندازه فونت قیمت تخفیف', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],

                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 13,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .dis_span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]

        );
        $this->add_control(
            'jt_qslider_price_percent_color',
            [
                'label'     => esc_html__( 'رنگ پس زمینه بالت تخفیف', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dis_percent' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_img_style',
            [
                'label' => __( 'تصویر ', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'jt_qslider_img_border',
                'selector' => '{{WRAPPER}} .qslider_image',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'jt_qslider_img_shadow',
                'selector' => '{{WRAPPER}} .qslider_image',
            ]
        );
        $this->add_control(
            'jt_qslider_img_radius',
            [
                'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .qslider_image2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_img_padd',
            [
                'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .qslider_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'jt_qslider_img_filters',
                'selector' => '{{WRAPPER}} .city_fav_image',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_navi_style',
            [
                'label' => __( 'فلش ها ', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .sqbp ,{{WRAPPER}} .sqbn ',
            ]
        );
        $this->add_control(
            'jt_qslider_navi_radius',
            [
                'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .sqbp,{{WRAPPER}} .sqbn ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_navi_color',
            [
                'label'     => esc_html__( 'رنگ فلش ها', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sqbp > span,{{WRAPPER}} .sqbn > span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_navigap',
            [
                'label'      => esc_html__( 'فاصله', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],

                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .swiper-but-box ' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_bage_style',
            [
                'label' => __( 'بج رزرو آنی', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_control(
            'jt_qslider_bage_bgcolor',
            [
                'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hia_bag' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_bage_color',
            [
                'label'     => esc_html__( 'رنگ متن', 'textdomain' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hia_bag' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_bage_padding',
            [
                'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .hia_bag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_bage_margin',
            [
                'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .hia_bag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_bage_radius',
            [
                'label'      => esc_html__( 'انحنا', 'textdomain' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors'  => [
                    '{{WRAPPER}} .hia_bag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'jt_qslider_bage_border',
                'selector' => '{{WRAPPER}} .hia_bag',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'jt_qslider_bage_box_shadow',
                'selector' => '{{WRAPPER}} .hia_bag',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'jt_qslider_sh_style',
            [
                'label' => __( 'شناسه', 'jayto-Plugin' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
        $this->add_control(
            'jt_qslider_sh_bg_color',
            [
                'label' => esc_html__( 'پس زمینه شناسه', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .code_st' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'jt_qslider_sh_color',
            [
                'label' => esc_html__( ' رنگ شناسه', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .code_st' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    public function g_terms( $taxonomy, $post_type ) {
        $terms = get_terms( array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'post_type'  => $post_type
        ) );

        return $terms;
    }

    protected function render() {
        $values = $this->get_settings_for_display();

        $head_title  = $values['qs_header_title'];
        $show_id  = $values['rqs_shows_id'];
        $head_desc   = $values['qs_header_desc'];
        $CatQuery    = $values['qs_CatQueryList'];
        $cityQuery   = $values['qs_CitesQueryList'];
        $regionQuery = $values['qs_RegionQueryList'];
        $toolsQuery  = $values['qs_ToolsQueryList'];
        $slide_sh  = $values['show_each_slide'];
        $t_query     = [];
        if ( $CatQuery != '' || $cityQuery != '' || $regionQuery != '' ) {

            $t_query['relation'] = 'AND';

            if ( $cityQuery[0]['qs_SliderQueryCity'] != '' ) {

                $city_array = [];
                foreach ( $cityQuery as $city ) {

                    $city_array[] = $city['qs_SliderQueryCity'];
                }

                $end_city_array = [ 'taxonomy' => 'city', 'field' => 'slug', 'terms' => $city_array ];
                $t_query[]      = $end_city_array;
            }

            if ( $regionQuery[0]['qs_SliderQueryRegion'] != '' ) {

                $region_array = [];
                foreach ( $regionQuery as $region ) {

                    $region_array[] = $region['qs_SliderQueryRegion'];
                }

                $end_region_array = [ 'taxonomy' => 'region', 'field' => 'slug', 'terms' => $region_array ];
                $t_query[]        = $end_region_array;
            }
            if ( $CatQuery[0]['qs_SliderQueryCat'] != '' ) {
                $cat_array = [];

                foreach ( $CatQuery as $cat ) {

                    $cat_array[] = $cat['qs_SliderQueryCat'];
                }

                $end_cat_array = [ 'taxonomy' => 'categories', 'field' => 'slug', 'terms' => $cat_array ];
                $t_query[]     = $end_cat_array;
            }

            if ( $toolsQuery[0]['qs_SliderQueryTools'] != '' ) {
                $tools_array = [];

                foreach ( $toolsQuery as $tools ) {

                    $tools_array[] = $tools['qs_SliderQueryTools'];
                }

                $end_tools_array = [ 'taxonomy' => 'tools', 'field' => 'slug', 'terms' => $tools_array ];
                $t_query[]       = $end_tools_array;
            }

        }


        $args = array(
            'numberposts' => - 1,
            'post_type'   => 'residence',
            'orderby' => 'rand',
            'tax_query'   => $t_query
        );


//        $the_query = new WP_Query( $args );
        $posts           = get_posts( array(
            'post_type'      => 'residence',
            'posts_per_page' => '-1',
            'tax_query'   => $t_query,
             'orderby' => 'rand',

            )
        );

        $rand      = rand( 20, 1000000 );
        $rand2     = rand( 20, 1000000 );

        ?>

        <div class="swiper-container">
            <div class="swiper seo_slider<?php echo $rand ?>">
                <div id="archive_box" class="archive_box">
                    <?php

                    foreach ($posts as $index => $row) {
                        $item_city = get_the_terms($row->ID, 'city');
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), 'medium', true);
                        $alt_text = get_post_meta($row->ID, '_wp_attachment_image_alt', true);
                        $all_meta = get_post_meta($row->ID);
                        $meta2 = get_post_meta($row->ID, '_all_res_meta', false);
                        $tools_arry = [];

                        $meta = unserialize($all_meta['_all_res_meta'][0]);
                        $amu = unserialize($all_meta['gallery_data'][0]);
                        $gall = get_post_galleries_images($row->ID);

                        $all_tools = get_terms(array(
                            'taxonomy' => 'tools',
                            'hide_empty' => false,
                        ));
                        $tools = get_the_terms($row->ID, 'tools');

                        $codeid = get_post_meta($row->ID, 'codeid', true);
                        $room_number = $meta['number_room'];
                        $base_capacity = $meta[0]['base_capacity'];
                        $area = $meta[0]['The_area_of_meter'];
                        $totalarea = $meta[0]['total_area_of_building_meter'];

                        if ($room_number > 0) {
                            $room_numbers = $room_number . '&nbspاتاق';
                        } else {
                            $room_numbers = 'بدون اتاق';
                        }

                        $amu['image_url'][] = $image[0];
                        $amu_r = array_reverse($amu['image_url']);
                        ?>
                            <figure style="<?php echo ($index >= 10) ? 'display: none  !important ;' : ''; ?>" class="villa-item" itemscope="" itemtype="http://schema.org/SingleFamilyResidence">
                                <a rel="bookmark" href="<?php echo get_the_permalink($row->ID) ?>" title="<?php echo $row->post_title ?>" itemscope="" itemtype="http://schema.org/ImageObject" itemprop="photo">
                                    <img itemprop="image" class="lazy initial loaded" data-original="<?php echo $image[0]; ?>" alt="<?php echo $row->post_title ?>" src="<?php echo $image[0]; ?>" data-was-processed="true">
                                    <meta itemprop="url" content="<?php echo get_the_permalink($row->ID) ?>">
                                    <meta itemprop="contentUrl" content="<?php echo $image[0]; ?>">
                                </a>
                                <figcaption>
                                    <meta itemprop="name" content="<?php echo $row->post_title ?>">
                                    <h2><a rel="bookmark" href="<?php echo get_the_permalink($row->ID) ?>" title="<?php echo $row->post_title ?>">
                                            <?php echo $row->post_title ?>
                                        </a></h2>
                                    <?php
                                    $no_city = sizeof($item_city);
                                    $i = 1;
                                    foreach ($item_city as $item) {
                                        $class = ($i == 1) ? 'city' : 'city2';
                                        $separator = ($i > 1) ? '، ' : '';
                                        ?>
                                        <a href="https://fastvilla.ir/city/<?php echo $item->name; ?>" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                                            <meta itemprop="addressCountry" content="Iran">
                                            <span itemprop="addressLocality" class="<?php echo $class; ?>"><i class="main-icons pin"></i><?php echo $separator . $item->name; ?></span>
                                        </a>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    <div class="price-box">
                                        <div class="item_price">
                                            <?php
                                            if ($meta['off_price'] != 0 || $meta['off_price'] != '') {
                                                ?>
                                                <span class="dis_span"><?php echo number_format($meta['off_price']) ?></span>
                                                <del class="p_span"><?php echo number_format($meta['price']) ?></del><span class="currency"> تومان / هرشب </span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="p_span"><?php echo number_format($meta['price']) ?></span><span class="currency"> تومان / هرشب </span>
                                                <?php
                                            }
                                            if ($meta['reserve_type'] == 0) {
                                                ?>
                                                <div class="hotel_item_act d_flex mr10">
                                                    <span class="hia_bag"> <i class="fa-solid fa-bolt"></i>رزرو آنی</span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tools">
                                        <?php
                                        $selectedCount = 0;
                                        $keywords = ["استخر", "جکوزی", "سونا بخار", "سونا خشک", "wifi", "بیلیارد", "آلاچیق", "فوتبال", "فضای سبز", "بالکن", "آسانسور", "برق", "آب"];

                                        foreach ($keywords as $keyword) {
                                            foreach ($tools as $row) {
                                                if ($selectedCount >= 6) {
                                                    break;
                                                }
                                                if (strpos($row->name, $keyword) !== false) {
                                                    $tools_image = get_term_meta($row->term_id, 'term_image', true);
                                                    echo '<img src="' . $tools_image . '">';
                                                    $selectedCount++;
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                    <ul class="extra-info" style="margin-top: 1em;">
                                        <li class="footer-card">
                                            <span><?php echo $room_number ?></span>
                                            <span>اتاق</span>
                                        </li>
                                        <li class="footer-card">
                                            <?php
                                            if ($meta2[0]["base_capacity"] == $meta2[0]["total_capacity"]) {
                                                echo '<span>' . $meta2[0]["total_capacity"] . '</span><span> نفر </span>';
                                            } else {
                                                echo '<span>' . $meta2[0]["base_capacity"] . ' ~ ' . $meta2[0]["total_capacity"] . '</span><span> نفر </span>';
                                            }
                                            ?>
                                        </li>
                                        <li class="footer-card">
                                            <span><?php echo $meta2[0]["total_area_of_building_meter"]; ?></span>
                                            <span> متر </span>
                                        </li>
                                        <li class="footer-card">
                                            <span><?php echo number_format($meta2[0]["extra_person"]); ?></span>
                                            <span>نفر اضافی </span>
                                        </li>
                                    </ul>
                                </figcaption>
                            </figure>
                        <?php
                    }
                    ?>
                </div>
                <button id="loadMoreButton" class="loadMoreButton btn-grab">بارگذاری بیشتر</button>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                var visibleCards = 10;
                var totalCards = <?php echo count($posts); ?>;

                $('#archive_box article:lt(' + visibleCards + ')').show();

                $('#loadMoreButton').click(function () {
                    visibleCards += 10;
                    if (visibleCards >= totalCards) {
                        $('#loadMoreButton').hide();
                    }
                    $('#archive_box figure:lt(' + visibleCards + ')').show();
                });
            });
        </script>



        <script>

            var swiper = new Swiper(".seo_slider<?php  echo $rand?>", {
                slidesPerView: 4.5,
                spaceBetween: 30,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper_que_but_next<?php  echo $rand?>',
                    prevEl: '.swiper_que_but_prev<?php  echo $rand?>',
                },
                breakpoints: {

                    300: {
                        slidesPerView: 1.2,
                        spaceBetween: 10,
                    },
                    400: {
                        slidesPerView: 1.2,
                        spaceBetween: 10,
                    },

                    750: {
                        slidesPerView: 4.5,
                        spaceBetween: 10,
                    },

                    1200: {
                        slidesPerView: 4.5,
                        spaceBetween: 30,
                    },
                    1400: {
                        slidesPerView: 4.5,
                        spaceBetween: 30,
                    },
                    1500: {
                        slidesPerView: 5.5,
                        spaceBetween: 30,
                    },
                    1920: {
                        slidesPerView: 5.5,
                        spaceBetween: 30,
                    },
                }
            });


        </script>
    <?php }

    protected function content_template() {

    }
}


\Elementor\Plugin::instance()->widgets_manager->register( new seo_slider() );

