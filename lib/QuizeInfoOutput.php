<?php
require_once "WorkWithDB/connect.php";

class QuizeInfoOutput
{
    public $db;

    /**
     * Agregation
     */
    public function __construct()
    {
        $this->db = new WorkWithDB();
    }

    public function selectAttrInCategory($category, $attribute)
    {
        $sql = "SELECT   {$attribute}   FROM Quizes WHERE Category =  '{$category}' ";
        $arr = $this->db->selectColumn($sql);
        return $arr;
    }

}