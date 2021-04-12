<?php

/**
 * Class ProductController
 */
class ProductController extends Controller
{

    /**
     *
     */
    protected $checkForm = true;

    /**
     *
     */
    protected $formValues = [];

    /**
     *
     */
    protected $addToEdit = false;

    /**
     *
     */
    protected $sort = "price_ASC";

    public function IndexAction()
    {
        $this->ListAction();
    }

    /**
     *
     */
    public function ListAction()
    {
        $this->setTitle("Товари");
        $this->registry['maxprice'] = $this->getModel('Product')->getMaxPrice();

        $this->registry['products'] = $this->getModel('Product')
                        ->initCollection()
                        ->filter($this->getFilterParams())
                        ->sort($this->getSortParams())
                        ->getCollection()->select();

        $this->setView();
        $this->renderLayout();
    }

    /**
     * 
     */
    public function ByidAction()
    {
        $this->setTitle("Карточка товара");
        $this->registry['product'] = $this->getModel('Product')->initCollection()
                        ->filter(['id', $this->getId()])->getCollection()->selectFirst();
        $this->setView();
        $this->renderLayout();
    }

    /**
     *
     */
    public function EditAction()
    {
        if (Helper::isAdmin() == 1) {
            $model = $this->getModel('Product');
            $this->registry['saved'] = 0;
            $this->setTitle("Редагування товару");
            $id = filter_input(INPUT_POST, 'id');

            if ($id) {
                $values = $model->getPostValues();
                if ($model->validateForm($values)) {
                    $this->registry['saved'] = 1;
                    $model->saveItem($id, $values);
                    $this->registry['product'] = $model->getItem($this->getId($id));
                    //$this->registry['product'] = $values;
                } else {
                    $this->registry['product'] = $values;
                    $this->registry['product']['id'] = $id;
                }
            } else {
                if (substr($_SERVER['HTTP_REFERER'], -3) == "add") {
                    $this->addToEdit = true;
                }

                $this->registry['product'] = $model->getItem($this->getId());
            }



            $this->setView();
            $this->renderLayout();
        } else {
            Helper::redirect('/index/index');
        }
    }

    /**
     *
     */
    public function AddAction()
    {
        if (Helper::isAdmin() == 1) {
            $model = $this->getModel('Product');
            $this->setTitle("Додавання товару");
            if ($this->formValues = $model->getPostValues()) {

                if ($model->validateForm($this->formValues)) {

                    $id = $model->addItem($this->formValues);
                    Helper::redirect(Helper::link('/product/edit', array('id' => $id)));
                    return;
                }
                $this->checkForm = false;
            }

            $this->setView();
            $this->renderLayout();
        } else {
            Helper::redirect('/index/index');
        }
    }

    public function DeleteAction()
    {
        if (Helper::isAdmin() == 1) {
            $model = $this->getModel('Product');
            $this->setTitle("Видалення");

            $model->deleteItem($model->getGetValues());
            Helper::redirect(Helper::link('/product/list'));
            return;
        } else {
            Helper::redirect('/index/index');
        }
    }

    public function ViewAction()
    {
        $model = $this->getModel('Product');
        $this->setTitle("Перегляд товару");
        $this->registry['product'] = $model->getItem($this->getId());
        $this->setView();
        $this->renderLayout();
    }

    
    
    public function UnloadAction()
    {
        $products = $this->getModel('Product')
            ->initCollection()
            ->getCollection()->select();
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

        foreach ($products as $product) {
            $xmlProduct = $xml->addChild('product');
            $xmlProduct->addChild('id',$product['id']);
            $xmlProduct->addChild('sku',$product['sku']);
            $xmlProduct->addChild('name',$product['name']);
            $xmlProduct->addChild('price',$product['price']);
            $xmlProduct->addChild('qty',$product['qty']);
            $xmlProduct->addChild('description',$product['description']);
        }
        $xml->asXML('public/products.xml');
        echo Helper::redirect('/public/products.xml');
    }
    /**
     * @return array
     */
    public function getSortParams()
    {
        $params = [];
        $this->sort = filter_input(INPUT_POST, 'sort');

        if (empty($this->sort)) {
            if (!empty($_COOKIE['product_sort'])) {
                $this->sort = $_COOKIE['product_sort'];
            }
        } else {
            setcookie("product_sort", $this->sort, time() + 60 * 60 * 24 * 30);
        }

        switch ($this->sort) {
            case "price_DESC":
                $params['price'] = 'DESC';
                break;
            case "price_ASC":
                $params['price'] = 'ASC';
                break;
            case "qty_DESC":
                $params['qty'] = 'DESC';
                break;
            case "qty_ASC":
                $params['qty'] = 'ASC';
                break;

            default:
                break;
        }

        return $params;
    }

    /**
     * @return array
     */
    public function getFilterParams()
    {

        $params = null; // треба щоб IF у filter не спрацював
        $from = filter_input(INPUT_POST, 'from');
        $to = filter_input(INPUT_POST, 'to');
        //$from = 10;
        //$to = 20000;
        if (
                $from !== null && $to !== null &&
                (int) $from >= 0 && (int) $to >= (int) $from
        ) {
            $params['from'] = (int) $from;
            $params['to'] = (int) $to;
        }
        return $params;
    }

    /**
     * @return array
     */
    public function getSortParams_old()
    {
        /*
          if (isset($_GET['sort'])) {
          $sort = $_GET['sort'];
          } else
          {
          $sort = "name";
          }
         * 
         */
        $sort = filter_input(INPUT_GET, 'sort');
        if (!isset($sort)) {
            $sort = "name";
        }
        /*
          if (isset($_GET['order']) && $_GET['order'] == 1) {
          $order = "ASC";
          } else {
          $order = "DESC";
          }
         * 
         */
        if (filter_input(INPUT_GET, 'order') == 1) {
            $order = "DESC";
        } else {
            $order = "ASC";
        }

        return array($sort, $order);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        /*
          if (isset($_GET['id'])) {

          return $_GET['id'];
          } else {
          return NULL;
          }
         */
        return filter_input(INPUT_GET, 'id');
    }

}
