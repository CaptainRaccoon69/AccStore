<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Order extends model {

    public $user_id;
    public $product_id;
    public $count;
    public $coupon;
    public $email;

    public function rules() {
        return [
                [['product_id', 'count'], 'required'],
                [['coupon'], 'string'],
                [['email'], 'email'],
                [['user_id'], 'integer']
        ];
    }

    public function prepareOrder(){
        $order = new Orders();
        $product = Products::getProductById($this->product_id);

        $user = User::getUserById($this->user_id);

        if ($product == null) {
            Yii::$app->session->setFlash("fail_buy", "Нет такого товара");
            return 0;
        }

        if ($this->count>$product->count) {
            Yii::$app->session->setFlash("fail_buy", "Нет такого количества товара");
            return 0;
        }


        $order->product_id = $this->product_id;
        $order->count = $this->count;
        $order->user_id = $this->user_id;
        $order->status = "reserved";
        $order->price = $this->count*$product["price"];

        if ($user->money<$order->price) {
            Yii::$app->session->setFlash("fail_buy", "У вас недостаточно денег, пополните кошелёк в личном кабинете");
            return 0;
        }

        if ($this->coupon) {
            $coupon = Coupons::getCouponByName($this->coupon)->toArray();
            if ($coupon!=null) {
                $order->price -= $coupon['discount']*$order->price/100;
                $order->coupon = $coupon['id'];
            }

        }

        //работа с файлами
        $product_file = "products/".$product['content'];
        $order_content = "";
        $lines = file($product_file);
        for ($i=0; $i < $order->count; $i++) {//перебираем массив с аакаунтами

            $new_line = $lines[$i];
            /*if ($i==$order->count-1) {
                $new_line = str_replace("\n",'',$new_line);
            }*/
            $order_content = $order_content.$new_line;
            unset($lines[$i]);//удаляем аакаунты которые скопировали из товара

        }


        $order_content_filename = uniqid().'.txt';
        file_put_contents("orders/".$order_content_filename, $order_content);//Записываем аккаунты в файл заказа

        $fp=fopen($product_file,"w"); //Удаляем записи из файла заказов
      	fputs($fp,implode("",$lines));
      	fclose($fp);

        $product->count -= $this->count;
        $order->content = $order_content_filename;

        $order->save();
        $order_id = Yii::$app->db->getLastInsertID();

        $product->save();

        return $order_id;
    }


    public function prepareOrderGuest(){
        $order = new Orders();
        $product = Products::getProductById($this->product_id);

        if ($product == null) {
            Yii::$app->session->setFlash("fail_buy", "Нет такого товара");
            return 0;
        }

        if ($this->count>$product->count) {
            Yii::$app->session->setFlash("fail_buy", "Нет такого количества товара");
            return 0;
        }


        $order->product_id = $this->product_id;
        $order->count = $this->count;
        $order->status = "reserved";
        $order->price = $this->count*$product["price"];
        $order->user_email = $this->email;

        if ($this->coupon) {
            $coupon = Coupons::getCouponByName($this->coupon)->toArray();
            if ($coupon!=null) {
                $order->price -= $coupon['discount']*$order->price/100;
                $order->coupon = $coupon['id'];
            }

        }

        //работа с файлами
        $product_file = "products/".$product['content'];
        $order_content = "";
        $lines = file($product_file);
        for ($i=0; $i < $order->count; $i++) {//перебираем массив с аакаунтами

            $new_line = $lines[$i];
            /*if ($i==$order->count-1) {
                $new_line = str_replace("\n",'',$new_line);
            }*/
            $order_content = $order_content.$new_line;
            unset($lines[$i]);//удаляем аакаунты которые скопировали из товара

        }


        $order_content_filename = uniqid().'.txt';
        file_put_contents("orders/".$order_content_filename, $order_content);//Записываем аккаунты в файл заказа

        $fp=fopen($product_file,"w"); //Удаляем записи из файла заказов
      	fputs($fp,implode("",$lines));
      	fclose($fp);

        $product->count -= $this->count;
        $order->content = $order_content_filename;

        $order->save();
        $order_id = Yii::$app->db->getLastInsertID();

        $product->save();

        return $order_id;
    }

    public function completeOrder($id){//Снимаем деньги с аккаунтов и сохраняем заказ
        $order = Orders::getOrderById($id);
        $product = Products::getProductById($order->product_id);
        if ($product->owner!="admin") {//если покупаем товар загруженный партнёром то перечисляем ему на счёт деньги
            $owner = User::getUserById($product->owner);
            if ($owner) {
                $owner->money += $order->price;
                $owner->save();
            }

        }
        $user = User::getUserById($order->user_id);
        $user->money -= $order->price;
        $order->status = "done";
        if ($user->ref_id!=0) {
            $ref_id = $user->ref_id;
            $ref_user = User::getUserById($ref_id);//Юзер который пригласил
            if ($ref_user) {
                $procent = 5*$order->price/100;
                $ref_user->money += $procent;
                $ref_user->ref_count += $procent;
                $ref_user->save();
            }
        }
        $order->save();
        $user->save();
        return true;
    }

    public function clearUnpaid(){
        $orders = Orders::getUnpaidOrders();
        foreach ($orders as $key => $order) {
          $order_filename = $order->content;
          $product = Products::getProductById($order->product_id);
          $product_filename = $product->content;


          $order_content = file_get_contents("orders/".$order_filename);
          $order_content = "\n".$order_content;
          file_put_contents("products/".$product_filename, $order_content, FILE_APPEND); //Возвращаем аккаунты в файл товара

          $product->count+=$order->count;
          $product->save();
          unlink("orders/".$order_filename);
          $order->delete();
        }
        return true;
    }



}
