<?php use Core\{FH,H}; ?>
<?php $this->setSiteTitle("Edit ".$this->user->fname);?>
<?php $this->start('head') ?>
<script src='<?=PROOT?>vendor/tinymce/tinymce/tinymce.min.js'></script>
<script>
  tinymce.init({
    selector: '#description',
    branding: false
  });
</script>
<?php $this->end() ?>
<?php
  $acl = $this->acl;
  $acl2 = json_decode($acl);
  $acl3 = $acl2[0];
  //H::dnd($acl);
?>
<?php $this->start('body')?>
<div class="row align-items-center justify-content-center">
  <div class="col-md-6 bg-light p-3">
    <h1 class="text-center">Edit <?=$this->user->fname?></h1>
    <form action="" method="POST" enctype="multipart/form-data">
      <?= FH::csrfInput();?>
      <div class="row">
        <?= FH::inputBlock('text','First Name','fname',$this->user->fname,['class'=>'form-control'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
        <?= FH::inputBlock('text','Last Name','lname',$this->user->lname,['class'=>'form-control input-sm'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
        <?= FH::inputBlock('text','Username','username',$this->user->username,['class'=>'form-control input-sm'],['class'=>'form-group col-md-6'],$this->displayErrors, 'readonly') ?>
        <?= FH::inputBlock('email','Email','email',$this->user->email,['class'=>'form-control input-sm'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
        <?= FH::inputBlock('password','Password','password_change','',['class'=>'form-control input-sm'],['class'=>'form-group col-md-6'],$this->displayErrors) ?>
        <?= FH::inputBlock('text','Artistic Name','artistic_name',$this->user->artistic_name,['class'=>'form-control input-sm'],['class'=>'form-group col-md-3'],$this->displayErrors) ?>
        <?= FH::inputBlock('text','Acl','acl',$acl3,['class'=>'form-control input-sm'],['class'=>'form-group col-md-3'],$this->displayErrors) ?>
      </div>
      <div class="row">
        <?= FH::textareaBlock('Portfolio','description',$this->user->description,['class'=>'form-control','rows'=>'6'],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
      </div>
      <div class="row">
        <?= FH::checkboxBlock('Approved','approval',$this->user->isApproved(),[],['class'=>'form-group col-md-12'],$this->displayErrors) ?>
      </div>
        <div class="col-md-12 text-right">
          <a href="<?=PROOT?>adminusers/index" class="btn btn-large btn-secondary">Cancel</a>
          <?= FH::submitTag('Save',['class'=>'btn btn-large btn-primary'],['class'=>'text-right col-md-12']); ?>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $this->end()?>
