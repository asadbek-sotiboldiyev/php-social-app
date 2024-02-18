<?php
function is_followed($follower_id, $profile_id, $db){
    $query = $db->prepare("SELECT * FROM follows WHERE follower_id = :follower_id and profile_id = :profile_id");
    $query->execute([
        "follower_id" => $follower_id,
        "profile_id" => $profile_id
    ]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if($result == false)
        return false;
    else
        return true;
}

function unfollow($follower_id, $profile_id, $db){
    $query = $db->prepare("DELETE FROM follows WHERE `follower_id` = :follower_id and `profile_id` = :profile_id");
    $query->execute([
        "follower_id" => $follower_id,
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE profiles SET followers = followers - 1 WHERE id = :profile_id");
    $query->execute([
        "profile_id" => $profile_id
    ]);
    $query = $db->prepare("UPDATE profiles SET following = following - 1 WHERE id = :follower_id");
    $query->execute([
        "follower_id" => $follower_id
    ]);
}
function follow($follower_id, $profile_id, $db){
    if(is_followed($follower_id, $profile_id, $db)){
        unfollow($follower_id, $profile_id, $db);
    }else{
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
}

?>