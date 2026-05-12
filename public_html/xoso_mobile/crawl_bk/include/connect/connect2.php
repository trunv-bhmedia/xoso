<?php
class MyDBO2 {
	
	
// Base variables
    var $lastError;                                        // Holds the last error
    var $lastQuery;                                        // Holds the last query
    var $result;                                                // Holds the MySQL query result
    var $records;                                                // Holds the total number of records returned
    var $affected;                                        // Holds the total number of records affected
    var $rawResults;                                // Holds raw 'arrayed' results
    var $arrayedResult;                        // Holds an array of the result
    
    var $hostname = 'localhost';        // MySQL Hostname
    var $username = 'root';        // MySQL Username
    var $password = '';        // MySQL Password
    var $database = 'work';        // MySQL Database
    
    var $conn;                // Database Connection Link
    


    /* *******************
     * Class Constructor *
     * *******************/
    
    function MyDBO2($database = 'work', $username = 'root', $password = '', $hostname='localhost'){
            $this->database = $database;
            $this->username = $username;
            $this->password = $password;
            $this->hostname = $hostname;
            
            $this->Connect();
    }
    
    /* *******************
     * Private Functions *
     * *******************/
    
    // Connects class to database
    // $persistant (boolean) - Use persistant connection?
    private function Connect($persistant = false){
            $this->CloseConnection();
            
            if($persistant){
                    $this->conn = mysql_pconnect($this->hostname, $this->username, $this->password);
            }else{
                    $this->conn = mysql_connect($this->hostname, $this->username, $this->password);
            }
            mysql_set_charset('gbk',$this->conn);
            if(!$this->conn){
               $this->lastError = 'Could not connect to server: ' . mysql_error($this->conn);
                    return false;
            }
            
            if(!$this->UseDB()){
                    $this->lastError = 'Could not connect to database: ' . mysql_error($this->conn);
                    return false;
            }
            return true;
    }
    
    
    // Select database to use
    private function UseDB(){
            if(!mysql_select_db($this->database, $this->conn)){
                    $this->lastError = 'Cannot select database: ' . mysql_error($this->conn);
                    return false;
            }else{
                    return true;
            }
    }
    
    
    // Performs a 'mysql_real_escape_string' on the entire array/string
    private function SecureData($data){
            if(is_array($data)){
                    foreach($data as $key=>$val){
                            if(!is_array($data[$key])){
                                    $data[$key] = mysql_real_escape_string($data[$key], $this->conn);
                            }
                    }
            }else{
                    $data = mysql_real_escape_string($data, $this->conn);
            }
            return $data;
    }
        
	function CloseConnection(){
                if($this->conn){
                        mysql_close($this->conn);
                }
        }
	
	
	
	function get_one_row ($sql){	
		
		$result = mysql_query($sql, $this->conn);
		if ($result) {
			$items = mysql_fetch_object($result);
			mysql_free_result($result);
			return $items;
		}
		else return false;
	}
	
	function get_rows ($sql){	
		
		$result = mysql_query($sql, $this->conn);
		$k = array();
//		echo $sql; echo '<hr />';
		while ($items = mysql_fetch_object($result)) {
			$k[] = $items;
		}
		mysql_free_result($result);
		return $k;
	}
	
	function run_query($sql){	
			
		$result_content = mysql_query($sql, $this->conn);
		
	}
	
	
} 