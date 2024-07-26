<?php
/*
Plugin Name: PMPro Customizations
Plugin URI: https://www.paidmembershipspro.com/wp/pmpro-customizations/
Description: Customizations for my Paid Memberships Pro Setup
Version: .1
Author: Paid Memberships Pro
Author URI: https://www.paidmembershipspro.com
*/
//check if codes have been used already
function my_pmpro_check_discount_code($okay, $dbcode, $level_id, $code){
	global $current_user;
	global $wpdb;
	global $pmpro_msg, $pmpro_msgt;
	$sponsor_code_id = pmprosm_getCodeByUserID($current_user->ID); 
	$data_acsuess_code = get_user_meta($current_user->ID,'other_discount_code',true);
		
	$code_code_discount_code = $wpdb->get_results($wpdb->prepare("SELECT id FROM $wpdb->pmpro_discount_codes WHERE code = '" .$_REQUEST['discount_code']."'"));
	foreach($code_code_discount_code as $rcode_discount_code){
		
		$used_Code_query = $wpdb->get_row("SELECT * FROM $wpdb->pmpro_discount_codes_uses WHERE `code_id` = ". $rcode_discount_code->id." and `user_id`=". $current_user->ID." LIMIT 1");
		if( count($used_Code_query->id) > 0  || $data_acsuess_code == $_REQUEST['discount_code']){
			$pmpro_msgt = 'pmpro_error';
			return $pmpro_msg  = 'This access code has already been used.';
			
 
			$value = false;
		}
	}
	return $okay;
}
add_filter('pmpro_check_discount_code', 'my_pmpro_check_discount_code', 10, 4);