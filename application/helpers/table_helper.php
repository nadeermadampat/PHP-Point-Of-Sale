<?php
/*
Gets the html table to manage customers.
*/
function get_customer_manage_table($customers)
{
	$CI =& get_instance();
	
	$CI->table->set_template(get_sortable_table_template());
	$CI->table->set_heading('<input type="checkbox" id="select_all" />', 
	$CI->lang->line('common_last_name'),
	$CI->lang->line('common_first_name'),
	$CI->lang->line('common_email'),
	$CI->lang->line('common_phone_number'),
	'&nbsp');
	
	foreach($customers as $customer)
	{
		$checkbox = "<input type='checkbox' id='customer_$customer->id' value='$customer->id'/>";
		$CI->table->add_row($checkbox,$customer->last_name,$customer->first_name,
		mailto($customer->email),$customer->phone_number,
		anchor("customers/edit/$customer->id", $CI->lang->line('common_edit'),array('class'=>'thickbox')));
	}
	
	$output = $CI->table->generate();
	$CI->table->clear();
	
	if(count($customers)==0)
	{
		$output.="<div class='warning_message' style='text-align:center;'>".$CI->lang->line('customers_no_customers_to_display')."</div>";
	}
	return $output;
}
?>