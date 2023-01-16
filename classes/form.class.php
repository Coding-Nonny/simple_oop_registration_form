<?php
class Form extends Dbconnect
{
    public function handleInput($name, $email, $password)
    {
        $return = "";
        if (!empty($name) && !empty($email) && !empty($password)) {
            $select = "SELECT * FROM user WHERE email = ?;";
            $stmt0 = $this->mysqlConnection()->prepare($select);
            if (!$stmt0->execute(array($email))) {
                $return = var_dump($stmt0);
                $stmt0 = null;
            } else {
                if ($stmt0->rowCount() > 0) {
                    $return = "user already exists, try to login";
                } else {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $hashpass = password_hash($password, PASSWORD_BCRYPT);
                        $sql = "INSERT INTO user (names, email, passwords) VALUES (?, ?, ?);";
                        $stmt = $this->mysqlConnection()->prepare($sql);
                        if (!$stmt->execute(array($name, $email, $hashpass))) {
                            $return = var_dump($stmt);
                            $stmt = null;
                        } else {
                            $return = "registered successfuly";
                        }
                    } else {
                        $return = "$email - is not a valid email address";
                    }
                }
            }
        } else {
            $return = "Fill out all fields";
        }
        return $return;
    }
}
