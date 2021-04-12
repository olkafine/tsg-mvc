<?php

/**
 * Class Model
 */
class Model
{

    /**
     * @var
     */
    protected $table_name;
    /**
     * @var
     */
    protected $id_column;
    /**
     * @var array
     */
    protected $columns = [];
    /**
     * @var
     */
    protected $collection;
    /**
     * @var
     */
    protected $sql;
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @return $this
     */
    public function initCollection()
    {
        $columns = implode(',',$this->getColumns());
        $this->sql = "select $columns from " . $this->table_name ;
        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        $this->columns = [];
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);
        foreach($results as $result) {
            array_push($this->columns,$result['Field']);
        }
        return $this->columns;
    }


    /**
     * @param $params
     * @return $this
     */
    public function sort($params)
    {
        if(!empty($params) && is_array($params)){
            $keys = array_keys($params);
            $values = array_values($params);
            $this->sql .= " ORDER BY "
                    . reset($keys)
                    . " " 
                    . reset($values);
        }
        return $this;
    }


    /**
     * @return $this
     */
    public function getCollection()
    {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);
        return $this;
    }

    /**
     * @return mixed
     */
    public function select()
    {
        return $this->collection;
    }

    /**
     * @return null
     */
    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        $params = array($id);
        return $db->query($sql, $params)[0];
    }

    /**
     * @return array
     */
    public function getPostValues()
    {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            /*
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
             * 
             */
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = $column_value;
            }

        }
        return $values;
    }
    
    public function getGetValues()
    {
        $getvalues = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            
            if ( isset($_GET[$column]) ) {
                $getvalues[$column] = $_GET[$column];
            }
            /*
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
             * 
             */
            /*
            $column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = $column_value;
            }*/

        }
        return $getvalues;
    }
    
    public function addItem($values) 
    {
        $this->sql = "INSERT INTO $this->table_name (`" . implode("`,`", array_keys($values)) . "`)"
                . "VALUES ('" . implode("','", array_values($values)) . "');";
        $db = new DB();
        $db->query($this->sql);
        return $this->getLastInsertId();
    }
    
    public function deleteItem($values)
    {
        $this->sql = "DELETE FROM " . $this->table_name 
                . " WHERE id = '" . $values['id'] . "';";
        $db = new DB();
        $db->query($this->sql);
    }
    
     public function saveItem($id,$values)
    {
        $str = "";
        foreach ($values as $key => $value){
            $str .= "`" . $key . "`" . " = '" . $value . "', " ;
        }    
        $str = rtrim($str, ", ");
        $this->sql = "UPDATE " . $this->table_name 
                . " SET " . $str 
                . " WHERE id = '" . $id . "' ;" ;
       
        $db = new DB();
        $db->query($this->sql);
    }

    public function getLastInsertId() 
    {
        /*
        $this->sql = "SELECT LAST_INSERT_ID() AS `id`;";
        $db = new DB();
        $result = $db->query($this->sql)[0];
        return $result['id']; 
        */
        return (new DB())->getConnection()->lastInsertId();
    }

}
