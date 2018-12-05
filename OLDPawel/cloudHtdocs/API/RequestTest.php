<?php
/**
 * data control
 */
class RequestTest
{
    public function connect()
    {
        $hostname = "127.0.0.1";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "callendar";
        global $con;

        $con = new mysqli($hostname, $dbUsername, $dbPassword, $dbName);
        // check connection
        if ($con->connect_error) {
            die("connection fail: " . $con->connect_error);
        }
        return $con;

    }

    //methods
    private static $method_type = array('get', 'post', 'put', 'patch', 'delete');

    public static function getRequest()
    {
        //method
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if (in_array($method, self::$method_type)) {
            //revoke method
            $data_name = $method . 'Data';
            return self::$data_name($_REQUEST);
        }
        return false;
    }

    //GET 
    private static function getData($request_data)
    {
        $connection = Request::connect();

        $class_id = (int)$request_data['class'];
        //GET /class/ID：

        if ($class_id > 0) {
            $stmt = $connection->query("SELECT * FROM USERS WHERE User_ID = " . $class_id);

            if ($stmt->num_rows > 0) {
                // output
                while ($row = $stmt->fetch_assoc()) {
                    // echo "id: " . $row["ID"] . " - Email: " . $row["Email"] . " - Password: " . $row["Pass"] . "<br/>";

                    $userData = array(
                        'id' => $row['ID'],
                        'email' => $row['Email'],
                        'password' => $row['Pass']
                    );
                    //echo $userData;
                    return $userData;
                }
            } else {
                echo "0 record";
                $connection->close();
            }
        } else {
            $stmt = $connection->query("SELECT * FROM USERS");

            if ($stmt->num_rows > 0) {
                while ($row = $stmt->fetch_assoc()) {
                    // echo "id: " . $row["ID"] . " - Email: " . $row["Email"] . " - Password: " . $row["Pass"] . "<br/>";
                    $userData = array(
                        'id' => $row['ID'],
                        'email' => $row['Email'],
                        'password' => $row['Pass']
                    );

                    return $userData;
                }
            } else {
                echo "0 record";
                $connection->close();
            }
        }

    }

    //POST /class： create new class
    private static function postData($request_data)
    {
        /*
        if (!empty($request_data['name'])) {
            $data['name'] = $request_data['name'];
            $data['count'] = (int)$request_data['count'];
            self::$test_class[] = $data;
            return self::$test_class;//return new data object
        } else {
            return false;
        }*/

        if (!empty($request_data['email'])) {
            if (!empty($request_data['password'])) {
                $loginData = array(
                    'id' => null,
                    'email' => null,
                    'password' => null
                );
                if ($request_data['login'])
                    $data['email'] = $request_data['email'];
                $data['password'] = $request_data['password'];

                if (!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {
                    $stmt = $con->prepare("SELECT * FROM USERS WHERE Email = ?");
                    $stmt->bind_param("s", $data['email']);
                    $email = $data['email'];

                    if ($stmt->execute()) {
                        if ($stmt->num_rows > 0) {

                            $row = $stmt->fetch_assoc();

                            $id = $row['ID'];
                            $pass = $row['Pass'];

                            if (password_verify($data['password'], $pass)) {
                                $loginData = array(
                                    'id' => $id,
                                    'email' => $email,
                                    'password' => $pass
                                );

                                return $loginData;
                            } else {
                                echo "Wrong Password";
                                return false;
                            }
                        } else {
                            echo "user not found";
                            return false;
                        }
                    } else {
                        echo "sql statement was not executed";
                        return false;
                    }
                } else {
                    "Wrong Email";
                    return false;
                }
            } else {
                echo "Password Required";
                return false;
            }
        } else {
            echo "Email Required";
            return false;
        }

    }


    //PUT /class/ID： update all the information for the class
    private static function putData($request_data)
    {
        $calendar_id = (int)$request_data['calendar'];
        if ($class_id == 0) {
            return false;
        }
        $data = array();
        if (!empty($request_data['name']) && isset($request_data['count'])) {
            $data['name'] = $request_data['name'];
            $data['count'] = (int)$request_data['count'];
            self::$test_class[$class_id] = $data;
            return self::$test_class;
        } else {
            return false;
        }
    }

    //PATCH /class/ID： update class information ( part)
    private static function patchData($request_data)
    {
        $connection = Request::connect();

        if ($request_data['calendar'])
        {
            $entry_id = (int)$request_data['calendar'];
            if ($entry_id == 0)
            {
                return false;
            }
            else
            {
                $stmt = $connection->prepare("UPDATE Events SET Subject = title, 
                                                     StartTime = startTime, 
                                                     EndTime = endTime 
                                                     WHERE EventID = id");

                $data = array (

                    'title' => $request_data['title'],
                    'startTime' => $request_data['start'],
                    'endTime' => $request_data['end'],
                    'id' => $request_data['id'],
                );

               $stmt->bind_param("sssi", $title, $startTime, $endTime, $id);


                $stmt->execute($data);
                $result = $stmt->fetch_assoc();
                $stmt->close();
                $resultArray = $result->fetch_array();

                return $resultArray;
            }
        }
        else if ($request_data['user'])
        {
            //update password of a user
        }
        else
        {
            return "Wrong request";
        }

$connection->close();
        if (!empty($request_data['name'])) {
            self::$test_class[$class_id]['name'] = $request_data['name'];
        }
        if (isset($request_data['count'])) {
            self::$test_class[$class_id]['count'] = (int)$request_data['count'];
        }
        return self::$test_class;
    }

    //DELETE /class/ID： delete one class
    private static function deleteData($request_data)
    {
        $connection = Request::connect();

        if ($request_data['calendar'])
        {
            $entry_id = (int)$request_data['calendar'];
            //GET /class/ID：
            if ($entry_id == 0) {
                return false;
            } else
                {

                if ($stmt = $connection->query("Delete * FROM Events WHERE EventID = " . $entry_id)) {
                    return "Entry has been deleted";
                } else
                    {

                    return "Query has not gone through";
                    $connection->close();
                }
            }
        }
        else if ($request_data['user'])
        {
            $user_id = (int)$request_data['user'];
            //GET /class/ID：
            if ($user_id == 0)
            {
                return false;
            } else
            {

                if ($stmt = $connection->query("Delete * FROM Users WHERE EventID = " . $user_id)) {
                    return "User has been deleted";
                } else
                {

                    return "Query has not gone through";
                    $connection->close();
                }
            }
        }
        else
        {
            return "Something Went Wrong";
        }

    }
}
?>