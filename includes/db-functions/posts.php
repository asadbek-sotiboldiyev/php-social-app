<?php

// Post table
function get_posts_by_author_id($id, $db){
	$query = $db->prepare("SELECT * FROM posts WHERE author_id = :id ORDER BY id DESC");
	$query->execute([
		"id" => $id
	]);
	$posts = $query->fetchAll(PDO::FETCH_ASSOC);
	return $posts;
}
function get_posts_author_in_list($profiles, $db){
	$query = $db->query("SELECT * FROM posts WHERE author_id in ($profiles) ORDER BY date DESC LIMIT 60");
	$posts = $query->fetchAll(PDO::FETCH_ASSOC);
	return $posts;
}
function create_post($author_id, $text, $photo, $db){
	$query = $db->prepare("INSERT INTO posts (`author_id`, `text`, `photo`, `date`) VALUES (:author_id, :text, :photo, :date)");
	$query->execute([
		"author_id" => $author_id,
		"text" => $text,
		"photo" => $photo,
		"date" => date("d-m-Y H:i")
	]);
}
?>