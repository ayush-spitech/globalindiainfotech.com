<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('assets')) {

	function assets() {
		echo config_item('assets');
	}
}

if (!function_exists('media_path')) {

	function media_path() {
		echo config_item('media_path');
	}
}

if (!function_exists('media_url')) {

	function media_url() {
		echo config_item('media_url');
	}
}
if (!function_exists('admin_url')) {
	function admin_url() {
		return base_url().'admin/';
	}
}
if (!function_exists('site_assets')) {
	function site_assets() {
		echo base_url().config_item('site_assets').'/';
	}
}

?>