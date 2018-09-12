<?php

class MCvideoDao {

    public function addVideo($conn, $vti, $des, $ytid) {
        $fields = "(title, description, youtube_id)";
        $values = "('$vti', '$des', $ytid)";

        $query = "INSERT INTO video " . $fields . " VALUES " . $values;
        mysqli_query($conn, $query);
    }
    
    public function countAllVideos($conn) {
        $query = "SELECT COUNT(vid) FROM video";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['COUNT(vid)'];
        } else {
            return 0;
        }
    }
    
    public function getMaxId($conn) {
        $query = "SELECT MAX(vid) FROM video";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['MAX(vid)'];
        } else {
            return 0;
        }
    }
    
    public function hasVideoByYtid($conn, $ytid) {
        $query = "SELECT vid FROM video WHERE youtube_id = $ytid";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $vid = $row['vid'];

            if ($vid > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    
    public function getYoutubeIdById($conn, $vid) {
        $query = "SELECT youtube_id FROM video WHERE vid = $vid";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['youtube_id'];
        } else {
            return "";
        }
    }
    
}

?>