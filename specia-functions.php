<?php
    require_once('conections.php');

    class Node{
        private $value = array();
        private $pivot = 0;
        public $EOF = true;
        public $field = [];
        public function set($val){
            array_push($this->value,$val);
            if(count($this->value) > 0){
                $this->EOF = false;
            }
            if(count($this->value) == 1){
                $this->field = $this->value[0][0];
            }
        }
        public function checkValue(){
            return $this->value;
        }
        public function checkEOF(){
            if(!empty($this->value[0][$this->pivot])){
                return false;
            }else{
                return true;
            }
        }
        public function Next(){
            if(!empty($this->value[0][$this->pivot+1])){
                $this->field = $this->value[0][$this->pivot+1];
                $this->pivot += 1;
            }else{
                $this->EOF = true;
            }
        }
    }

    function sp_select_step(&$var,$query,$db){
        if(isset($query) && isset($db)){
            $conection = new mysqli(server,user,password,$db);
            if($data = $conection->query($query)){
                $i = 0;
                while($data2 = $data->fetch_array(MYSQLI_ASSOC)){
                    $foo[$i] = $data2;
                    $i++;
                }
                $var = $foo;
            }else{
                echo "{'message':'Error de conexion, favor de recargar'}";
                $var = false;
            }
        }else{
            echo "{'message':'Error faltan parametros'}";
            $var = false;
        }
    }

    function sp_select(&$var,$query,$db){
        if(isset($query) && isset($db)){
            $conection = new mysqli(server,user,password,$db);
            if($data = $conection->query($query)){
                $foo = new Node();
                while($data2 = $data->fetch_all()){
                    $foo->set($data2);
                }
                $var = $foo;
            }else{
                echo "{'message':'Error de conexion, favor de recargar'}";
                $var = false;
            }
        }else{
            echo "{'message':'Error faltan parametros'}";
            $var = false;
        }
    }

?>