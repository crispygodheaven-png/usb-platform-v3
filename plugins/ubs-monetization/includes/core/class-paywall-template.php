<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class UBS_Paywall_Template {

    public static function render($purchase_link) {

        ob_start();
        ?>

        <div class="ubs-paywall">
            <h3>This chapter is Premium</h3>
            <p>You must purchase or unlock to continue reading.</p>
            <?php if ($purchase_link): ?>
                <a class="button button-primary" href="<?php echo esc_url($purchase_link); ?>">Purchase Access</a>
            <?php endif; ?>
        </div>

        <?php
        return ob_get_clean();
    }
}
