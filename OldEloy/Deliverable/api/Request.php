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
    //user data
    private static $user_class = array();
    //event data
    private static $event_class = array();
	/**
	 * Connect to the database
	 * 
	 * @return bool false on failure / mysqli MySQLi object instance on success
	 */
	public function connect() {
		global $connection;
		$hostname='localhost';// Remote database server Domain name.
		$username='root';// as specified in the GRANT command at that server.
		$password='';// as specified in the GRANT command at that server.
		$dbname='userevent';// Database name at the database server.

		// create connection
		$connection = new mysqli($hostname, $username, $password, $dbname);

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
            return self::$data_name($_REQUEST); //runs getData, postData, putData, patchData or deleteData
        }
        return false;
    }

    //GET 
    private static function getData($request_data)
    {
        
        
        //GET user/username/password
        if(!empty($request_data['username']) && !empty($request_data['password'])){
            $Request = new Request; 
            $con=$Request->connect();
            
            $sql = "SELECT userid FROM user WHERE username='". $request_data['username'] ."' AND password='" . $request_data['password'] . "'";

            $result = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($result) > 0) {
				// output
				 
				while($row = mysqli_fetch_assoc($result)) {
					//echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
					$new_array[] = $row;
				}
                return $new_array;
            } else{
                echo "No username match found";
            }
        }
        $user_id = (int)$request_data['user'];
        $event_date = $request_data['eventdate'];
        $event_time = $request_data['eventtime'];
        $event_date_time = $event_date . " " . $event_time;
        //GET user/userid/event/date/time
        if($event_time != "notime"){
            $Request = new Request; 
            $con=$Request->connect();
            
            $sql = "SELECT * FROM event WHERE userID='". $user_id ."' AND eventstart='" . $event_date_time . "'";

            $result = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($result) > 0) {
				// output
				 
				while($row = mysqli_fetch_assoc($result)) {
					//echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
					$new_array[] = $row;
				}
				return $new_array;
			} else {
				echo "0 record";
			}
        }
        //GET user/userid/event/date
        else if($event_date != "nodate"){
            $event_time = "00:00:00";
            $event_date_time = $event_date . " " . $event_time;
            $event_end = "23:59:59";
            $event_date_time_end = $event_date . " " . $event_end;
            $Request = new Request; 
            $con=$Request->connect();
            
            $sql = "SELECT * FROM event WHERE userID='". $user_id ."' AND eventstart>='" . $event_date_time . "' AND eventstart < '" . $event_date_time_end . "'";
        
            $result = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($result) > 0) {
				// output
				 
				while($row = mysqli_fetch_assoc($result)) {
					//echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
					$new_array[] = $row;
				}
				return $new_array;
			} else {
				echo "0 record";
			}
        }
        
    }

    //POST /class： 
    private static function postData($request_data)
    {
        $Request = new Request; 
        $con=$Request->connect();
        
        //userid=$1&eventdate=$2&eventtime=$3&eventinfo=$4&eventlocation=$5
        //POST a new event
        if (!empty($request_data['userid']) && !empty($request_data['eventdate']) && !empty($request_data['eventtime'])
            && !empty($request_data['eventinfo']) && !empty($request_data['eventlocation'])) {
            
            $data['userid'] = $request_data['userid'];
            $data['eventdatetime'] = $request_data['eventdate'] . " " . $request_data['eventtime'];
            $data['eventinfo'] = $request_data['eventinfo'];
            $data['eventlocation'] = $request_data['eventlocation'];
            self::$event_class[] = $data;
            
            $sql = "INSERT INTO event (userID, eventstart, eventname, location) VALUES ('" . $data['userid'] . "', '" . $data['eventdatetime'] . "', '" . $data['eventinfo'] . "', '" . $data['eventlocation'] . "')";
            
            if ($con->query($sql) === TRUE) {
                echo "new record insert successful";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
            //$result = mysqli_query($con, $sql);

            return self::$event_class;//return new data object
        }
        //POST new user: username=$1&password=$2
        else if (!empty($request_data['username']) && !empty($request_data['password'])) {
            
        
            
            $sql = "INSERT INTO user (username, password) VALUES ('" . $request_data['username'] . "', '" . $request_data['password'] . "')";
            
             

            if ($con->query($sql) === TRUE) {
                //echo "New record insert successful";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
            
            $sql = "SELECT * FROM user WHERE username = '" . $request_data['username'] . "' AND password = '" . $request_data['password'] . "'";
            
            $result = mysqli_query($con, $sql);
            
            
				 
			while($row = mysqli_fetch_assoc($result)) {
				//echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
                   $data['userid'] = $row['userid'];
                   $data['username'] = $request_data['username'];
                   $data['password'] = $request_data['password'];
                   self::$user_class[] = $data;
			}
				
		

            return self::$user_class;//return new data object
        } else {
            return false;
        }

        
    }

    //PUT /class/ID： update all the information for the class
    private static function putData($request_data)
    {
        $Request = new Request; 
        $con=$Request->connect();

        //PUT an event
        if(!empty($request_data['eventid'])){
            $data['eventid'] = $request_data['eventid'];
            $data['userid'] = $request_data['userid'];
            $data['eventdatetime'] = $request_data['eventdate'] . " " . $request_data['eventtime'];
            $data['eventinfo'] = $request_data['eventinfo'];
            $data['eventlocation'] = $request_data['eventlocation'];
            self::$event_class[] = $data;

            $sql = "UPDATE event SET userid = '" . $data['userid'] . "', eventstart = '" . $data['eventdatetime'] . "', eventname = '" . $data['eventinfo'] . "', location = '" . $data['eventlocation'] . "' WHERE eventid = '" . $data['eventid'] . "'";
           
            if ($con->query($sql) === TRUE) {
                echo "Event update successful";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }

            return self::$event_class;
        }
        //PUT a user
        else if (!empty($request_data['userid'])) {
            $data['userid'] = $request_data['userid'];
            $data['username'] = $request_data['username'];
            $data['password'] = $request_data['password'];
            self::$user_class[] = $data;

            $sql = "UPDATE user SET userID = '" . $data['userid'] . "' , username = '" . $data['username'] . "', password = '" . $data['password'] . "' WHERE userid = '" . $data['userid'] . "'";
        
            if ($con->query($sql) === TRUE) {
                echo "User update successful";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }

            return self::$user_class;
        }
        else {
            return false;
        }
        
    }

    //PATCH /class/ID： update class information ( part)
    private static function patchData($request_data)
    {
        $Request = new Request; 
        $con=$Request->connect();
        
        //PATCH event
        if (!empty($request_data['eventid'])){
            

            //Get current date and time, in case we only want to change one of them
            $sql = "SELECT * FROM event WHERE eventid = '" . $request_data['eventid'] . "'";
            $result = mysqli_query($con, $sql);
            
            if (mysqli_num_rows($result) > 0) {
				// output
				 
				while($row = mysqli_fetch_assoc($result)) {
					//echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["location"]. "<br>";
					$data['eventid'] = $row['eventID'];
                    $data['userid'] = $row['userid'];
                    $data['eventdatetime'] = $row['eventstart'];
                    $data['eventinfo'] = $row['eventname'];
                    $data['eventlocation'] = $row['location'];
				}
				
			} else {
				echo "PATCH: No event mathces this ID.";
            }
            
            
            

            $datetime = new DateTime($row['eventstart']);
            $event_date = $datetime->format('Y-n-j');
            $event_time = $datetime->format('H:i:s');

            if ($request_data['eventdate'] != "0000-00-00"){
                $sql = "UPDATE event SET eventstart = '" . $request_data['eventdate'] . " " . $event_time . "' WHERE eventid = '" . $request_data['eventid'] . "'";
                if ($con->query($sql) === TRUE) {
                    $data['eventdatetime'] = $request_data['eventdate'] . " " . $event_time;
                    echo "Event:Date update successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                    return false;
                }
            }
            if ($request_data['eventtime'] != "00:00:01"){
                if($request_data['eventdate'] != "0000-00-00"){
                    $sql = "UPDATE event SET eventstart = '" . $request_data['eventdate'] . " " . $request_data['eventtime'] . "' WHERE eventid = '" . $request_data['eventid'] . "'";
                    $data['eventdatetime'] =  $request_data['eventdate'] . " " . $request_data['eventtime'];
                }
                else{
                    $sql = "UPDATE event SET eventstart = '" . $event_date . " " . $request_data['eventtime'] . "' WHERE eventid = '" . $request_data['eventid'] . "'";
                    $data['eventdatetime'] =  $event_date . " " . $request_data['eventtime'];
                }
                if ($con->query($sql) === TRUE) {
                    
                    echo "Event:Time update successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                    return false;
                }
            }
            if (!empty($request_data['eventinfo'])){
                $sql = "UPDATE event SET eventname = '" . $request_data['eventinfo'] . "' WHERE eventid = '" . $request_data['eventid'] . "'";
                if ($con->query($sql) === TRUE) {
                    $data['eventinfo'] = $request_data['eventinfo'];
                    echo "Event:Info update successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                    return false;
                }
            }
            if (!empty($request_data['eventlocation'])){
                $sql = "UPDATE event SET location = '" . $request_data['eventlocation'] . "' WHERE eventid = '" . $request_data['eventid'] . "'";
                if ($con->query($sql) === TRUE) {
                    $data['eventlocation'] = $request_data['eventlocation'];
                    echo "Event:Location update successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                    return false;
                }
            }
            self::$event_class[] = $data;
            return self::$event_class;
        }
        //PATCH user
        else if (!empty($request_data['userid'])){

            $sql = "SELECT * FROM user WHERE userid = '" . $request_data['userid'] . "'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $data['userid'] = $row['userid'];
            $data['username'] = $row['username'];
            $data['password'] = $row['password'];
            

            if (!empty($request_data['username'])){
                $sql = "UPDATE user SET username = '" . $request_data['username'] . "' WHERE userid = '" . $request_data['userid'] . "'";
                if ($con->query($sql) === TRUE) {
                    $data['username'] = $request_data['username'];
                    echo "User:Username update successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            }
            if (!empty($request_data['password'])){
                $sql = "UPDATE user SET password = '" . $request_data['password'] . "' WHERE userid = '" . $request_data['userid'] . "'";
                if ($con->query($sql) === TRUE) {
                    $data['password'] = $request_data['password'];
                    echo "User:Password update successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            }
            self::$user_class[] = $data;
            return self::$user_class;
        }

        
    }

    //DELETE /class/ID： delete one class
    private static function deleteData($request_data)
    {
        $Request = new Request; 
        $con=$Request->connect();
        if (!empty($request_data['eventid'])){
            $sql = "DELETE FROM event WHERE eventid = '" . $request_data['eventid'] . "'";
            if ($con->query($sql) === TRUE) {
                echo "Event delete successful";
                return self::$event_class;
                
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
        else if (!empty($request_data['userid'])){
            $sql = "DELETE FROM user WHERE userid = '" . $request_data['userid'] . "'";
            if ($con->query($sql) === TRUE) {
                echo "User delete successful";
                return self::$user_class;
                
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }
        
        return false;
    }
}