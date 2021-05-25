<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Signup;
use app\models\Login;
use app\models\Products;
use app\models\Product;
use app\models\Categories;
use app\models\ChangeUserData;
use app\models\Order;
use app\models\Orders;
use app\models\Coupons;
use app\models\TopUpBalance;
use app\models\PartnerRequest;
use app\models\PartnerRequests;
use app\models\Ticket;
use app\models\Tickets;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

class SiteController extends Controller {

    public function actionIndex() {//главная страница с товарами
        $order_model = new Order();
        if (Yii::$app->request->post("Order")) {//Если пришёл заказ
            $order_model->attributes = Yii::$app->request->post("Order");
            if (!Yii::$app->user->isGuest) {//Если пользователь зарегистрирован
                $order_model->user_id = Yii::$app->user->identity->id;
                $order_id = $order_model->prepareOrder(); //Возвращает id заказа который был создан
                if ($order_id != 0) {
                    if ($order_model->completeOrder($order_id)) {//Снять с аккаунта деньги и завершить оплату заказа
                        $pa_link = Url::to(["site/personalareamain"]);
                        Yii::$app->session->setFlash("success_buy", "Вы успешно приобрели товар, посмотреть свои покупки и скачать аккаунты можно в <a href=".$pa_link.">Личном кабинете</a>");
                    }

                }
            }else{
                $order_id = $order_model->prepareOrderGuest(); //Возвращает id заказа который был создан
                //Перенаправляем на страницу оплаты
            }

            return $this->goHome();
        }
        $products;
        $categories;
        if (Yii::$app->request->get('category_id')) {//если пользователь выбрал конкретную категорию
            $category_id = Yii::$app->request->get('category_id');
            $products = Products::getShownProductsByCategory($category_id);
            $categories = Categories::getCategoryByIdArray($category_id);
        }
        else if (Yii::$app->request->get('search_request')) {//Если пользователь что-то ищет
            $search_request = Yii::$app->request->get('search_request');
            $products = Products::getShownProductsBySearch($search_request);
            $categories = Categories::getCategories();
        }
        else{
            $categories = Categories::getCategories();
            $products = Products::getShownProducts();
        }

        return $this->render('index', ["products" => $products, "categories"=>$categories, 'order_model' => $order_model]);
    }

    public function actionProductinfo() {//страница подробного описания товара
        $product;
        $category;
        $order_model = new Order();
        if (Yii::$app->request->get('id')) {
            $id = Yii::$app->request->get('id');
            $product = Products::getProductById($id)->toArray();

            $category = Categories::getCategoryById($product['category_id'])->toArray();


        }
        return $this->render("productinfo", ['product' => $product, 'order_model'=>$order_model, "category" => $category]);
    }

    public function actionSignup() {//страница регистрации
        $signup_model = new Signup();
        if (Yii::$app->request->post('Signup')) {
            $signup_model->attributes = Yii::$app->request->post('Signup');
            if ($signup_model->validate()) {
                $signup_model->signup();
                //После регистрации мы авторизируемся и идём в личный кабинет
                $login_model = new Login();
                $login_model->username = Yii::$app->request->post('Signup')['username'];
                $login_model->password = Yii::$app->request->post('Signup')['password'];
                if ($login_model->validate()) {
                    Yii::$app->user->login($login_model->getUser(), 3600 * 24 * 30);
                    Yii::$app->session->setFlash("success_signup", "Вы успешно зарегестрировались, добро пожаловать в личный кабинет");
                    return $this->redirect(['personalareamain']);
                }
                return $this->goHome();
            }
        }


        return $this->render("signup", ['signup_model' => $signup_model]);
    }

    public function actionLogin() {//страница авторизации
        $login_model = new Login();
        if (Yii::$app->request->post('Login')) {
            $login_model->attributes = Yii::$app->request->post('Login');
            if ($login_model->validate()) {
                Yii::$app->user->login($login_model->getUser(), 3600 * 24 * 30);
                return $this->goHome();
            }
        }

        return $this->render("login", ['login_model' => $login_model]);
    }

    public function actionLogout() {//выйти из аккаунта
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionPersonalareamain() {//персональная информация с заказами

        $orders = Orders::getOrdersByUser(Yii::$app->user->identity->id);
        $tickets = Tickets::getTicketsByUser(Yii::$app->user->identity->id);
        foreach ($orders as $key => $order) {
            $product = Products::getProductById($order["product_id"]);
            if ($product) {
                $category = Categories::getCategoryById($product->category_id);
                $orders[$key]["name"] = $product["name"];
                $orders[$key]["img"] = $category["img"];
                $orders[$key]["seller"] = $product["owner"];
                $orders[$key]["deleted"] = 0;
            }
            else{
                $orders[$key]["deleted"] = 1;
            }

        }
        return $this->render('personal-area-main', ['orders' => $orders, "tickets" => $tickets]);
    }

    public function actionPersonalareasettings(){//настройки персональной информации
        $change_user_data_model = new ChangeUserData();
        //var_dump(Yii::$app->request->post('ChangeUserData'));
        if (Yii::$app->request->post('ChangeUserData')) {
            $change_user_data_model->attributes = Yii::$app->request->post('ChangeUserData');
            $change_user_data_model->id = Yii::$app->user->identity->id;
            if ($change_user_data_model->updateUser()) {
                Yii::$app->session->setFlash("user_updated", "User was updated");
            } else {
                Yii::$app->session->setFlash("fail_update_user", "fail");
            }
            return $this->refresh();
        }
        return $this->render('personal-area-settings', ['change_user_data_model' => $change_user_data_model]);
    }

    public function actionPartnerrequest() {//страница заявок партнёра
        $partner_request_model = new PartnerRequest();
        if (Yii::$app->request->post('PartnerRequest')) {//Если пришла новая заявка
            $partner_request_model->attributes = Yii::$app->request->post('PartnerRequest');
            $partner_request_model->user_id = Yii::$app->user->identity->id;
            if ($partner_request_model->addRequest()) {
                Yii::$app->session->setFlash("request_sent", "Заявка отправлена");
                return $this->refresh();
            }
        }

        $product_model = new Product();

        if (Yii::$app->request->post('Product')) {//если партнёр добавил новый товар
            $product_model->attributes = Yii::$app->request->post('Product');
            if ($product_model->validate()) {
                $product_model->img = UploadedFile::getInstance($product_model, 'img');
                $product_model->content = UploadedFile::getInstance($product_model, 'content');
                $product_model->owner = Yii::$app->user->identity->id;
                //$product_model->request_id = Yii::$app->request->post('Product')['request_id'];
                $add_or_update = $product_model->addOrUpdateProduct();//0 если товар добавлен, 1 если товар изменен

                if (!$add_or_update) {
                    Yii::$app->session->setFlash("product_added", "Товар успешно изменён");
                }
                else{
                    Yii::$app->session->setFlash("product_added", "Товар успешно добавлен");
                }

                return $this->refresh();
            }
        }

        $categories_arr = Categories::getCategories();
        $categories = ArrayHelper::map($categories_arr, 'id', 'name');
        $requests = PartnerRequests::getRequestsByPartnerId(Yii::$app->user->identity->id);
        foreach ($requests as $key => $request) {
            $sum = 0;//Общая сумма продал по данной заявке
            $count = 0;//Количество товаров во всех продуктах
            $loaded_count = 0;//Изначально загруженное количество
            $prds = Products::getProductsByRequest($request['id']);
            foreach ($prds as $key1 => $prd) {
                $count+=$prd['count'];
                $loaded_count+=$prd['loaded_count'];
                $orders = Orders::getOrdersByProduct($prd['id']);
                foreach ($orders as $order) {
                    $sum+=$order->price;
                }
            }
            $requests[$key]['pays'] = $sum;
            $requests[$key]['products_count'] = $count;
            $requests[$key]['loaded_count'] = $loaded_count;
        }
        $products;
        if (Yii::$app->request->get('id_request')) {//Если пользователь нажал показать оставшиеся товары
            $id = Yii::$app->request->get('id_request');
            $products = Products::getProductsByRequest($id);
        }
        else{
            $products = Products::getProductsByOwner(Yii::$app->user->identity->id);
        }

        foreach ($products as $key => $product) {
            $category = Categories::getCategoryById($product["category_id"]);

            $products[$key]["category_name"] = $category["name"];
            $products[$key]["img"] = $category["img"];

        }
        return $this->render('partner-request', ['partner_request_model' => $partner_request_model, 'categories' => $categories, 'requests'=>$requests, 'products'=>$products,'product_model'=>$product_model]);
    }

    public function actionPersonalareadesktop() {//страница пополнения баланса
        $top_up_balance_model = new TopUpBalance();

        if (Yii::$app->request->post("TopUpBalance")) {
            $top_up_balance_model->attributes = Yii::$app->request->post("TopUpBalance");
            $top_up_balance_model->user_id = Yii::$app->user->identity->id;
            $top_up_balance_model->RedirectToPay();
            return $this->refresh();
        }

        return $this->render('personal-area-desktop', ["top_up_balance_model" => $top_up_balance_model]);
    }

    public function actionPersonalarearef() {//страница c реферальной программой
        return $this->render('personal-area-ref');
    }

    public function actionPersonalareatickets() {//страница для просмотра и добавления тикетов
        $ticket_model = new Ticket();
        if (Yii::$app->request->post('Ticket')) {
            $ticket_model->attributes = Yii::$app->request->post('Ticket');
            $ticket_model->user_id = Yii::$app->user->identity->id;
            $ticket_model->addTicket();
            Yii::$app->session->setFlash("ticket_sent", "Тикет был отправлен");
            return $this->refresh();
        }
        $tickets = Tickets::getTicketsByUser(Yii::$app->user->identity->id);
        return $this->render('personal-area-tickets',["tickets"=>$tickets, 'ticket_model'=> $ticket_model]);
    }

    public function actionPartnerregister(){//страница для входа в личный кабинет партнёра
        return $this->render('partner-register');
    }

    public function actionPay() {//Экшн для оплаты товара, принимает гет параметр id товара
        $order_model = new Order();
        $order_id = Yii::$app->request->get('id');
        if ($order_id) {
            //todo pay
            $order_model->completeOrder($order_id);
            Yii::$app->session->setFlash("success_pay", "Payment successful");
        }

        return $this->redirect(['personalareamain']);
    }

    public function actionPartnerloadproduct() {//страница для загрузки товара в кабинете партнёра
        $product_model = new Product();

        if (Yii::$app->request->post('Product')) {
            $product_model->attributes = Yii::$app->request->post('Product');
            if ($product_model->validate()) {
                $product_model->img = UploadedFile::getInstance($product_model, 'img');
                $product_model->content = UploadedFile::getInstance($product_model, 'content');
                $product_model->owner = Yii::$app->user->identity->id;
                $add_or_update = $product_model->addOrUpdateProduct();//0 если товар добавлен, 1 если товар изменен
                if (!$add_or_update) {
                    Yii::$app->session->setFlash("product_added", "Товар успешно изменён");
                }
                else{
                    Yii::$app->session->setFlash("product_added", "Товар успешно добавлен");
                }

                return $this->refresh();
            }
        }

        $products = Products::getProductsByOwner(Yii::$app->user->identity->id);
        $categories_arr = Categories::getCategories();
        $categories = ArrayHelper::map($categories_arr, 'id', 'name');
        foreach ($products as $key => $product) {
            $category = Categories::getCategoryById($product["category_id"]);
            $products[$key]["category_name"] = $category["name"];
            $products[$key]["img"] = $category["img"];

        }
        return $this->render('partner-load-product', ["products" => $products, "categories" => $categories, "product_model" => $product_model]);
    }

    public function actionPartnersales() {//Информация про продажи партнёра

        $orders = Orders::getOrders();
        $total_price = 0;
        foreach ($orders as $key => $order) {
            $product = Products::getProductById($order["product_id"]);
            if ($product['owner'] != Yii::$app->user->identity->id) {
                unset($orders[$key]);
                continue;
            }
            $category = Categories::getCategoryById($product->category_id);
            $total_price+=$order["price"];
            $orders[$key]["name"] = $product["name"];
            $orders[$key]["product_price"] = $product["price"];
            $orders[$key]["img"] = $category["img"];
        }
        return $this->render('partner-sales', ['orders' => $orders, "total_price"=>$total_price]);
    }

    //AJAX!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function actionGetproductinfo() {
        if (Yii::$app->request->post('id')) {
            $id = Yii::$app->request->post('id');
            $product = Products::getProductById(intval($id))->toArray();
            return json_encode($product);
        } else {
            return false;
        }
    }

    public function actionDeleteunsold() {
        if (Yii::$app->request->post('id')) {
            $id = Yii::$app->request->post('id');
            $products = Products::getProductsByRequestObj(intval($id));
            foreach ($products as $key => $product) {
                $products[$key]->delete();
            }
            Yii::$app->session->setFlash("products_removed", "Товар успешно удалён");
            return $id;
        } else {
            return false;
        }
    }



    public function actionGetcategories() {
        $categories = Categories::getCategories();

        return json_encode($categories);
    }

    public function actionCouponinfo() {
        if (Yii::$app->request->post('name')) {
            $coupon_name = Yii::$app->request->post('name');
            if ($coupon = Coupons::getCouponByName($coupon_name)) {
                $coupon = $coupon->toArray();
                return json_encode($coupon);
            }
            else{
              return 1;
            }

        } else {
            return false;
        }
    }

    public function actionGetrequestinfo() {
        if (Yii::$app->request->post('id')) {
            $id = Yii::$app->request->post('id');
            $request = PartnerRequests::getRequestById(intval($id))->toArray();
            return json_encode($request);
        } else {
            return false;
        }
    }

}
