<?php

if(!function_exists('post_get')){
	function post_get(?string $i = null): array|string
	{
        global $_REQUEST;
        if (!is_null($i)){
			$post = trim($_REQUEST[$i]);
			if(is_string($post)){
				$result =  addslashes(trim($_REQUEST[$i]));
				$result =  strip_tags($result);
			}else{
				$result = $post;
			}
			return $result;
		}else{
			return $_REQUEST;
		}
	}
}
if(!function_exists('get')){
	function get(?string $i = null): mixed
	{
        global $_GET;
		$result = null;
		if(isset($_GET[$i])) {
			if (!is_null($i)) {
				$get = trim($_GET[$i]);
				if (is_string($i)) {
					$result = trim($_GET[$i]);
					$result = strip_tags($result);
					$result = html_entity_decode($result);
					$result = urldecode($result);
					$result = addslashes($result);
				} else {
					$result = $get;
				}
			} else {
				$result = $_GET;
			}
		}
		return $result;
	}
}
if(!function_exists('post')){
	function post(?string $i = null): array|string
	{
        global $_POST;
		if (!is_null($i)){
			$post = trim($_POST[$i]);
			if(is_string($post)){
				$result =  addslashes(trim($_POST[$i]));
				$result =  strip_tags($result);
			}else{
				$result = $post;
			}
			return $result;
		}else{
			return $_POST;
		}
	}
}
if(!function_exists('escape')){
	function escape(?string $i = null): string
    {
        global $db;
		return $db->escape($i);
	}
}
if (!function_exists('protect_html')) {
	function protect_html(?string $str): string
    {    
	    return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}
}
if (!function_exists('set_page'))
{
	function set_page(?string $i = null): string
    {    
        global $_SESSION;
	    return $_SESSION['web']['page'] = $i;
	}
}
if (!function_exists('get_page')) {
	function get_page(): ?string
    {    
	    return (isset($_SESSION['web']['page']) AND $_SESSION['web']['page']) ? $_SESSION['web']['page'] : null;
	}
}
if (!function_exists('base_url')) {
	function base_url(?string $i = null): ?string
    {    
        global $config;
		$i = str_replace('.', '/', $i ?? '');
	    return $config['base']['url'] . $i;
	}
}
if (!function_exists('site_url')) {
	function site_url(?string $i = null): ?string
    {    
        global $config;
	    return $config['base']['url'] . $i;
	}
}
if (!function_exists('asset')) {
	function asset(?string $i = null): ?string
    {    
		global $config;
	    return $config['base']['url'] . 'assets/' . $i;
	}
}
if (!function_exists('redirect')) {
    function redirect(?string $location = null, int $delay = 0): string 
	{
        if($delay == 0) return header("Location: $location");
        return print "<meta http-equiv=\"refresh\" content=\"$delay;url=$location\">";
    }
}
if (!function_exists('flashdata')) {
    function flashdata(array $data): array {
		global $_SESSION;
        $_SESSION['result'] = $data;
        return $_SESSION['result'];
    }
}
if (!function_exists('alert')) {
    function alert()
	{
		global $_SESSION;
        if (isset($_SESSION['result']) AND is_array($_SESSION['result'])) {
			print "<div class=\"alert alert-" . $_SESSION['result']['alert'] . " alert-dismissible fade show\" role=\"alert\">
				<strong>" . $_SESSION['result']['title'] . "</strong> " . $_SESSION['result']['msg'] . "
				<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
			</div>";
			unset($_SESSION['result']);
		}
    }
}
if (!function_exists('nestedLowercase')) {
    function nestedLowercase($value) {
		if (is_array($value)) {
			return array_map('nestedLowercase', $value);
		}
		return strtolower($value);
	}
}
