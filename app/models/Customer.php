<?php

/**
 * Class User
 */
class Customer extends Model
{

    /**
     * Customer constructor.
     */
    function __construct()
    {
        $this->table_name = "customers";
        $this->id_column = "customer_id";
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'customer';
    }

    /**
     * @param $params
     */
    public function filter($params)
    {
        if (is_array($params)) {
            $this->sql .= " WHERE email = '" . $params['email'] . "' AND password = '" . $params['password'] . "' ";
        }
        return $this;
    }

    public function validateForm(&$values)
    {
        $validated = true;

        $values = filter_var_array($values, [
            'first_name' => FILTER_SANITIZE_STRING,
            'last_name' => FILTER_SANITIZE_STRING,
            'phone' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_STRING,
            'city' => FILTER_SANITIZE_STRING,
            'password' => FILTER_SANITIZE_STRING,
            'second_password' => FILTER_SANITIZE_STRING,
        ]);


        if (empty($values['first_name'])) {
            $values['first_name_message'] = "Введіть ваше ім'я";
            $validated = false;
        }
        if (empty($values['last_name'])) {
            $values['last_name_message'] = "Введіть ваше прізвище";
            $validated = false;
        }

        $phone = preg_match('/^\+?[0-9]{10,12}$/', $values['phone']);
        if (empty($values['phone']) || $phone !== 1) {
            $values['phone_message'] = "Введіть ваш номер телефону";
            $validated = false;
        }

        $email = preg_match('/^((?!-)[a-z0-9-]+[a-z0-9]\.)*(?!-)[a-z0-9-]+[a-z0-9]@((?!(-|\.))[a-z0-9-]+[a-z0-9]\.)+[a-z]{2,10}$/i', $values['email']);
        if (empty($values['email']) || $email !== 1) {
            $values['email_message'] = "Введіть коректний e-mail";
            $validated = false;
        }

        if (empty($values['city'])) {
            $values['city_message'] = "Введіть ваше місце проживаня";
            $validated = false;
        }

        $password = preg_match('/([a-z0-9]+){8,}/i', $values['password']);
        if (empty($values['password']) || $password !== 1) {
            $values['password_message'] = "Введіть пароль (пароль повинен мати не менше 8 символів, обов'язково цифри та латинські букви)";
            $validated = false;
        }

        if (empty($values['second_password']) || $values['second_password'] !== $values['password']) {
            $values['second_password_message'] = "Неправильний пароль";
            $validated = false;
        }

        return $validated;
    }

}
