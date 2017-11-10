<?php
namespace Shopping\Model\Table;
use Cake\Network\Session;
use Cake\ORM\Table;

class CartsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('products');
    }

    public function addProduct($productId) {
        $allProducts = $this->readProduct();
        if (null != $allProducts) {
            if (array_key_exists($productId, $allProducts)) {
                $allProducts[$productId]++;
            } else {
                $allProducts[$productId] = 1;
            }
        } else {
            $allProducts[$productId] = 1;
        }
        $this->saveProduct($allProducts);
    }
    /*
     * get total count of products
     */
    public function getCount() {
        $allProducts = $this->readProduct();
        if (count($allProducts) < 1) {
            return 0;
        }
        $count = 0;
        foreach ($allProducts as $product) {
            $count = $count + $product;
        }
        return $count;
    }
    /*
     * save data to session
     */
    public function saveProduct($data) {
        $session = new Session();
        $session->write('Cart', $data);
        return $session;
    }
    /*
     * read cart data from session
     */
    public function readProduct() {
        $session = new Session();
        return $session->read('Cart');
    }
}