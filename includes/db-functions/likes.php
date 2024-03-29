<?php
function is_liked($post_id, $profile_id, $db){
    $query = $db->prepare("SELECT * FROM likes WHERE post_id = :post_id and profile_id = :profile_id");
    $query->execute([
        'post_id' =>$post_id,
        'profile_id' =>$profile_id
    ]);
    $like = $query->fetch(PDO::FETCH_ASSOC);
    if($like == false)
        return false;
    else
        return true;
}

function dislike($post_id, $profile_id, $db){
    $query = $db->prepare("DELETE FROM likes WHERE post_id = :post_id and profile_id = :profile_id");
    $query->execute([
        "post_id" => $post_id,
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE posts SET likes = likes - 1 WHERE id = :id");
    $query->execute([
        'id' => $post_id
    ]);
}

function like($post_id, $profile_id, $db){
    if(is_liked($post_id, $profile_id, $db)){
        dislike($post_id, $profile_id, $db);
    }else{
        $query = $db->prepare("INSERT INTO likes (`post_id`, `profile_id`) VALUES (:post_id, :profile_id)");
        $query->execute([
            "post_id" => $post_id,
            "profile_id" => $profile_id
        ]);
        $query = $db->prepare("UPDATE posts SET likes = likes + 1 WHERE id = :id");
        $query->execute([
            'id' => $post_id
        ]);
    }
}

function get_likes_count($db){
	$query = $db->prepare("SELECT COUNT(*) FROM likes");
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	return $result["COUNT(*)"];
}

?>