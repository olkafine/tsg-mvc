<?php

class CustomerController extends Controller
{

    protected $formValues = [];
    protected $checkForm = true;

    public function ListAction()
    {
        if (Helper::isAdmin()) {
            $this->setTitle("Customers");
            $this->registry['customers'] = $this->getModel('Customer')->initCollection()
                            ->getCollection()->select();
            $this->setView();
            $this->renderLayout();
        } else {
            Helper::redirect('/index/index');
        }
    }

    public function EditAction()
    {
        $this->setTitle("Edit Customer");
        $this->setView();
        $this->renderLayout();
    }

    public function LoginAction()
    {
        $this->setTitle("Вхід");
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            
            $email = filter_input(INPUT_POST, 'email');
            $password = md5(filter_input(INPUT_POST, 'password'));
            $params = array(
                'email' => $email,
                'password' => $password
            );
            $customer = $this->getModel('customer')->initCollection()
                    ->filter($params)
                    ->getCollection()
                    ->selectFirst();
            $this->registry['customer']['email'] = $email;
            //$this->registry['customer']['password'] = $password;
           
            if (!empty($customer)) {
                $_SESSION['id'] = $customer['customer_id'];
                Helper::redirect('/index/index');
            } else {
                $this->invalid_password = 1;
            }   
            
        }
        $this->setView();
        $this->renderLayout();
    }

    public function LogoutAction()
    {

        $_SESSION = [];

        // expire cookie

        if (!empty($_COOKIE[session_name()])) {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
        Helper::redirect('/index/index');
    }

    public function SignupAction()
    {
        $model = $this->getModel('Customer');
        $this->setTitle("Реєстрація");

        if ($this->formValues = $model->getPostValues()) {
            $this->formValues['second_password'] = filter_input(INPUT_POST, 'second_password');
            if ($model->validateForm($this->formValues)) {
                unset($this->formValues['second_password']);
                $this->formValues['password'] = md5($this->formValues['password']);
                $id = $model->addItem($this->formValues);
                $_SESSION['id'] = $id;
                Helper::redirect(Helper::link('/index/index'));
                return;
            }
            $this->checkForm = false;
        }

        $this->setView();
        $this->renderLayout();
    }



}
