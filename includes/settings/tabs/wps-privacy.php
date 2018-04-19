<?php
if ($wps_nonce_valid) {
    $wps_option_list = array(
        'wps_allow_opt_out',
        'wps_hash_ips',
        'wps_store_ua',
        'wps_all_online',
    );

    // If the IP hash's are enabled, disable storing the complete user agent.
    if (array_key_exists('wps_hash_ips', $_POST)) {
        $_POST['wps_store_ua'] = '';
    }

    foreach ($wps_option_list as $option) {
        if (array_key_exists($option, $_POST)) {
            $value = $_POST[$option];
        } else {
            $value = '';
        }
        $new_option = str_replace("wps_", "", $option);
        $WP_Statistics->store_option($new_option, $value);
    }
}
?>
    <script type="text/javascript">
        function ToggleShowHitsOptions() {
            jQuery('[id^="wps_show_hits_option"]').fadeToggle();
        }
    </script>

    <table class="form-table">
        <tbody>
        <tr valign="top">
            <th scope="row" colspan="2"><h3><?php _e('Privacy and Data Protection', 'wp-statistics'); ?></h3></th>
        </tr>

        <tr valign="top">
            <th scope="row">
                <label for="allow_opt_out"><?php _e('Allow Opt-out', 'wp-statistics'); ?>:</label>
            </th>

            <td>
                <input id="allow_opt_out" type="checkbox" value="1"
                       name="wps_allow_opt_out" <?php echo $WP_Statistics->get_option('allow_opt_out') == true
                    ? "checked='checked'" : ''; ?>>
                <label for="allow_opt_out"><?php _e('Enable', 'wp-statistics'); ?></label>

                <p class="description"><?php echo sprintf(__('If you are in the Europe Union and want to comply with the <a href="%s">GDPR (General Data Protection Regulation)</a> rules, enable this option to show confirmation message for the visitors.', 'wp-statistics'), 'https://en.wikipedia.org/wiki/General_Data_Protection_Regulation'); ?></p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <label for="hash_ips"><?php _e('Hash IP Addresses', 'wp-statistics'); ?>:</label>
            </th>

            <td>
                <input id="hash_ips" type="checkbox" value="1"
                       name="wps_hash_ips" <?php echo $WP_Statistics->get_option('hash_ips') == true
                    ? "checked='checked'" : ''; ?>>
                <label for="hash_ips"><?php _e('Enable', 'wp-statistics'); ?></label>

                <p class="description"><?php _e(
                        'This feature will not store IP addresses in the database but instead used a unique hash.  The "Store entire user agent string" setting will be disabled if this is selected.  You will not be able to recover the IP addresses in the future to recover location information if this is enabled.',
                        'wp-statistics'
                    ); ?></p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <label for="store_ua"><?php _e('Store entire user agent string', 'wp-statistics'); ?>:</label>
            </th>

            <td>
                <input id="store_ua" type="checkbox" value="1"
                       name="wps_store_ua" <?php echo $WP_Statistics->get_option('store_ua') == true
                    ? "checked='checked'" : ''; ?>>
                <label for="store_ua"><?php _e('Enable', 'wp-statistics'); ?></label>

                <p class="description"><?php _e('Only enabled for debugging. (If the IP hash\'s are enabled, This option disabling automatically.)', 'wp-statistics'); ?></p>
            </td>
        </tr>
        </tbody>
    </table>

<?php submit_button(__('Update', 'wp-statistics'), 'primary', 'submit');