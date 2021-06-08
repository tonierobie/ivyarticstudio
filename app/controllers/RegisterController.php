<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use App\Models\Users;
use App\Models\Login;
use Core\H;
use Core\Mail;
use Core\Session;

class RegisterController extends Controller {

  public function onConstruct(){
    $this->view->setLayout('default');
  }

  public function loginAction() {
    $loginModel = new Login();
    if($this->request->isPost()) {
      // form validation
      $this->request->csrfCheck();
      $loginModel->assign($this->request->get());
      $loginModel->validator();
      if($loginModel->validationPassed()){
        $user = Users::findByUsername($_POST['username']);
        if($user && password_verify($this->request->get('password'), $user->password)) {
          $remember = $loginModel->getRememberMeChecked();
          $user->login($remember);
          Router::redirect('');
        }  else {
          $loginModel->addErrorMessage('username','There is an error with your username or password, or not yet approved to be an artist!');
        }
      }
    }
    $this->view->login = $loginModel;
    $this->view->displayErrors = $loginModel->getErrorMessages();
    $this->view->render('register/login');
  }

  public function logoutAction() {
    if(Users::currentUser()) {
      Users::currentUser()->logout();
    }
    Router::redirect('home');
  }

  public function registerAction() {
    $newUser = new Users();
    //H::dnd($newUser);
    $this->view->acl = 'user';
    if($this->request->isPost()) {
      if($this->request->get('acl')){
        $acl = $this->request->get('acl');
        $this->view->acl = $acl;
      }
      $this->request->csrfCheck();
      $newUser->assign($this->request->get(),Users::blackListedFormKeys);
      $newUser->confirm =$this->request->get('confirm');
      if($acl == 'user'){
        $newUser->acl = '';
        $newUser->description = '';
        $newUser->approval = 1;
        $toName = $newUser->fname . ' ' . $newUser->lname;
      } else {
        $newUser->acl = '["'.ucwords($acl).'"]';
        $toName = $newUser->fname . ' ' . $newUser->lname;
      }
      if($newUser->save()){
        if($acl != 'user'){
          $subject = 'New Artist Registration';
          $htmlBody = 'You have successfully registered in ivyarticstudio.com. <p>Kindly wait for approval, for more information you can contact Ivy at sales@ivyarticstudio.com.</p> <p>Thank you.</p>';
          $nonHtmlBody = 'You have successfully registered in ivyarticstudio.com, kindly wait for approval, for more information you can contact Ivy at sales@ivyarticstudio.com, thank you.';
          Mail::sendemail($newUser->email, $toName, $subject, $htmlBody, $nonHtmlBody);
        } else {
          $htmlBody = 'You have successfully registered in ivyarticstudio.com.  <p>You are welcome to buy art from our site at very affordable rates.</p> <p>For more information kindly contact Ivy at sales@ivyarticstudio.com</p> <p>Thank you.</p>';
          $nonHtmlBody = 'You have successfully registered in ivyarticstudio.com, you are welcome to buy art from our site at very affordable rates, for more information kindly contact Ivy at sales@ivyarticstudio.com, thank you.';
          Mail::sendemail($newUser->email, $toName, 'Welcome ' . $toName, $htmlBody, $nonHtmlBody);
        }
        Router::redirect('register/login');
      }
    }
    $this->view->newUser = $newUser;
    $this->view->displayErrors = $newUser->getErrorMessages();
    $this->view->render('register/register');
  }

  public function indexAction() {
    $users = Users::getUsers();
    $this->view->users = $users;
    $this->view->render('register/index');
  }

  public function editAction($id) {
    $user = Users::findById($id);
    //H::dnd($user);
    if($this->request->isPost()) {
      $this->request->csrfCheck();
      $user->assign($this->request->get(),Users::blackListedFormKeys);
      $password = $this->request->get('password_change');
      if($password != ''){
        $user->password = password_hash($this->request->get('password_change'), PASSWORD_DEFAULT);
      }
      $user->acl = '["'.$this->request->get('acl').'"]';
      $user->validator();
      if($user->validationPassed()){
        $user->save();
        Router::redirect('register/index');
      }
    }
    $this->view->acl = $user->acl;
    $this->view->user = $user;
    $this->view->displayErrors = $user->getErrorMessages();
    $this->view->render('register/edit');
  }

}