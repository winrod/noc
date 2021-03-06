<div class="row">
    
<div class="panel panel-default">
    
  <div class="panel-body">
    <div class="col-md-8">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'sku-form',
	'enableAjaxValidation'=>false,
)); ?>

 <?php /*if($form->errorSummary($model)){?><div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <?php echo $form->errorSummary($model); ?></div>
*/ ?>        

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'sku_code',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'brand_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'sku_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>150)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'description',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>150)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'default_uom_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'default_unit_price',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>18)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'type',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'default_zone_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'supplier',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>250)))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'low_qty_threshold',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
	</div>

	
	<div class="form-group">
		<?php echo $form->textFieldGroup($model,'high_qty_threshold',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
	</div>


<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary btn-flat')); ?>    <?php echo CHtml::resetButton('Reset',array('class'=>'btn btn-primary btn-flat')); ?></div>

<?php $this->endWidget(); ?>
    </div>
  </div>
</div>
</div>