<?php
namespace App\Models;
use Core\Model;
use Core\Validators\{RequiredValidator};
use Core\H;

class ProductImages extends Model{
  public $id, $url, $product_id, $name, $deleted=0;
  protected static $_table = 'product_images';
  protected static $_softDelete = true;

  public function validator(){
    $requiredFields = ['url'=>"Image",'name'=>'Name',];
    foreach($requiredFields as $field => $display){
      $this->runValidation(new RequiredValidator($this,['field'=>'url','msg'=>" is required."]));
    }
  }

  public static function uploadProductImages($product_id,$uploads){
    $lastImage = self::findFirst([
      'conditions' =>  "product_id = ?",
      'bind' => [$product_id],
      'order' => 'sort DESC'
    ]);
    $lastSort = (!$lastImage)? 0 : $lastImage->sort;
    $path = 'uploads'.DS.'product_images'.DS.'product_'.$product_id.DS;
    foreach($uploads->getFiles() as $file){
      $parts = explode('.',$file['name']);
      $ext = end($parts);
      $hash = sha1(time().$product_id.$file['tmp_name']);
      $uploadName = $hash . '.' . $ext;
      $image = new self();
      $image->url = $path . $uploadName;
      $image->name = $uploadName;
      $image->product_id = $product_id;
      $image->sort = $lastSort;
      if($image->save()){
        $uploads->upload($path,$uploadName,$file['tmp_name']);
        $lastSort++;
      }
    }
  }

  public static function deleteImages($product_id,$unlink = false){
    $images = self::find([
      'conditions' => "product_id = ?",
      'bind' => [$product_id]
    ]);
    foreach($images as $image){
      $image->delete();
    }
    if($unlink){
      $dirname = ROOT.DS.'uploads' . DS . 'product_images' . DS . 'product_' . $product_id;
      array_map('unlink', glob("$dirname/*.*"));
      rmdir($dirname);
    }
  }

  public static function deleteById($id){
    $image = self::findById($id);
    $deleted = false;
    if($image){
      $product_id = $image->product_id;
      unlink(ROOT.DS.'uploads'.DS. 'product_images'.DS.'product_'.$image->product_id.DS. $image->name);
      $deleted = $image->delete();
      if($deleted){
        self::updateSortByProductId($product_id);
      }
      return $deleted;
    }
  }

  public static function findByProductId($product_id){
    return self::find([
      'conditions' => "product_id = ?",
      'bind' => ['product_id'=>$product_id],
      'order' => 'sort'
    ]);
  }

  public static function updateSortByProductId($product_id,$sortOrder=[]){
    $images = self::findByProductId($product_id);
    $i = 0;
    foreach($images as $image){
      $val = 'image_'.$image->id;
      $sort = (in_array($val,$sortOrder))? array_search($val,$sortOrder) : $i;
      $image->sort = $sort;
      $image->save();
      $i++;
    }
  }

}
