<?php

// Post table
function get_post_by_author_id($id, $db){
	$query = $db->prepare("SELECT * FROM posts WHERE author_id = :id");
	$query->execute([
		"id" => $id
	]);
	$posts = $query->fetchAll(PDO::FETCH_ASSOC);
	return $posts;
}
function create_post($author_id, $text, $photo = '0', $db){
	if($photo != '0'){
		$query = $db->prepare("INSERT INTO posts (`author_id`, `text`, `photo`, `date`) VALUES (:author_id, :text, :photo, :date)");
		$query->execute([
			"author_id" => $author_id,
			"text" => $text,
			"photo" => $photo,
			"date" => date("d-m-Y H:i")
		]);
	}else{
		$query = $db->prepare("INSERT INTO posts (`author_id`, `text`, `date`) VALUES (:author_id, :text, :date)");
		$query->execute([
			"author_id" => $author_id,
			"text" => $text,
			"date" => date("d-m-Y H:i")
		]);
	}
}
?>