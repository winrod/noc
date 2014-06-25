<?php
/**
 *## BootstrapCode class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

Yii::import('gii.generators.crud.CrudCode');

/**
 *## Class BootstrapCode
 *
 * @package booster.gii
 */
class BootstrapCode extends CrudCode {
	
	public function generateActiveGroup($modelClass, $column) {
		
		if ($column->type === 'boolean') {
			return "\$form->checkBoxGroup(\$model,'{$column->name}')";
		} else if (stripos($column->dbType, 'text') !== false) {
			return "\$form->textAreaGroup(\$model,'{$column->name}', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8'))))";
		} else {
			if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
				$inputField = 'passwordFieldGroup';
			} else {
				$inputField = 'textFieldGroup';
			}

			if ($column->type !== 'string' || $column->size === null) {
				if($column->dbType == 'date') {
					return "\$form->datePickerGroup(\$model,'{$column->name}',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'form-control')), 'prepend'=>'<i class=\"glyphicon glyphicon-calendar\"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.'))";
				} else {
					return "\$form->{$inputField}(\$model,'{$column->name}',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'form-control'))))";
				}
			} else {
				if (strpos ( $column->dbType, 'enum(' ) !== false) {
					$temp = $column->dbType;
					$temp = str_replace ( 'enum', 'array', $temp );
					// FIXME: What. The. Seriously, parse the enum declaration from MySQL as an array definition in PHP?!
					eval ( '$options = ' . $temp . ';' );
					$dropdown_options = "array(";
					foreach ( $options as $option ) {
						$dropdown_options .= "\"$option\"=>\"$option\",";
					}
					$dropdown_options .= ")";
					return "\$form->dropDownListGroup(\$model,'{$column->name}', array('widgetOptions'=>array('data'=>{$dropdown_options}, 'htmlOptions'=>array('class'=>'input-large form-control'))))";
				} else {
					return "\$form->{$inputField}(\$model,'{$column->name}',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'form-control','maxlength'=>$column->size))))";
				}
			}
		}
	}
        
        public function generateActiveField($modelClass,$column)
	{
		if($column->type==='boolean')
			return "\$form->checkBox(\$model,'{$column->name}')";
		elseif(stripos($column->dbType,'text')!==false)
			return "\$form->textArea(\$model,'{$column->name}',array('class'=>'form-control','rows'=>6, 'cols'=>50))";
		else
		{
			if(preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
				$inputField='passwordField';
			else
				$inputField='textField';

			if($column->type!=='string' || $column->size===null)
				return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'form-control'))";
			else
			{
				if(($size=$maxLength=$column->size)>60)
					$size=60;
				return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'form-control','size'=>$size,'maxlength'=>$maxLength))";
			}
		}
	}
        
}
