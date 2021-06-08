<?php
use Core\{FH,H};
?>
<?php $this->start('head') ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<?php $this->end() ?>
<?php $this->start('body')?>
<?php
$currency = FH::getCurrencyAndCode();
//H::dnd($currency);
?>
<table id="dtUserProducts" class="table table-bordered table-hover table-striped table-sm">
  <thead>
    <th>Name</th>
    <th>Price</th>
    <th>Shipping</th>
    <th>Inventory</th>
    <th>Charges</th>
    <th>Status</th>
    <th></th>
  </thead>
  <tbody>
    <?php foreach($this->products as $product): ?>
      <tr data-id="<?=$product->id?>">
        <td><?=$product->name ?></td>
        <td><?=$product->price ?></td>
        <td><?=$product->shipping ?></td>
        <td><?=$product->inventory?></td>
        <td><?=$product->charges?></td>
        <td><?=($product->approval == 1)?'Approved':'<b>Not Approved</b>'?></td>
        <td class="text-right">
          <a class="btn btn-sm btn-outline-info mr-1" onclick="toggleFeatured('<?=$product->id?>');return false;">
            <i data-id="<?=$product->id?>" class="<?=($product->featured == 1)? 'fas fa-star': 'far fa-star'?>"></i>
          </a>
          <a class="btn btn-sm btn-secondary mr-1" href="<?=PROOT?>adminproducts/edit/<?=$product->id?>"><i class="fas fa-edit"></i></a>
          <a class="btn btn-sm btn-danger" href="#" onclick="deleteProduct('<?=$product->id?>');return false;"><i class="fas fa-trash-alt"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<script>
  function deleteProduct(id){
    if(window.confirm("Are you sure you want to delete this product. It cannot be reversed.")){
      jQuery.ajax({
        url : '<?=PROOT?>adminproducts/delete',
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

  function toggleFeatured(id){
    jQuery.ajax({
      url: '<?=PROOT?>adminproducts/toggleFeatured',
      method: "POST",
      data : {id : id},
      success : function(resp) {
        if(resp.success){
          var el = jQuery('i[data-id="'+resp.model_id+'"]');
          var klass = (resp.featured)? 'fas' : 'far';
          el.removeClass("fas far");
          el.addClass(klass);
          alertMsg(resp.msg,'success');
        } else {
          alertMsg(resp.msg, 'danger');
        }
      }
    });
  }

  $(document).ready(function() {
    $('#dtUserProducts').DataTable();
  } );
</script>
<?php $this->end(); ?>
