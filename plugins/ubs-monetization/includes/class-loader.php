<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UBS_Monet_Loader {

    public function __construct() {
        $this->load_dependencies();
    }

    private function load_dependencies() {
        require_once UBS_MONET_PATH . 'includes/core/class-paid-access.php';
        require_once UBS_MONET_PATH . 'includes/core/class-paywall-template.php';
        require_once UBS_MONET_PATH . 'includes/payments/class-token-manager.php';
        require_once UBS_MONET_PATH . 'includes/payments/class-stripe-link.php';
        require_once UBS_MONET_PATH . 'includes/ads/class-ads-manager.php';
    }

    public function run() {
        new UBS_Paid_Access();
        new UBS_Token_Manager();
        new UBS_Stripe_Link();
        new UBS_Ads_Manager();
    }
}
