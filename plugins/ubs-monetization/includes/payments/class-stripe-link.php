<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UBS_Stripe_Link {

    public function __construct() {
        add_action('show_user_profile', [$this, 'stripe_field']);
        add_action('edit_user_profile', [$this, 'stripe_field']);
        add_action('personal_options_update', [$this, 'save_stripe']);
        add_action('edit_user_profile_update', [$this, 'save_stripe']);
    }

    public function stripe_field($user) {
        ?>
        <h3>Stripe Payment Link</h3>
        <table class="form-table">
            <tr>
                <th><label>Stripe Link</label></th>
                <td>
                    <input type="url" name="ubs_stripe_link"
                    value="<?php echo esc_attr(get_user_meta($user->ID, '_ubs_stripe_link', true)); ?>"
                    class="regular-text" />
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_stripe($user_id) {
        if (current_user_can('edit_user', $user_id)) {
            update_user_meta($user_id, '_ubs_stripe_link', esc_url_raw($_POST['ubs_stripe_link']));
        }
    }
}
