<?php

class CHmsg_countDao {

    public function addMsgCount($conn, $usn, $msc) {
        $fields = "(user_num, message_count)";
        $values = "($usn, $msc)";

        $query = "INSERT INTO msg_count " . $fields . " VALUES " . $values;
        mysqli_query($conn, $query);
    }

    public function hasMsgCountByUser($conn, $usn) {
        $query = "SELECT mcid FROM msg_count WHERE user_num = $usn AND del = 0";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['mcid'];
        } else {
            return 0;
        }
    }

    public function getMsgCountByUser($conn, $usn) {
        $query = "SELECT message_count FROM msg_count WHERE user_num = $usn AND del = 0";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['message_count'];
        } else {
            return 0;
        }
    }

    public function setMsgCountByUser($conn, $usn, $msc) {
        $query = "UPDATE msg_count SET message_count = $msc WHERE user_num = $usn AND del = 0";
        mysqli_query($conn, $query);
    }

}

?>