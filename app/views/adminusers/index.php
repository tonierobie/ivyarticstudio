<?php $this->setSiteTitle("Users")?>
<?php $this->start('head') ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<?php $this->end() ?>
<?php $this->start('body')?>
<table id="dtUsersTable" class="table table-bordered table-hover table-striped table-sm">
  <thead>
    <th>#ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Artistic Name</th>
    <th>ACL</th>
    <th>Status</th>
    <th></th>
  </thead>
  <tbody>
    <?php foreach($this->users as $user): ?>
      <tr data-id="<?=$user->id?>">
        <td><?=$user->id ?></td>
        <td><?=$user->fname ?></td>
        <td><?=$user->lname ?></td>
        <td><?=$user->username ?></td>
        <td><?=$user->email ?></td>
        <td><?=$user->artistic_name?></td>
        <td><?=$user->acl ?></td>
        <td><?=($user->approval == 1)? 'Approved' : '<b>Not Approved</b>' ?></td>
        <td class="text-right">
          <a class="btn btn-sm btn-secondary mr-1" href="<?=PROOT?>adminusers/edit/<?=$user->id?>"><i class="fas fa-edit"></i></a>
          <a class="btn btn-sm btn-danger" href="#" onclick="deleteUser('<?=$user->id?>');return false;"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<script>
  function deleteUser(id){
    if(window.confirm("Are you sure you want to delete this User. It cannot be reversed.")){
      jQuery.ajax({
        url : '<?=PROOT?>register/delete',
        method : "POST",
        data : {id : id},
        success: function(resp){
          var msgType = (resp.success)? 'success' : 'danger';
          if(resp.success){
            jQuery('tr[data-id="'+resp.model_id+'"]').remove();
          }
          alertMsg(resp.msg, msgType);
        }
      });
    }
  }

  $(document).ready(function() {
    $('#dtUsersTable').DataTable();
} );
</script>
<?php $this->end(); ?>
