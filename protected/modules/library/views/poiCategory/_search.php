<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
            <form class="form-horizontal" role="form">
<?php $fields = PoiCategory::model()->attributeLabels(); ?>	                
        <div class="form-group">
            <label for="PoiCategory_poi_category_id" class="col-sm-2 control-label"><?php echo $fields['poi_category_id'];?></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="PoiCategory_poi_category_id" placeholder="<?php echo $fields['poi_category_id'];?>" name="PoiCategory[poi_category_id]">
            </div>
        </div>
		                
        <div class="form-group">
            <label for="PoiCategory_category_name" class="col-sm-2 control-label"><?php echo $fields['category_name'];?></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="PoiCategory_category_name" placeholder="<?php echo $fields['category_name'];?>" name="PoiCategory[category_name]">
            </div>
        </div>
	                
        <div class="form-group">
            <label for="PoiCategory_created_date" class="col-sm-2 control-label"><?php echo $fields['created_date'];?></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="PoiCategory_created_date" placeholder="<?php echo $fields['created_date'];?>" name="PoiCategory[created_date]">
            </div>
        </div>
	                
        <div class="form-group">
            <label for="PoiCategory_created_by" class="col-sm-2 control-label"><?php echo $fields['created_by'];?></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="PoiCategory_created_by" placeholder="<?php echo $fields['created_by'];?>" name="PoiCategory[created_by]">
            </div>
        </div>
	                
        <div class="form-group">
            <label for="PoiCategory_updated_date" class="col-sm-2 control-label"><?php echo $fields['updated_date'];?></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="PoiCategory_updated_date" placeholder="<?php echo $fields['updated_date'];?>" name="PoiCategory[updated_date]">
            </div>
        </div>
	                
        <div class="form-group">
            <label for="PoiCategory_updated_by" class="col-sm-2 control-label"><?php echo $fields['updated_by'];?></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="PoiCategory_updated_by" placeholder="<?php echo $fields['updated_by'];?>" name="PoiCategory[updated_by]">
            </div>
        </div>
	<div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="btnSearch" class="btn btn-primary btn-flat">Search</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>