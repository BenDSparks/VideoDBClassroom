<?php

class CHuser_countDao {

    public function addUserCount($conn) {
        $fields = "()";
        $values = "()";

        $query = "INSERT INTO user_count " . $fields . " VALUES " . $values;
        mysqli_query($conn, $query);
    }

    public function getMaxId($conn) {
        $query = "SELECT MAX(ucid) FROM user_count WHERE del = 0";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            return $row['MAX(ucid)'];
        } else {
            return 0;
        }
    }

}
?>