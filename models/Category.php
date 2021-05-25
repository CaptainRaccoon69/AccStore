<?php

namespace app\models;

use yii\base\Model;

class Category extends model {

    public $id;
    public $name;
    public $img;

    public function rules() {
        return [
                [['name'], 'required'],
                [['id'], 'integer'],
                [['img'], 'file', 'extensions' => ['jpg','png']]
        ];
    }

    public function addOrUpdate(){
        $category;
        if($this->id){
            $category = Categories::getCategoryById($this->id);
        }
        else{
          $category = new Categories();
        }

        if ($this->img!=NULL) {
            $this->uploadImg($this->img);
            $category->img = $this->img->baseName.'.'.$this->img->extension;
        }

        $category->name = $this->name;
        return $category->save();
    }

    public function uploadImg(){
        $this->img->saveAs("img/category_img/{$this->img->baseName}.{$this->img->extension}");
    }

}
