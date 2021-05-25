<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Signup;
use app\models\Login;
use app\models\Products;
use app\models\Product;
use app\models\User;
use app\models\Categories;
use app\models\Category;
use app\models\Orders;
use app\models\Order;
use app\models\Coupon;
use app\models\Coupons;
use yii\helpers\ArrayHelper;
use app\models\PartnerRequests;
use app\models\PartnerRequest;
use app\models\UserModel;
use app\models\Ticket;
use app\models\Tickets;

class AdminController extends Controller {

    public function actionUsers() {

        $user_model = new UserModel();
        if (Yii::$app->request->post('UserModel')) {
            $user_model->attributes = Yii::$app->request->post('UserModel');
            $user_model->Update();
        }

        $users = User::getAllUsers();
        $this->layout = 'main_admin';
        return $this->render('users', ["users" => $users, "user_model"=>$user_model]);
    }

    public function actionProducts() {
        $product_model = new Product();

        if (Yii::$app->request->post('Product')) {
            $product_model->attributes = Yii::$app->request->post('Product');
            if ($product_model->validate()) {
                $product_model->content = UploadedFile::getInstance($product_model, 'content');
                $add_or_update = $product_model->addOrUpdateProduct();
                Yii::$app->session->setFlash("product_added", "Product was added or changed");
                return $this->refresh();
            }
        }

        $products = Products::getProducts();
        $categories_arr = Categories::getCategories();
        $categories = ArrayHelper::map($categories_arr, 'id', 'name');
        foreach ($products as $key => $product) {
            $category = Categories::getCategoryById($product["category_id"])->toArray();
            $products[$key]["category_name"] = $category["name"];
            $products[$key]["img"] = $category["img"];

            if ($product['owner'] != 'admin') {
                $owner = User::getUserById($product['owner']);
                if ($owner) {
                    $products[$key]['owner_name'] = $owner->username;
                }
                else{
                    $products[$key]['owner_name'] = "Deleted";
                }

            } else {
                $products[$key]['owner_name'] = 'Admin';
            }
        }
        $this->layout = 'main_admin';
        return $this->render('products', ["products" => $products, "categories" => $categories, "product_model" => $product_model]);
    }

    public function actionSales() {

        $orders = Orders::getOrders();
        foreach ($orders as $key => $order) {
            $user = User::getUserById($order["user_id"]);
            if ($user) {
                $orders[$key]["user_name"] = $user["username"];
            }

            $product = Products::getProductById($order["product_id"]);
            if ($product) {
                $orders[$key]["product_name"] = $product["name"];
                $orders[$key]["product_price"] = $product["price"];
                $category = Categories::getCategoryById($product["category_id"]);
                if ($category) {
                    $orders[$key]["category_name"] = $category["name"];
                    $orders[$key]["category_img"] = $category["img"];
                }
            }

            $coupon = Coupons::getCouponById($order["coupon"]);
            if ($coupon) {
                $orders[$key]["coupon_name"] = $coupon["name"];
                $orders[$key]["coupon_discount"] = $coupon["discount"];
            }
        }
        $this->layout = 'main_admin';
        return $this->render('sales', ["orders" => $orders]);
    }

    public function actionStatistic() {

        $orders = Orders::getOrders();
        $statistic = array();


        $sum = Orders::getTotalSum();

        $statistic['total_sales'] = count($orders);
        $statistic['total_price'] = $sum;

        $this->layout = 'main_admin';
        return $this->render('statistic', ["orders" => $orders, "statistic" => $statistic]);
    }

    public function actionCoupons() {

        $coupon_model = new Coupon();

        if (Yii::$app->request->post("Coupon")) {
            $coupon_model->attributes = Yii::$app->request->post("Coupon");
            $coupon_model->addOrUpdate();
            Yii::$app->session->setFlash("coupon_added", "Coupon was added or changed");
            return $this->refresh();
        }

        $coupons = Coupons::getCoupons();
        $this->layout = 'main_admin';
        return $this->render('coupons', ["coupon_model" => $coupon_model, "coupons" => $coupons]);
    }

    public function actionCategories() {

        $category_model = new Category();

        if (Yii::$app->request->post("Category")) {
            $category_model->attributes = Yii::$app->request->post("Category");
            $category_model->img = UploadedFile::getInstance($category_model, 'img');
            $category_model->addOrUpdate();
            Yii::$app->session->setFlash("category_added", "Category was added or changed");
            return $this->refresh();
        }

        $categories = Categories::getCategories();
        $this->layout = 'main_admin';
        return $this->render('categories', ["category_model" => $category_model, "categories" => $categories]);
    }

    public function actionTickets() {

        $ticket_model = new Ticket();

        if (Yii::$app->request->post("Ticket")) {
            $ticket_model->attributes = Yii::$app->request->post("Ticket");
            $ticket_model->responseTicket();
            Yii::$app->session->setFlash("ticket_responsed", "You have responsed on the ticket");
            return $this->refresh();
        }

        $tickets = Tickets::getTickets();
        $this->layout = 'main_admin';
        return $this->render('tickets', ["ticket_model" => $ticket_model, "tickets" => $tickets]);
    }

    public function actionPartnerrequests() {
        $requests = PartnerRequests::getRequests();
        foreach ($requests as $key => $request) {
            $user = User::getUserById($request['user_id']);
            if (!$user) {
                PartnerRequests::getRequestById($request['id'])->delete();
                unset($requests[$key]);
                continue;
            }
            $requests[$key]['user_name'] = $user['username'];

            $category = Categories::getCategoryById($request['category_id']);
            $requests[$key]['category_name'] = $category['name'];
        }
        $this->layout = 'main_admin';
        return $this->render('partnerrequests', ['requests' => $requests]);
    }

    public function actionClearunpaid() {
        Order::clearUnpaid();
        return $this->redirect(['sales']);
    }

    public function actionDeleterequest() {

        if (Yii::$app->request->get("id")) {
            $id = Yii::$app->request->get("id");
            $partner_request = PartnerRequests::getRequestById($id);
            $partner_request->delete();
        }
        return $this->redirect(['partnerrequests']);
    }

    public function actionApproverequest() {

        if (Yii::$app->request->get("id")) {
            $id = Yii::$app->request->get("id");
            $partner_request = PartnerRequests::getRequestById($id);
            $user_id = $partner_request->user_id;
            $user = User::getUserById($user_id);
            $user->is_partner = 1;
            $user->save();
            $partner_request->status = "approved";
            $partner_request->save();
        }
        return $this->redirect(['partnerrequests']);
    }

    public function actionRejectrequest() {

        if (Yii::$app->request->get("id")) {
            $id = Yii::$app->request->get("id");
            $partner_request = PartnerRequests::getRequestById($id);
            $partner_request->status = "rejected";
            $partner_request->save();
        }
        return $this->redirect(['partnerrequests']);
    }

    public function actionDeletepartnerrequest() {
        if (Yii::$app->request->get("id")) {
            $id = Yii::$app->request->get("id");
            $partner_request = PartnerRequests::getRequestById($id);
            $partner_request->delete();
        }
        return $this->redirect(['partnerrequests']);
    }


    //AJAX!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function actionDeleteproduct() {
        if (Yii::$app->request->post("id")) {
            $id = Yii::$app->request->post("id");
            $product = Products::getProductById($id);
            if (file_exists("products/" . $product->content) && $product->content!=null) {
                unlink("products/" . $product->content);
            }
            $product->delete();
        }

        return true;
    }

    public function actionDeletecoupon() {
        if (Yii::$app->request->post("id")) {
            $id = Yii::$app->request->post("id");
            $coupon = Coupons::getCouponById($id);
            $coupon->delete();
        }

        return true;
    }

    public function actionDeleteticket() {
        if (Yii::$app->request->post("id")) {
            $id = Yii::$app->request->post("id");
            $ticket = Tickets::getTicketById($id);
            $ticket->delete();
        }

        return true;
    }

    public function actionDeletecategory() {
        if (Yii::$app->request->post("id")) {
            $id = Yii::$app->request->post("id");
            $category = Categories::getCategoryById($id);
            $category->delete();
        }

        return true;
    }

    public function actionHideproduct() {

        $product_id = Yii::$app->request->post('id');
        $hide = Yii::$app->request->post('hide');
        $product = Products::getProductById($product_id);
        $product->is_hide = (boolean) $hide;
        $product->save();
        return true;
    }

    public function actionGetuserinfo() {
        if (Yii::$app->request->post('id')) {
            $id = Yii::$app->request->post('id');
            $user = User::getUserById(intval($id))->toArray();
            return json_encode($user);
        } else {
            return false;
        }
    }

    public function actionDeleteuser() {
        if (Yii::$app->request->post("id")) {
            $id = Yii::$app->request->post("id");
            $user = User::getUserById($id);
            $user->delete();
        }

        return true;
    }



}
