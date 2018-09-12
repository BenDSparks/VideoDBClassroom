<?php

class CHmessageDao {

    public function addMessage($conn, $cont, $usn) {
        $fields = "(content, user_num)";
        $values = "('$cont', $usn)";

        $query = "INSERT INTO message " . $fields . " VALUES " . $values;
        mysqli_query($conn, $query);
    }
    
    public function countAllMessages($conn) {
        $query = "SELECT COUNT(mid) FROM message WHERE del = 0";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['COUNT(mid)'];
        } else {
            return 0;
        }
    }
    
    public function getMaxId($conn) {
        $query = "SELECT MAX(mid) FROM message WHERE del = 0";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            return $row['MAX(mid)'];
        } else {
            return 0;
        }
    }

    public function getMessageById($conn, $mid) {
        $query = "SELECT content FROM message WHERE mid = $mid AND del = 0";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['content'];
        } else {
            return "";
        }
    }
    
    public function getUserNumById($conn, $mid) {
        $query = "SELECT user_num FROM message WHERE mid = $mid AND del = 0";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['user_num'];
        } else {
            return 0;
        }
    }

}
?>