<?php
namespace Elementor;

defined( 'ABSPATH' ) || die();

class Plumco_Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_plumco_icons_tab' ] );
    }

    public static function add_plumco_icons_tab( $tabs ) {
        $tabs['plumco-icons'] = [
            'name' => 'plumco-icons',
            'label' => __( 'Plumco Icons', 'plumco-elementor-addons' ),
            'url' => PLUMCO_PLUGIN_URL . 'elementor/assets/css/flaticon.css',
            'enqueue' => [ PLUMCO_PLUGIN_URL . 'elementor/assets/css/flaticon.css' ],
            'prefix' => 'flaticon-',
            'displayPrefix' => 'fi',
            'labelIcon' => 'flaticon-standard',
            'ver' => '1.0.0',
            'fetchJson' => PLUMCO_PLUGIN_URL . 'elementor/assets/js/plumco-icons.js?v=1.0.0',
            'native' => false,
        ];
        return $tabs;
    }

    /**
     * Get a list of plumco icons
     *
     * @return array
     */
    public static function get_plumco_icons() {
        return [
            'flaticon-business' => 'business',
            'flaticon-calendar-1'  => 'calendar-1',
            'flaticon-calendar' => 'calendar',
            'flaticon-comment-white-oval-bubble' => 'comment-white-oval-bubble',
            'flaticon-edit' => 'edit',
            'flaticon-email' => 'email',
            'flaticon-house' => 'house',
            'flaticon-lamp' => 'lamp',
            'flaticon-left-quote' => 'left-quote',
            'flaticon-location' => 'location',
            'flaticon-magnifiying-glass' => 'magnifiying-glass',
            'flaticon-medal' => 'medal',
            'flaticon-phone-call' => 'phone-call',
            'flaticon-pinterest' => 'pinterest',
            'flaticon-placeholder' => 'placeholder',
            'flaticon-play' => 'play',
            'flaticon-pinterest' => 'pinterest',
            'flaticon-right-arrow' => 'right-arrow',
            'flaticon-send' => 'send',
            'flaticon-startup' => 'startup',
            'flaticon-stats' => 'stats',
            'flaticon-telephone' => 'telephone',
            'flaticon-trophy' => 'trophy',
            'flaticon-user' => 'user',
        ];
    }
}

Plumco_Icons_Manager::init();