<?php 

class Database
{
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "malangdev";
    private $username = "root";
    private $password = "filryanaeka";
    protected $conn;
    protected $table;
    protected $result;
    protected $row;
    
    function __construct()
    {
        $this->conn = null;
        
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function getTable()
    {
        return $this->table;
    }
 
    public function getResult()
    {
        return $this->result;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function select_all()
    {
        //select all data
        
        $sql = "SELECT * FROM ".$this->table;
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
 
        $this->result = $stmt->fetchAll();
    }

    public function select_where($field, $value)
    {
        //select where data
        
        $sql = "SELECT * FROM ".$this->table." WHERE ".$field." like '%".$value."%'";;
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
 
        $this->result = $stmt->fetchAll();
    }

    public function single($field, $value)
    {
        $sql = "SELECT * FROM ".$this->table." WHERE ".$field." = '".$value."'";
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
 
        $this->row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($rows)
    {
        $sql = "INSERT INTO ".$this->table;
        
        foreach ($rows as $key => $value) {
            $field[] = $key;
            $isi[] = $value;
        }
         
        $sql .=" ( ".implode(',', $field)." )";
        $sql .=" VALUES ( '".implode('\', \'', $isi)."' )";

        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
 
        return $stmt->rowCount();
    }

    public function update($field, $value, $rows)
    {
        $sql = "UPDATE ".$this->table." SET ";
        
        foreach ($rows as $key => $row)
        {
            $set[] = " ".$key." = '". $row."'";
        }

        $sql .= implode(',', $set);

        $sql .= " WHERE ".$field." = '".$value."'";
        
        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
 
        return $stmt->rowCount();
    }

    public function delete($field, $value)
    {
        $sql = "DELETE FROM ".$this->table." WHERE ".$field." = '".$value."'";

        $stmt = $this->conn->prepare( $sql );
        $stmt->execute();
 
        return $stmt->rowCount();
    }

    public function query($query)
    {
        $sql = $query;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
 
        $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}