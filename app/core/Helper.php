<?php

/**
 * Class Helper
 */
class Helper
{
    /**
     * @param $name
     * @return mixed
     */
    public static function getModel($name)
    {
        $model = new $name();
        return $model;
    }

    /**
     * @return mixed
     */
    public static function getMenu()
    {
        return self::getModel('menu')->initCollection()
                        ->sort(array('sort_order' => 'ASC'))->getCollection()->select();
    }

    /**
     * @param $path
     * @param $name
     * @param array $params
     * @return string
     */
    public static function simpleLink($path, $name, $params = [])
    {
        if (!empty($params)) {
            $firts_key = array_keys($params)[0];
            foreach ($params as $key => $value) {
                $path .= ($key === $firts_key ? '?' : '&');
                $path .= "$key=$value";
            }
        }
        return '<a href="' . route::getBP() . $path . '">' . $name . '</a>';
    }

    public static function link($path, $params = [])
    {
        if (!empty($params)) {
            $firts_key = array_keys($params)[0];
            foreach ($params as $key => $value) {
                $path .= ($key === $firts_key ? '?' : '&');
                $path .= "$key=$value";
            }
        }
        return route::getBP() . $path;
    }

    public static function redirect($url)
    {
        header("Location: $url");
    }

    public static function getCustomer()
    {
        if (!empty($_SESSION['id'])) {
            return self::getModel('customer')->initCollection()
                            ->filter(array('customer_id' => $_SESSION['id']))
                            ->getCollection()
                            ->selectFirst();
        } else {
            return null;
        }
    }

    public static function isAdmin($id = null)
    {

        if ($id === null) {
            $id = $_SESSION['id'];
        }


        if (empty($id)) {
            return 0;
        } else {
            $sql = "SELECT `admin_role` FROM customers WHERE `customer_id` = " . $id . " ;";
            $db = new DB();
            return implode($db->query($sql)[0]);
        }
    }

}
