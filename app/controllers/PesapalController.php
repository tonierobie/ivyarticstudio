<?php
namespace App\Controllers;
use Core\Controller;

class PesapalController extends Controller {

  public function indexAction() {
    $this->view->render('pesapal/index');
  }

  public function checkoutAction() {
    
  }

}
