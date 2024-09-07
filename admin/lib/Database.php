<?php
require_once 'constants.php';
class Database
{

    private $db_host = SERVER_NAME;
    private $db_user = SERVER_USERNAME;
    private $db_pass = SERVER_PASSWORD;
    private $db_name = DB_NAME;

    private $mysqli = null;
    private $result = array();
    private $conn = false;


    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }


    public function insert($table, $params = array(), $final_description = "")
    {
        if ($this->tableExist($table)) {
            $POST_DATA = array();
            foreach ($params as $param_name => $param_val) {
                if ($param_val != $final_description) {
                    $param_val = strip_tags(trim($param_val));
                    $param_val = mysqli_real_escape_string($this->mysqli, $param_val);
                }
                $POST_DATA[$param_name] = $param_val;
            }
            $table_col = implode(", ", array_keys($POST_DATA));
            $table_val = implode("', '", array_values($POST_DATA));

            // $table_col = implode(", ", array_keys($params));
            // $table_val = implode("', '", $params);

            // $table_val = $this->mysqli->real_escape_string($this->conn, $table_val);
            $sql = "INSERT INTO $table ($table_col) VALUES ('$table_val')";
            $query = $this->mysqli->query($sql);
            if ($query) {
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }


    public function update($table, $params = array(), $where = null, $final_description="")
    {
        if ($this->tableExist($table)) {

            $args = array();
            foreach ($params as $key => $value) {
                if ($value != $final_description) {
                    $value = strip_tags(trim($value));
                }
                $args[] = "$key = '$value' ";
            }

            $sql = "UPDATE $table SET " . implode(", ", $args);
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }


    public function delete($table, $where = null)
    {
        if ($this->tableExist($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function select($table, $rows = "*", $join = null, $where = null, $order = null, $limit = null)
    {
        if ($this->tableExist($table)) {
            $sql = "SELECT $rows FROM $table";
            if ($join != null) {
                $sql .= " JOIN $join";
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            if ($limit != null) {
                if (isset($_GET['page'])) {
                    $page = addslashes($_GET['page']);
                } else {
                    $page = 1;
                }
                $start = ($page - 1) * $limit;
                $sql .= " LIMIT $start,$limit";
            }
            $query = $this->mysqli->query($sql);
            if ($query) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function validate($inputData){
        global $con;
        $validatedData = mysqli_real_escape_string($con,$inputData);
        return trim($validatedData);
    }
    
    public function generateRandomString()
    {
        $characters = '0123456789ABHGCDEFHFGHFAD4587IJKLMN9044OP4465QRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 10;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function sql($sql)
    {
        $query = $this->mysqli->query($sql);

        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    private function tableExist($table)
    {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, $table . " does not exiest in this database.");
                return false;
            }
        }
    }


    public function pagination($table, $join = null, $where = null, $limit = null, $url = null)
    {
        if ($this->tableExist($table)) {
            if ($limit != null) {
                $sql = "SELECT COUNT(*) FROM $table";
                if ($join != null) {
                    $sql .= " JOIN $join";
                }
                if ($where != null) {
                    $sql .= " WHERE $where";
                }

                $query = $this->mysqli->query($sql);
                $total_record = $query->fetch_array();
                $total_record = $total_record[0];
                $total_page = ceil($total_record / $limit);

                if ($url == null) {
                    $url = basename($_SERVER['PHP_SELF']);
                } else {
                    $url = $url;
                }


                if (isset($_GET['page'])) {
                    $page = addslashes($_GET['page']);
                } else {
                    $page = 1;
                }



                $output = "<ul class='pagination'>";

                if ($page > 1) {
                    $output .= "<li class='page-item'><a class='page-link' href='$url?page=" . ($page - 1) . "'>Prev</a></li>";
                }

                if ($total_record > $limit) {
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $className = "class='page-item active'";
                        } else {
                            $className = "class='page-item'";
                        }
                        $output .= "<li $className ><a class='page-link' href='$url?page=$i'>$i</a></li>";
                    }
                }
                if ($total_page > $page) {
                    $output .= "<li class='page-item'><a class='page-link' href='$url?page=" . ($page + 1) . "'>Next</a></li>";
                }
                $output .= "</ul>";

                return $output;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function charSet()
    {
        $sql = $this->mysqli->set_charset('utf8');
        return $sql;
    }


    public function summernote($description)
    {
        $imgvalue = "<img class='img-fluid'";
        $h1value = "<h1 class='h3'";
        $h2value = "<h2 class='h4'";
        $h3value = "<h3 class='h5'";
        $h4value = "<h4 class='h6'";

        $str = ["<img", "<h3", "<h1", "<h2", "<h4"];
        $rplc = [$imgvalue, $h3value, $h1value, $h2value, $h4value];

        $getdescription = str_replace($str, $rplc, $description);
        return addslashes($getdescription);
    }


    public function checkRows($table, $where)
    {
        if ($this->tableExist($table)) {
            $sql = "SELECT * FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            $query = $this->mysqli->query($sql);
            if ($query) {
                if ($query->num_rows == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }


    public function showResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function slugMaker($title)
    {
        $slugMain = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        return $slugMain;
    }
    public function generateRandomColor()
    {
        $array = array('#3f78e0', '#747ed1', '#a07cc5', '#d16b86', '#e2626b', '#f78b77', '#fab758', '#6bbea3', '#7cb798');
        $randColor = array_rand($array);
        print_r($array[$randColor]);
    }



    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
            }
        } else {
            return false;
        }
    }
}
