<?php

// Profile table
function get_profiles($db){
	$profiles = $db->query("SELECT * FROM profiles");
	$profiles = $profiles->fetchAll(PDO::FETCH_ASSOC);
	return $profiles;
}
function get_profile_by_id($id, $db){
	$profile = $db->query("SELECT * FROM profiles WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
	return $profile;
}
function get_profile_by_username($username, $db){
	$profile = $db->query("SELECT * FROM profiles WHERE username = '$username';")->fetch(PDO::FETCH_ASSOC);
	return $profile;
}
?>