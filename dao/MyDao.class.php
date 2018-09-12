<?php

class MyDao {
    
    //set instructor to passed user number
    public function setInstructor($conn, $myusn) {
        $query = "UPDATE user_count SET instructor = 1, watching = 0 WHERE ucid = " . $myusn;
        mysqli_query($conn, $query);
    }
  
    //check if the database has a instructor already
    public function checkInstructor($conn) {
        
        $query = "SELECT * FROM user_count WHERE instructor = 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            return 0;
        } else {
            return 1;
        }
        
    }
    

    public function amITheInstructor($conn, $myusn) {
        
        $query = "SELECT * FROM user_count WHERE instructor = 1 AND ucid = " . $myusn;
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            return 1;
        } else {
            return 0;
        }
        
    }

    
    public function addVideo($conn, $youtubetitle, $youtubeid){
           
        $query = "INSERT INTO video (title, youtube_id) VALUES ('". $youtubetitle ."' , '".$youtubeid."')";
        mysqli_query($conn, $query);
        
    }
    
    
    
    
    
    
    
    
    
    
}
















?>