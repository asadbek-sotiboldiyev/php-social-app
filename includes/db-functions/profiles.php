<?php

// Profile table
function get_top_profiles($followings, $user_id, $db){
	$query = $db->prepare("SELECT *
		FROM profiles
		WHERE NOT id IN ($followings) and not id = $user_id
		ORDER BY followers DESC
		LIMIT 10;
	");
	$query->execute();
	$profiles = $query->fetchAll(PDO::FETCH_ASSOC);
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
function update_profile($current_username, $username, $photo = "/media/profile-img/default.jpg", $db){
	$query = $db->prepare("UPDATE  profiles SET photo = :photo, username = :username WHERE username = :current_username");
	$query->execute([
		'photo' => $photo,
		'username' => $username,
		'current_username' => $current_username
	]);
	$query = $db->prepare("UPDATE  users SET username = :username WHERE username = :current_username");
	$query->execute([
		'username' => $username,
		'current_username' => $current_username
	]);
}
function check_username_free($username, $db){
	$profile = get_profile_by_username($username, $db);
	if($profile == false)
		return true;
	else
		return false;
}
?>