<?php
  namespace App\Controllers;
  use Core\Controller;
  use Core\Router;
  use Core\H;
  use Core\Mail;
  use App\Models\Users;

  class AdminUsersController extends Controller{

    public function onConstruct(){
      $this->view->setLayout('admin');
      $this->currentUser = Users::currentUser();
    }

    public function indexAction(){
      $users = users::getUsersAdmin();
      $this->view->users = $users;
      $this->view->render('adminusers/index');
    }

    public function editAction($id) {
      $user = Users::findById($id);
      $getUserApproval = $user->approval;
      //H::dnd($getUserApproval);
      if($this->request->isPost()) {
        $this->request->csrfCheck();
        $user->assign($this->request->get(),Users::blackListedFormKeys);
        $password = $this->request->get('password_change');
        $user->approval = ($this->request->get('approval') == 'on')? 1 : 0;
        if($password != ''){
          $user->password = password_hash($this->request->get('password_change'), PASSWORD_DEFAULT);
        }
        $user->acl = '["'.$this->request->get('acl').'"]';
        $user->validator();
        if($user->validationPassed()){
          if($getUserApproval == 0  && ($this->request->get('approval') == 'on')){
            //H::dnd($getUserApproval);
            $toName = $user->fname . ' ' .  $user->lname;
            $htmlBody = 'Hello ' . $toName . ', <p> You have been approved to use our site as an artist.</p> <p>You can now upload your art as an image, <b>note only GIF, JPEG or PNG are supported </b>. You can upload more than one image to show different views/angles of the same art. Unless you upload the image it will have to be approved before it is available for selling. Image quality and clarity is important for approval. </p><p>Put the <b>prices in usd (Dollars)</b>, site charges of '.(SITE_CHARGES*100).'% are appicacle per each art on the selling price.</p><p>For more information you can contact Ivy at sales@ivyarticstudio.com.</p> <p>Thank you.</p>';
            $nonHtmlBody = 'Hello ' . $toName . ', you have been approved to use our site as an artist. You can now upload your art as an image, note only GIF, JPEG or PNG are supported. You can upload more than one image to show different views/angles of the same art. Unless you upload the image it will have to be approved before it is available for selling. Image quality and clarity is important for approval. Put the prices in usd (Dollars), site charges of '.(SITE_CHARGES*100).'% are applicable per each art on the selling price. For more information you can contact Ivy at sales@ivyarticstudio.com. Thank you.';
            Mail::sendemail($user->email, $toName, 'Approval', $htmlBody, $nonHtmlBody);
          }
          $user->save();
          Router::redirect('adminusers/index');
        }
      }
      $this->view->acl = $user->acl;
      $this->view->user = $user;
      $this->view->displayErrors = $user->getErrorMessages();
      $this->view->render('adminusers/edit');
    }

    public function approved(){

    }

    public function deleteAction(){
      if($this->request->isPost()){
        $id = (int)$this->request->get('id');
        $brand = Brands::findByUserIdAndId($this->currentUser->id,$id);
        $resp = ['success'=>false];
        if($brand){
          $brand->delete();
          $resp['success'] = true;
          $resp['model_id'] = $id;
        }
        $this->jsonResponse($resp);
      }
    }

  }