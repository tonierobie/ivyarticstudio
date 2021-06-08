<?php
  namespace App\Models;
  use Core\{Model,DB,H};
  use Core\Validators\{RequiredValidator,UniqueValidator};

  class Options extends Model{
    protected static $_table = 'options';
    protected static $_softDelete = true;

    public $id, $userid, $name, $deleted = 0;

    public function validator(){
      $this->runValidation(new RequiredValidator($this,['field'=>'name','msg'=>'Option Name is required.']));
      $this->runValidation(new UniqueValidator($this,['field'=>['name','userid', 'deleted'],'msg'=>'That option already exists']));
    }

    public static function getOptionsByProductId($id){
      //H::dnd($userid);
      if($id == 'new') return [];
      $sql = "SELECT options.*, refs.inventory
              FROM options
              JOIN product_option_refs as refs ON options.id = refs.option_id
              WHERE refs.product_id = ? AND refs.deleted != 1";

      return DB::getInstance()->query($sql,[$id])->results();
    }

  }
