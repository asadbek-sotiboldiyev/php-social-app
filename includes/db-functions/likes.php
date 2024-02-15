<?php
function is_liked($post_id, $profile_id, $db){
    $query = $db->prepare("SELECT * FROM likes WHERE post_id = :post_id , profile_id = :profile_id");
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
function like($post_id, $profile_id, $db){
    $query = $db->prepare("INSERT INTO likes (`post_id`, `profile_id`) VALUES (:post_id, :profile_id)");
    $query->execute([
        "post_id" => $post_id,
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE profiles SET likes = likes + 1 WHERE id = :id");
    $query->execute([
        'id' => $profile_id
    ]);
function dislike($post_id, $profile_id, $db){
    $query = $db->prepare("DELETE FROM likes WHERE post_id = :post_id and profile_id = :profile_id");
    $query->execute([
        "post_id" => $post_id,
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE profiles SET likes = likes - 1 WHERE id = :id");
    $query->execute([
        'id' => $profile_id
    ]);
}
}
?>