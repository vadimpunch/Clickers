<?php

class WorkWithDB
{
    private static $oneObject = null;
    public $value_sym = "{?}";
    public  $conection;


    public static function getDB()
    {
        if (self::$oneObject==null) self::$oneObject = new WorkWithDB();
        return self::$oneObject;
    }

   private function  __construct()
    {
      $this -> conection = new mysqli('localhost', 'root', '', 'Clickers');
      $this -> conection -> query("SET NAMES 'utf8'");
    }

    private function valueToQuery($query, $params) {
        if ($params) {
            for ($i = 0; $i < count($params); $i++) {
                $pos = strpos($query, $this->value_sym);
                $arg = "'".$this->conection->real_escape_string($params[$i])."'";
                $query = substr_replace($query, $arg, $pos, strlen($this->value_sym));
            }
        }
        return $query;
    }





    public  function selectTable($query, $value = null)
    {
        $result = $this->conection->query($this->valueToQuery($query, $value));
        if (!$result)
        {
            echo "По данному запросу ничего не найдено";
            return false;
        }
        else
        {
            $result = $this->resultToArray($result);
            return $result;
        }
    }
    public function selectRow($query, $params = false) {
        $result_set = $this->conection->query($this->valueToQuery($query, $params));
        if ($result_set->num_rows != 1) return false;
        else return $result_set->fetch_assoc();
    }

    public function selectCell($query, $params = false) {
        $result_set = $this->conection->query($this->valueToQuery($query, $params));
        if ((!$result_set) || ($result_set->num_rows != 1)) return false;
        else {
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }
    }
    public function noSelectQuery($query, $params = false)
    {
        $success = $this->conection->query($this->valueToQuery($query, $params));
        if ($success) {
            if ($this->conection->insert_id === 0) return true;
            else return $this->conection->insert_id;
        }
        else return false;
    }
    public  function resultToArray($result)
    {
        $result_array = array();
        while (($row = $result->fetch_assoc()) != false)
        {
            $result_array[] = $row;
        }
        return $result_array;
    }
    public  function __destruct()
    {
        if ($this->conection)
        {
        $this->conection->close();
        }
    }
}


