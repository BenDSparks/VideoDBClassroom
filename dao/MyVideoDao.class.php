<?php

class MyVideoDao {
    
    
    public function getVideoWatching($conn, $myusn){
        
        $query = "SELECT watching FROM user_count WHERE ucid = ". $myusn;
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['watching'];
        } else {
            return -1;
        }
    }
    
    public function setVideoWatching($conn, $myusn, $videoBeingWatched){
        
        $query = "UPDATE user_count SET watching = ".$videoBeingWatched." WHERE ucid = ".$myusn;
        mysqli_query($conn, $query);
        
    }

    public function getInstructorVideo($conn){

    $query = "SELECT watching FROM user_count WHERE instructor = 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['watching'];
    } else {
        return -1;
    }
    
}
    
    
    
    
    
    
    
}
