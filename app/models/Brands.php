<?php
  namespace App\Models;
  use Core\Model;
  use Core\DB;
  use Core\Validators\{RequiredValidator,UniqueValidator};
  use App\Models\{Users};

  class Brands extends Model{
    public $id, $created_at, $updated_at, $name, $user_id, $deleted = 0;
    protected static $_table = 'brands';
    protected static $_softDelete = true;

    public function beforeSave(){
      $this->timeStamps();
    }

    public function validator(){
      $this->runValidation(new RequiredValidator($this,['field'=>'name','msg'=>'Brand Name is required.']));
      $this->runValidation(new UniqueValidator($this,['field'=>['name','user_id','deleted'],'msg'=>'That Brand Name already exists.']));
    }

    public static function findByUserIdAndId($user_id,$id){
      if($user_id == 1 OR $user_id == 2){
        $conditions = ([
          'conditions' => "id = ?",
          'bind' => [$id]
        ]);
      } else {
        $conditions = ([
          'conditions' => "user_id = ? AND id = ?",
          'bind' => [$user_id,$id]
        ]);
      }
        return self::findFirst($conditions);
    }

    public static function findBrands($user_id){
      if($user_id == 1 OR $user_id == 2){
        $sql = "SELECT brands.*, users.fname, users.lname
                FROM brands
                JOIN users ON users.id = brands.user_id
                WHERE brands.deleted != 1";
      } else {
        $sql = "SELECT brands.*, users.fname, users.lname
                FROM brands
                JOIN users ON users.id = brands.user_id
                WHERE brands.user_id = $user_id AND brands.deleted != 1";
      }

      return DB::getInstance()->query($sql)->results();
    }

    public static function getOptionsForForm($user_id=''){
      $params = [
        'columns' => 'id, name',
        'order' => 'name'
      ];

      // if(!empty($user_id) AND $user_id !=1 AND $user_id !=2){
      //   $params['conditions'] = "user_id = ?";
      //   $params['bind'][] = $user_id;
      // }
      $brands = self::find($params);
      $brandsAry = [''=>'-Select Brand-'];
      foreach($brands as $brand){
        $brandsAry[$brand->id] = $brand->name;
      }
      return $brandsAry;
    }
  }
