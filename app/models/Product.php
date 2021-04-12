<?php

/**
 * Class Product
 */
class Product extends Model
{

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }

    public function validateForm(&$values)
    {
        $validated = true;

        $values = filter_var_array($values, [
            'sku' => FILTER_SANITIZE_STRING,
            'name' => FILTER_SANITIZE_STRING,
            'price' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags' => FILTER_FLAG_ALLOW_FRACTION),
            'qty' => array('filter' => FILTER_SANITIZE_NUMBER_FLOAT,
                'flags' => FILTER_FLAG_ALLOW_FRACTION),
            'description' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ]);

        $values['price'] = (float) $values['price'];
        $values['qty'] = (int) $values['qty'];

        if (empty($values['sku'])) {
            $values['sku_message'] = "Введіть код продукту";
            $validated = false;
        }
        if (empty($values['name'])) {
            $values['name_message'] = "Введіть ім'я продукту";
            $validated = false;
        }
        if (empty($values['price']) || !filter_var($values['price'], FILTER_VALIDATE_FLOAT)) {
            $values['price_message'] = "Некоректна ціна";
            $validated = false;
        }
        if (empty($values['qty']) || !filter_var($values['qty'], FILTER_VALIDATE_INT)) {
            $values['qty_message'] = "Некоректна кількість";
            $validated = false;
        }


        return $validated;
    }

    public function getItem($id)
    {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        $params = array($id);
        $data = $db->query($sql, $params)[0];
        $data['description'] = htmlspecialchars_decode($data['description']);
        return $data;
    }

    public function select()
    {
        foreach ($this->collection as &$item) {
            $item['description'] = htmlspecialchars_decode($item['description']);
        }
        return $this->collection;
    }

    /**
     * @param $params
     */
    public function filter($params)
    {
        if (is_array($params)) {
            $this->sql .= " WHERE price >= " . $params['from'] . " AND price <= " . $params['to'];
        }
        return $this;
    }

    public function getMaxPrice()
    {
        $this->sql = "SELECT MAX(`price`) FROM " . $this->table_name . ";";
        $db = new DB();
        $max = $db->query($this->sql);
        return implode($max[0]);
    }

}
