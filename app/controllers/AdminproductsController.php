<?php
namespace App\Controllers;

use Core\{Controller,H,Session,Router, Mail};
use App\Models\{Products,ProductImages,Users,Brands,Options,ProductOptionRefs};
use App\Lib\Utilities\Uploads;

class AdminproductsController extends Controller {

  public function onConstruct(){
    $this->view->setLayout('admin');
    $this->currentUser = Users::currentUser();
  }

  public function indexAction(){
    $this->view->products = Products::findByUserId($this->currentUser->id);
    $this->view->render('adminproducts/index');
  }

  public function deleteAction(){
    $resp = ['success'=>false,'msg'=>'Something went wrong...'];
    if($this->request->isPost()){
      $id = $this->request->get('id');
      $product = Products::findByIdAndUserId($id, $this->currentUser->id);
      if($product){
        ProductImages::deleteImages($id);
        $product->delete();
        $resp = ['success' => true, 'msg' => 'Product Deleted.','model_id' => $id];
      }
    }
    $this->jsonResponse($resp);
  }

  public function toggleFeaturedAction(){
    $resp = ['success'=>false,'msg'=>'Something went wrong...'];
    if($this->request->isPost()){
      $id = $this->request->get('id');
      $product = Products::findByIdAndUserId($id, $this->currentUser->id);
      if($product){
        $product->featured = ($product->featured == 1)? 0 : 1;
        $product->approval = ($product->approval == 1)? 0 : 1;
        $product->save();
        $msg = ($product->featured == 1)? "Product Now Featured" : "Product No Longer Featured";
        $resp = ['success' => true, 'msg' => $msg,'model_id' => $id,'featured'=>$product->featured];
      }
    }
    $this->jsonResponse($resp);
  }

  public function editAction($id){
    $user = Users::currentUser();
    $product = ($id == 'new')? new Products() : Products::findByIdAndUserId((int)$id,$user->id);
    //H::dnd($product);
    if(!$product){
      Session::addMsg('danger','You do not have permission to edit that product');
      Router::redirect('adminproducts');
    }
    $images = ProductImages::findByProductId($product->id);
    if($this->request->isPost()){
      $this->request->csrfCheck();
      //$options = $_POST['options'];
      $options = (isset($_POST['options'])) ? $_POST['options'] : '';
      unset($_REQUEST['options']);
      $files = $_FILES['productImages'];
      $isFiles = $files['tmp_name'][0] != '';
      if($isFiles){
        // $productImage = new ProductImages();
        $uploads = new Uploads($files);
        $uploads->runValidation();
        $imagesErrors = $uploads->validates();
        if(is_array($imagesErrors)){
          $msg = "";
          foreach($imagesErrors as $name => $message){
            $msg .= $message . " ";
          }
          $product->addErrorMessage('productImages',trim($msg));
        }
      }

      $product->assign($this->request->get(),Products::blackList);
      $product->featured = ($this->request->get('featured') == 'on')? 1 : 0;
      $product->approval = ($this->request->get('approval') == 'on')? 1 : 0;
      $product->has_options = ($this->request->get('has_options') == 'on')? 1 : 0;
      if($id == 'new'){
        $product->user_id = $this->currentUser->id;
      }

        if($product->save()){
          if($id == 'new'){
            Mail::sendemail('noreply@ivyarticstudio.com', 'Ivy Kamau', 'New Art For Approval', 'Kindly approve new art... see name below <p>' . $product->name . '<p?<p>Thank you.</p>', 'Kindly approve new art ' . $product->name . 'thank you');
          }
        }
      if($product->validationPassed()){
        if($isFiles){
          //upload images
          ProductImages::uploadProductImages($product->id,$uploads);
        }
        $sortOrder = json_decode($_POST['images_sorted']);
        ProductImages::updateSortByProductId($product->id,$sortOrder);
        $inventory = 0;
        //save options
        if($product->hasOptions()){
          //H::dnd($options);
          $prodRef = ProductOptionRefs::findAllOptions($product->id);
          if($prodRef){
            $results = array_diff($prodRef,$options);
            if($results){
              foreach ($results as $result) {
                print_r($result);
                $refDelete = ProductOptionRefs::findByProductId($product->id, $result);
                print_r($refDelete->id);
                $refDelete->deleted = 1;
                $refDelete->save();
              }
            }
          }
          foreach($options as $option_id){
            $ref = ProductOptionRefs::findOrCreate($product->id,$option_id);
            $ref->inventory = $this->request->get("inventory_".$option_id);
            $ref->save();
            $inventory += $ref->inventory;
          }
        } else {
          $inventory = $this->request->get('inventory');
        }
        $product->inventory = $inventory;


        $product->save();
        // if($product->save()){
        if($this->currentUser->acl != '["SuperAdmin"]'){
          if($id != 'new' && ($this->request->get('approval') != 'on')){
            Mail::sendemail('noreply@ivyarticstudio.com', 'Ivy Kamau', 'Art For Reapproval', 'Kindly reapprove art ... see name below<p>' . $product->name . '</p><p>Thank you</p>', 'Kindly reapprove art ' . $product->name . 'thank you');
          }
        }
        // }
        //redirect
        Session::addMsg('success','Product Updated!');
        Router::redirect('adminproducts');
      }
    }
    $this->view->options = Options::getOptionsByProductId($product->id);
    //H::dnd($this->view->options);
    $this->view->header = ($id == 'new')? "Add New Product" : "Edit " . $product->name;
    $this->view->brands = Brands::getOptionsForForm($user->id);
    $this->view->images = $images;
    $this->view->product = $product;
    $this->view->userAcl = $user->acl;
    $this->view->displayErrors = $product->getErrorMessages();
    $this->view->render('adminproducts/edit');
  }

  function deleteImageAction(){
    $resp = ['success'=>false];
    if($this->request->isPost()){
      $user = Users::currentUser();
      $id = $this->request->get('image_id');
      $image = ProductImages::findById($id);
      $product = Products::findByIdAndUserId($image->product_id,$user->id);
      if($product && $image){
        ProductImages::deleteById($image->id);
        $resp = ['success'=>true,'model_id'=>$image->id];
      }
    }
    $this->jsonResponse($resp);
  }

  function optionsAction(){
    $userid = $this->currentUser->id;
    //H::dnd($userid);
    $this->view->options = Options::find([
      'conditions' => 'userid = ?',
      'bind' => [(int)$userid],
      'order' => 'name'
    ]);
    $this->view->render('adminproducts/options');
  }

  function editOptionAction($id){
    $option = ($id == 'new')? new Options(): Options::findById((int)$id);
    if($this->request->isPost()){
      $this->request->csrfCheck();
      $option->name = $this->request->get('name');
      $option->userid = $this->currentUser->id;
      if($option->save()){
        Session::addMsg('success','Option Saved!');
        Router::redirect('adminproducts/options');
      }
    }
    $this->view->option = $option;
    $this->view->errors = $option->getErrorMessages();
    $this->view->header = ($id == 'new')? "Add Product Option" : "Edit Product Option";
    $this->view->render('adminproducts/editOption');
  }

  function deleteOptionAction(){
    $id = $this->request->get('id');
    $option = Options::findById((int)$id);
    $resp = ['success'=>false,'msg'=>'Something went wrong...'];
    if($option){
      $option->delete();
      $resp['success'] = true;
      $resp['msg'] = 'Option Deleted';
      $resp['model_id'] = $id;
    }
    $this->jsonResponse($resp);
  }

  function getOptionsForFormAction(){
    $userid = $this->currentUser->id;
    $options = Options::find([
      'conditions' => 'name LIKE ? AND userid = ?',
      'bind' => ['%'.$this->request->get('q').'%', (int)$userid]
    ]);
    $items = [];
    foreach($options as $option){
      $items[] = ['id'=>$option->id, 'text'=>$option->name];
    }
    $resp = ['items'=>$items];
    $this->jsonResponse($resp);
  }

  public function approvalAction(){
    $this->view->products = Products::findunapproved();
    $this->view->render('adminproducts/index');
  }

}
