<?php
$this->breadcrumbs=array(
	'Inventories'=>array('admin'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('inventory-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn btn-primary btn-flat')); ?>&nbsp;
<?php echo CHtml::link('Create',array('Inventory/create'),array('class'=>'btn btn-primary btn-flat')); ?>

<div class="btn-group">
    <button type="button" class="btn btn-info btn-flat">More Options</button>
    <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#">Download All Records</a></li>
        <li><a href="#">Download All Filtered Records</a></li>
        <li><a href="#">Upload</a></li>
    </ul>
</div>

<br/>
<br/>

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $fields = Inventory::model()->attributeLabels(); ?>
<div class="box-body table-responsive">
    <table id="inventory_table" class="table table-bordered">
        <thead>
            <tr>
                <th><?php echo $fields['inventory_id']; ?></th>
<th><?php echo $fields['sku_id']; ?></th>
<th><?php echo $fields['qty']; ?></th>
<th><?php echo $fields['uom_id']; ?></th>
<th><?php echo $fields['zone_id']; ?></th>
<th><?php echo $fields['sku_status_id']; ?></th>
<th><?php echo $fields['transaction_date']; ?></th>
                <th>Actions</th>
                
            </tr>
        </thead>
        
        </table>
</div>

<script type="text/javascript">
$(function() {
    var table = $('#inventory_table').dataTable({
        "filter": false,
        "processing": true,
        "serverSide": true,
        "bAutoWidth": false,
        "ajax": "<?php echo Yii::app()->createUrl($this->module->id.'/Inventory/data');?>",
        "columns": [
            { "name": "inventory_id","data": "inventory_id"},{ "name": "sku_id","data": "sku_id"},{ "name": "qty","data": "qty"},{ "name": "uom_id","data": "uom_id"},{ "name": "zone_id","data": "zone_id"},{ "name": "sku_status_id","data": "sku_status_id"},{ "name": "transaction_date","data": "transaction_date"},            { "name": "links","data": "links", 'sortable': false}
               ]
        });

        $('#btnSearch').click(function(){
            table.fnMultiFilter( { 
                "inventory_id": $("#Inventory_inventory_id").val(),"sku_id": $("#Inventory_sku_id").val(),"qty": $("#Inventory_qty").val(),"uom_id": $("#Inventory_uom_id").val(),"zone_id": $("#Inventory_zone_id").val(),"sku_status_id": $("#Inventory_sku_status_id").val(),"transaction_date": $("#Inventory_transaction_date").val(),            } );
        });
        
        
        
        jQuery(document).on('click','#inventory_table a.delete',function() {
            if(!confirm('Are you sure you want to delete this item?')) return false;
            $.ajax({
                'url':jQuery(this).attr('href')+'&ajax=1',
                'type':'POST',
                'dataType': 'text',
                'success':function(data) {
                   $.growl( data, { 
                        icon: 'glyphicon glyphicon-info-sign', 
                        type: 'success'
                    });
                    
                    table.fnMultiFilter();
                },
                error: function(jqXHR, exception) {
                    alert('An error occured: '+ exception);
                }
            });  
            return false;
        });
    });
</script>