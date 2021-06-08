<?php $this->setSiteTitle("Users")?>
<?php $this->start('head') ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<?php $this->end() ?>
<?php $this->start('body')?>
<table id="dtUserTable" class="table table-bordered table-hover table-striped table-sm">
  <thead>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Artistic Name</th>
    <th>Level</th>
    <th>Status</th>
    <th></th>
  </thead>
  <tbody>
    <?php foreach($this->users as $user): ?>
      <tr data-id="<?=$user->id?>" class="datatables">
        <td><?=$user->fname ?></td>
        <td><?=$user->lname ?></td>
        <td><?=$user->username ?></td>
        <td><?=$user->email ?></td>
        <td><?=$user->artistic_name?></td>
        <td><?=$user->acl ?></td>
        <td><?=($user->approval == 1)? 'Approved' : '<b>Not Approved</b>' ?></td>
        <td class="text-right">
          <a class="btn btn-sm btn-secondary mr-1" href="<?=PROOT?>register/edit/<?=$user->id?>"><i class="fas fa-edit"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<script>
  $(document).ready(function() {
    $('#dtUserTable').DataTable();
  } );
</script>
<?php $this->end(); ?>
