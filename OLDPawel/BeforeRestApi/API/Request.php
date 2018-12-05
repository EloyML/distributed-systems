<?php

/**
 * data control
 */
//require('Db.php');
 
class Request
{
    //methods
    private static $method_type = array('get', 'post', 'put', 'patch', 'delete');
    //test data
    private static $test_class = array(
        1 => array('name' => 'Game', 'count' => 18),
        2 => array('name' => 'CS', 'count' => 20),
    );

	public function connect() {
		global $connection;
        $hostname = "127.0.0.1";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "callendar";

		// create connection
		$connection = new mysqli($hostname, $dbUsername, $dbPassword, $dbName);

		// check connection
		if ($connection->connect_error) {
		    die("connection fail: " . $connection->connect_error);
		}
		return $connection;
	}

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


    // getUsersBy ID

    private function getEventByID($event_id)
    {
        $Request = new Request;  //
        $con = $Request->connect();

        $sql = "SELECT * FROM Events where EventID = " . $event_id;

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // output

            while ($row = $result->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
                $new_array[] = $row;
            }
            return $new_array;
        } else {
            echo "0 record";
        }
    }

    //GET 
    private static function getData($request_data)
    {
		
		$type = null;
        $user_id = null;
        $event_id = null;
        $new_array = null;

        if ($request_data['event'])
        {
            $type = 1;
        }
		else if ($request_data['user'])
        {
            $type = 2;
        }

                $Request = new Request;  //
                $con = $Request->connect();
		switch ($type)
		{

			case 1:

                $event_id = (int)$request_data['event'];


            if ($event_id > 0) {
				

                $sql = "SELECT * FROM Events where EventID = " . $event_id;

                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // output

                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
                        $new_array[] = $row;
                    }
                    return $new_array;
                } else {
                    echo "0 record";
                }
            }
            else
                {//GET /class： all the classes


                //select
                //select
                $sql = "SELECT * FROM Events";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // output

                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
                        $new_array[] = $row;
                    }
                    return $new_array;
                } else {
                    echo "0 record";
                }
                //------
            }
			break;
			
			case 2:
			
			$user_id = (int)$request_data['user'];
            //GET /class/ID：

            if ($user_id > 0) {
                $Request = new Request;  //
                $con = $Request->connect();

                //select
                //select
                $sql = "SELECT * FROM Users where ID = " . $user_id;

                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // output

                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
                        $new_array[] = $row;
                    }
                    return $new_array;
                } else {
                    echo "0 record";
                }
                //------

                //return self::$test_class[$class_id];
            } else {//GET /class： all the classes

                $Request = new Request;  //
                $con = $Request->connect();

                //select
                //select
                $query = "SELECT * FROM Users";
                $result = $con->query($query);

                if ($result->num_rows > 0) {
                    // output

                    while ($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
                        $new_array[] = $row;
                    }
                    return $new_array;
                } else {
                    echo "0 record";
                }
                //------
            }
			break;
		}
		return $new_array;
    }


    //POST /class： create new class
    private static function postData($request_data)
    {
        if (!empty($request_data['email'])) {
            $Request = new Request;  //
            $con = $Request->connect();

            if (!(filter_var($request_data['email'], FILTER_VALIDATE_EMAIL))) {
                $userEmail = $request_data['email'];

                $stmt = $con->prepare("SELECT * FROM USERS WHERE Email = ?");
                $stmt->bind_param("s", $userEmail);

                if ($stmt->execute()) {
                    if ($stmt->num_rows > 0) {

                        $row = $stmt->fetch();

                        $id = $row['ID'];
                        $pass = $row['Pass'];

                        if (password_verify($request_data['password'], $pass)) {

                            $loginData = array(
                                'id' => $id,
                                'email' => $request_data['email'],
                                'password' => $$request_data['password']
                            );

                            return $loginData;

                        } else {
                            echo "Wrong Password";
                            //return false;
                        }
                    } else {
                        echo "user not found";
                        //return false;
                    }
                } else {
                    echo "sql statement was not executed";
                    //return false;
                }
            } else {
                echo "Wrong Email";
                //return false;
            }
        } else {
            echo "Email Required";
            //return false;
        }
    }


    //PUT /class/ID： update all the information for the class
    private static function putData($request_data)
    {
        $class_id = (int)$request_data['class'];
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
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
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
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        unset(self::$test_class[$class_id]);
        return self::$test_class;
    }
}