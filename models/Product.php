<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Product extends model {

    public $product_id;
    public $name;
    public $count;
    public $category_id;
    public $price;
    public $img="";
    public $content;
    public $is_hide;
    public $owner;
    public $request_id;
    public $description;

    public function rules() {
        return [
                [['name','category_id','price', 'category_id'], 'required'],
                [['product_id', 'count', 'request_id'], 'integer'],
                [['owner'], 'string'],
                [['description'], 'string'],
                [['is_hide'], 'boolean'],
                [['img'], 'file', 'extensions' => ['jpg','png']],
                [['content'], 'file', 'extensions' => 'txt']
        ];
    }

    public function addOrUpdateProduct(){
        $product;
        $add_or_update;//1 - add, 0 - update
        if ($this->product_id==null) {
            $product = new Products();
            $add_or_update = 1;
        }
        else{
            $product = Products::getProductById($this->product_id);
            $add_or_update = 0;
        }

        $product->name = $this->name;
        $product->category_id = $this->category_id;
        $product->price = $this->price;
        $product->description = $this->description;

        if ($this->img!=NULL) {
            $this->uploadImg($this->img);
            $product->img = $this->img->baseName.'.'.$this->img->extension;
        }
        if ($this->content!=NULL) {//удаляем старый файл если есть
            if (file_exists($this->content)) {
              unlink("products/".$product->content);
            }

            $filename = uniqid();//нгенерируем имя нового файла
            $this->uploadContent($filename);
            $product->content = $filename.'.'.$this->content->extension;

            $file_array =  file ("products/".$product->content);
            $num_str =  count($file_array);
            $product->count = $num_str;
            $product->loaded_count = $num_str;
        }

        if ($this->owner) {
            $product->owner = $this->owner;
        }
        if ($this->request_id) {
            $product->request_id = $this->request_id;
        }


        $product->save();
        return $add_or_update;
    }



    public function uploadImg(){
        $this->img->saveAs("img/product_img/{$this->img->baseName}.{$this->img->extension}");
    }

    public function uploadContent($filename){
        $this->content->saveAs("products/$filename.{$this->content->extension}");
    }

}
