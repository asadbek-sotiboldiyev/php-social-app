<?php
function follow($follower_id, $profile_id, $db){
    $query = $db->prepare("INSERT INTO follows (`follower_id`, `profile_id`) VALUES (:follower_id, :profile_id)");
    $query->execute([
        "follower_id" => $follower_id,
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE profiles SET followers = followers + 1 WHERE id = :profile_id");
    $query->execute([
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE profiles SET following = following + 1 WHERE id = :follower_id");
    $query->execute([
        "follower_id" => $follower_id
    ]);
}
?>