<?php
  namespace App\Controllers;
  use Core\Controller;
  use Core\Router;
  use Core\Session;
  use App\Models\Products;
  use App\Models\Users;
  use Core\H;

  class ProductsController extends Controller {

    public function detailsAction($product_id) {
      $product = Products::findById((int)$product_id);
      if(!$product){
        Session::addMsg('danger',"Oops...that product isn't available.");
        Router::redirect('/home');
      }
      $options = $product->getOptions();
      $selectOptions = [''=>'- Choose an Option -'];
      foreach($options as $option){
        $selectOptions[$option->id] = $option->name . ' ('.$option->inventory.' available)';
      }
      $this->view->selectOptions = $selectOptions;
      $artist = Users::findById((int)$product->user_id);
      $this->view->artist = $artist->artistic_name;
      $this->view->description = $artist->description;
      $artistProducts = Products::findByArtist((int)$product_id, (int)$product->user_id);
      //H::dnd($artistProducts);
      $this->view->artistProducts = $artistProducts;
      $this->view->product = $product;
      $this->view->images = $product->getImages();
      //H::dnd($product->getImages());
      $this->view->render('products/details');
    }
  }
