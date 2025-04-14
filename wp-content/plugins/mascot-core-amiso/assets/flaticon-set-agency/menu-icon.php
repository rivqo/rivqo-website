<?php
/**
 * Add these flaticons to megamenu
 */
if(!class_exists("Mascot_Menuiconpicker_Add_Flaticon_to_Megamenu")) {
    class Mascot_Menuiconpicker_Add_Flaticon_to_Megamenu {
        public function __construct($data = [], $args = null) {
            add_filter("mascot_mega_menu/get_icons", array($this, 'icon_list'));
            add_action( 'wp_enqueue_scripts', array($this, 'add_flaticon_style'));
            add_action( 'admin_enqueue_scripts', array($this, 'add_flaticon_style'));
        }

        public function icon_list($icons){
            $custom_icons = [
                'Flaticon Pack' => array(
                    array("flaticon-agency-discuss"  => "flaticon-agency-discuss"),
                    array("flaticon-agency-color-sample"  => "flaticon-agency-color-sample"),
                    array("flaticon-agency-front-end"  => "flaticon-agency-front-end"),
                    array("flaticon-agency-online-shopping"  => "flaticon-agency-online-shopping"),
                    array("flaticon-agency-repair"  => "flaticon-agency-repair"),
                    array("flaticon-agency-instructor"  => "flaticon-agency-instructor"),
                    array("flaticon-agency-search-engine"  => "flaticon-agency-search-engine"),
                    array("flaticon-agency-trophy"  => "flaticon-agency-trophy"),
                    array("flaticon-agency-medal"  => "flaticon-agency-medal"),
                    array("flaticon-agency-satisfaction"  => "flaticon-agency-satisfaction"),
                    array("flaticon-agency-design"  => "flaticon-agency-design"),
                    array("flaticon-agency-user-interface"  => "flaticon-agency-user-interface"),
                    array("flaticon-agency-campaign"  => "flaticon-agency-campaign"),
                    array("flaticon-agency-reputation"  => "flaticon-agency-reputation"),
                    array("flaticon-agency-coffee"  => "flaticon-agency-coffee"),
                    array("flaticon-agency-social-campaign"  => "flaticon-agency-social-campaign"),
                    array("flaticon-agency-advertising"  => "flaticon-agency-advertising"),
                    array("flaticon-agency-quotes"  => "flaticon-agency-quotes"),
                    array("flaticon-agency-web"  => "flaticon-agency-web"),
                    array("flaticon-agency-android-logo"  => "flaticon-agency-android-logo"),
                    array("flaticon-agency-television"  => "flaticon-agency-television"),
                    array("flaticon-agency-design-1"  => "flaticon-agency-design-1"),
                    array("flaticon-agency-lamp"  => "flaticon-agency-lamp"),
                    array("flaticon-agency-brain"  => "flaticon-agency-brain"),
                    array("flaticon-agency-concept"  => "flaticon-agency-concept"),
                    array("flaticon-agency-programmer"  => "flaticon-agency-programmer"),
                    array("flaticon-agency-access"  => "flaticon-agency-access"),
                    array("flaticon-agency-verification"  => "flaticon-agency-verification"),
                    array("flaticon-agency-phone-call"  => "flaticon-agency-phone-call"),
                    array("flaticon-agency-open-envelope"  => "flaticon-agency-open-envelope"),
                    array("flaticon-agency-phone-ringing"  => "flaticon-agency-phone-ringing"),
                    array("flaticon-agency-help"  => "flaticon-agency-help")
                ),
            ];
            $icons = array_merge($custom_icons, $icons);
            return $icons;
        }
        function add_flaticon_style() {
            wp_enqueue_style( 'flaticon-set-agency', MASCOT_CORE_AMISO_URL_PATH . 'assets/flaticon-set-agency/style.css' );
        }
    }
    new Mascot_Menuiconpicker_Add_Flaticon_to_Megamenu();
}