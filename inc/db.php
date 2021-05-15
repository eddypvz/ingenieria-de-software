<?php
class DB{

    private $conn;

    public function __construct($name = ""){

        $this->conn = false;

        $this->conn = mysqli_connect("localhost", "root", "test", "ingenieria_software");

        if ($this->conn->connect_errno) {
            die("Error: No se pudo conectar a la DB");
        }
    }

    public function query($strQuery = "") {
        return $this->conn->query($strQuery);
    }

    public function last_id(){
        return $this->conn->insert_id;
    }

    public function get_array($strQuery = ""){
        $qTMP = $this->query($strQuery);
        $arrResponse = [];
        while ($arrTMP = $this->fetch_assoc($qTMP)){
            $arrResponse[] = $this->utf8_converter($arrTMP);
        }
        return $arrResponse;
    }

    private function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });

        return $array;
    }

    public function get_one_row($strQuery = ""){
        $arrTMP = $this->get_array($strQuery);
        if(isset($arrTMP[0])){
            return $arrTMP[0];
        }
        else{
            return false;
        }
    }

    public function escape($strVar = ""){
        return $this->conn->escape_string($strVar);
    }

    public function fetch_assoc($qTMP) {
        if($qTMP) {
            return $qTMP->fetch_assoc();
        }
        else{
            return [];
        }
    }

    public function num_rows($qTMP){
        return $qTMP->num_rows;
    }
}