<?php

namespace WP_SPlus_Inc\Base;

class FinancialTransaction 
{
    function register() {
        add_shortcode('get_financial_transactions_from_summary', array($this, 'get_financial_transactions_from_summary'));
    }

    function get_financial_transactions_from_summary() {
        if (is_user_logged_in()) {
            // Getting the current username
            $username = wp_get_current_user() -> user_login;
            // Getting the server
            $server = get_option('wp-splus-server');
            // Getting the general settings
            $settings = get_option('wp-splus-settings');
            // The financial transactions field value can't be left blank
            if (empty($settings['default_financial_transactions_type_code'])) return;
            // The address field value can't be left blank
            if (empty($server['server_address'])) return;
            // Fetch data
            $response = wp_remote_get($server['server_address']
                .'/api/v1/crm/form/all?subject='. $username 
                .'&typeCode=' . $settings['default_financial_transactions_type_code']);
            // Retrieve response code and check status code is 200 
            if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) == 200) 
            {
                ?>
                <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders">
                    <thead>
                        <tr>
                            <th class="woocommerce-orders-table__header"><span class="nobr">نوع</span></th>
                            <th class="woocommerce-orders-table__header"><span class="nobr">عنوان</span></th>
                            <th class="woocommerce-orders-table__header"><span class="nobr">شماره</span></th>
                            <th class="woocommerce-orders-table__header"><span class="nobr">تاریخ</span></th>
                            <th class="woocommerce-orders-table__header"><span class="nobr">بدهکاری</span></th>
                            <th class="woocommerce-orders-table__header"><span class="nobr">بستانکاری</span></th>
                            <th class="woocommerce-orders-table__header"><span class="nobr"></span></th>
                        </tr>
                    </thead>
		            <tbody>
						<?php
                            $data = json_decode($response['body']);
                            if (!empty($data)) {
                                usort($data, function ($a, $b)
                                {
                                    return strcmp($b -> extendedProperties -> FinancialDate, 
                                        $a -> extendedProperties -> FinancialDate);
                                });
                            }
                            foreach ($data as $item) {?>
                            <tr class="woocommerce-orders-table__row">
                                <td class="woocommerce-orders-table__cell"><?php echo $item -> extendedProperties -> Type ?></td>
                                <td class="woocommerce-orders-table__cell"><?php echo $item -> extendedProperties -> Subject ?></td>
                                <td class="woocommerce-orders-table__cell"><?php echo $item -> extendedProperties -> Number ?></td>
                                <td class="woocommerce-orders-table__cell"><?php echo $item -> extendedProperties -> FinancialDate ?></td>
                                <td class="woocommerce-orders-table__cell"><?php echo $item -> extendedProperties -> Debit ?></td>
                                <td class="woocommerce-orders-table__cell"><?php echo $item -> extendedProperties -> Credits ?></td>
                                <td class="woocommerce-orders-table__cell">
                                    <a <?php empty($item -> extendedProperties -> LinkPreview) ? 'disabled' : '' ?> href="<?php echo $item -> extendedProperties -> LinkPreview ?>">
                                        پیش نمایش
                                    </a>
                                </td>
                            </tr>
                        <?php }?>
					</tbody>
	            </table>
                <?php    
            }
            else 
                return '';
        }
    }
}