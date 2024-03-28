<?php
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // اگر به صورت مستقیم دسترسی نداشته باشد، خروج کنید.
}

class seo_article extends \Elementor\Widget_Base {

    public function get_name() {
        return 'article_wrapper';
    }

    public function get_title() {
        return __('Article Wrapper', 'your-text-domain');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'your-text-domain'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('عنوان پیش‌فرض', 'your-text-domain'),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<article class="article_box">';

        echo '<header class="Article_title_box">';
        $title = esc_html($settings['title']);
        $title = str_replace('&nbsp;', '', $title);


        echo '<h1 class="Article_title">'.$title.'</h1>';
        $ratingCount = rand(123, 1143);
        $ratingValue = mt_rand(360, 500) / 100; // Generating a random float between 3.6 and 5
        echo  "<!--Structured data -->";
        echo '<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "aggregateRating": {
    "@type": "AggregateRating",
    "bestRating": "5",
    "ratingCount": "' . $ratingCount . '",
    "ratingValue": "' . $ratingValue . '"
  },
  "image": "' . esc_url($settings['image']['url']) . '",
  "name": "' . $title . '"
  "description":"' . $title . '"
}
</script>';
        echo '</header>';

        // Display the image
        if (!empty($settings['image']['url'])) {
            echo '<figure class="ArticleCover__Figure-cm7soo-0 jZsjtR">';
            echo '<img class="Article_figure" src="' . esc_url($settings['image']['url']) . '" alt="Image">';
            echo '</figure>';
        }

        // Display the content within the article tag
        echo '<div class="article-content">';
        echo wp_kses_post($settings['content']);
        echo '</div>';

        echo '</article>';
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new seo_article());
