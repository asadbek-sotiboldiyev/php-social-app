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
function update_profile($current_username, $username, $photo, $bio,  $db){
	$query = $db->prepare("UPDATE  profiles SET photo = :photo, username = :username, bio = :bio WHERE username = :cuurent_username");
	$query->execute([
		'photo' => $photo,
		'username' => $username,
		'bio' => $bio,
		'current_username' => $current_username
	]);
}
?>