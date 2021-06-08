<?php
use Core\FH;
?>
<?php $this->start('head'); ?>
  <script src='<?=PROOT?>vendor/tinymce/tinymce/tinymce.min.js'></script>
  <script>
    tinymce.init({
      selector: '#description',
      branding: false
    });
  </script>
  <script src="<?=PROOT?>js/jQuery-3.3.1.min.js"></script>
<?php $this->end(); ?>
<?php $this->start('body'); ?>

<div class="row align-items-center justify-content-center">
  <div class="col-md-6 bg-light p-3">
    <h3 class="text-center">Register Here!</h3><hr>
    <form class="form" action="" method="post">
      <?= FH::csrfInput() ?>
      <?= FH::inputBlock('text','First Name','fname',$this->newUser->fname,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('text','Last Name','lname',$this->newUser->lname,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('text','Email','email',$this->newUser->email,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('text','Username','username',$this->newUser->username,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>

      <input type="radio" name="acl" id="usercheck" value="user" <?=($this->acl == 'user')? 'Checked' : ''?> >
      <label for="" class="col-md-2">User</label>
      <label for="" class="col-md-2">or</label>
      <input type="radio" name="acl" id="artistcheck" value="artist" <?=($this->acl == 'artist')? 'Checked' : ''?> >
      <label for="" class="col-md-4">Artist (Approval Required)</label>
      <div class="row" id="artistdesc" style="display: <?=($this->acl == 'artist')? 'block' : 'none'?>;" >
        <?= FH::textareaBlock('Artist Portfolio/Profile','description', $this->newUser->description,['class'=>'form-control','rows'=>'6'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
      </div>
      <div id="artistname" style="display: <?=($this->acl == 'artist')? 'block' : 'none'?>;" >
        <?= FH::inputBlock('text','artistic Name','artistic_name',$this->newUser->artistic_name,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
    </div>

      <?= FH::inputBlock('password','Password','password',$this->newUser->password,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <?= FH::inputBlock('password','Confirm Password','confirm',$this->newUser->confirm,['class'=>'form-control input-sm'],['class'=>'form-group'],$this->displayErrors) ?>
      <div class="d-flex justify-content-end">
        <div class="text-dk flex-grow-1">Alread have an account? <a href="<?=PROOT?>register/login">Log In</a></div>
        <?= FH::submitTag('Register',['class'=>'btn btn-primary']) ?>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#artistcheck').click(function(){
      $('#artistdesc').show();
      $('#artistname').show();
    });

    $('#usercheck').click(function(){
      $('#artistdesc').hide();
      $('#artistname').hide();
    });


  });
</script>
<?php $this->end(); ?>
