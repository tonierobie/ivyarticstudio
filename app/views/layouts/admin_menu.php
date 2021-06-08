<?php
  use Core\Router;
  use Core\{FH,H};
  use App\Models\Users;
  $menu = Router::getMenu('admin_menu_acl');
  $userMenu = Router::getMenu('user_menu');
  $currency = FH::getCurrencyAndCode()['currency'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-5">
  <!-- Brand and toggle get grouped for better mobile display -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?=PROOT?>home"><img src="<?=PROOT.MENU_LOGO?>"> </a>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="main_menu">
    <ul class="navbar-nav mr-auto">
      <?= H::buildMenuListItems($menu); ?>
    </ul>
    <ul class="navbar-nav mr-auto text-white">
      For the most beautiful masterpiece!!
    </ul>
    <ul class="navbar-nav mr-4 text-white">
      Currency : <?=$currency?>
    </ul>
    <ul class="navbar-nav mr-2">
      <?= H::buildMenuListItems($userMenu,"dropdown-menu-right"); ?>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
