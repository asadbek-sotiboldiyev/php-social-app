<?php

// Profile table
function get_top_profiles($followings, $user_id, $db){
	$query = $db->prepare("SELECT *
		FROM profiles
		WHERE NOT id IN ($followings) AND NOT id = :user_id
		ORDER BY followers DESC
		LIMIT 10
	");
	$query->execute([
		'user_id' => $user_id
	]);
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
function get_profiles_last_login($db){
	$query = $db->prepare("SELECT * FROM profiles ORDER BY last_login DESC LIMIT 30");
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}
function get_profiles_contains_username($username, $db){
	$query = $db->prepare("SELECT * FROM profiles WHERE username like '%$username%' order by followers desc limit 60");
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}
function update_profile($current_username, $username, $name, $photo = "/media/profile-img/default.jpg", $db){
	$query = $db->prepare("UPDATE  profiles SET photo = :photo, username = :username, name = :name WHERE username = :current_username");
	$query->execute([
		'photo' => $photo,
		'name' => $name,
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
function logged_in($username, $db){
	$query = $db->prepare("UPDATE profiles SET last_login = :last_login WHERE username = :username");
	$query->execute([
		'last_login' => date('d-m-Y H:i'),
		'username' => $username
	]);
}
function profile_ban($id, $db){
	
}
?>