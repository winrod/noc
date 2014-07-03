<?php

class InventoryController extends Controller
{
    /**
    * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
    * using two-column layout. See 'protected/views/layouts/column2.php'.
    */
    //public $layout='//layouts/column2';

    /**
    * @return array action filters
    */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','data'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    public function actionData(){
            
        Inventory::model()->search_string = $_GET['search']['value'] != "" ? $_GET['search']['value']:null;

        $dataProvider = Inventory::model()->data($_GET['order'][0]['column'], $_GET['order'][0]['dir'], $_GET['length'], $_GET['start'],$_GET['columns']);

        $count = Inventory::model()->countByAttributes(array('company_id'=>Yii::app()->user->company_id));

        $output = array(
                "draw" => intval($_GET['draw']),
                "recordsTotal" => $count,
                "recordsFiltered" => $dataProvider->totalItemCount,
                "data" => array()
        );
        
        
        
        foreach ($dataProvider->getData() as $key => $value) {
            $row = array();
                        $row['inventory_id']= $value->inventory_id;
                        $row['sku_id']= $value->sku_id;
                        $row['qty']= $value->qty;
                        $row['uom_id']= $value->uom_id;
                        $row['zone_id']= $value->zone_id;
                        $row['sku_status_id']= $value->sku_status_id;
                        $row['transaction_date']= $value->transaction_date;
                        $row['created_date']= $value->created_date;
                        $row['created_by']= $value->created_by;
                        $row['updated_date']= $value->updated_date;
                        $row['updated_by']= $value->updated_by;
                        $row['expiration_date']= $value->expiration_date;
                        $row['reference_no']= $value->reference_no;
                        
                        
            $row['links']= '<a class="view" title="View" data-toggle="tooltip" href="'.$this->createUrl('/inventory/inventory/view',array('id'=>$value->inventory_id)).'" data-original-title="View"><i class="fa fa-eye"></i></a>'
                        . '&nbsp;<a class="update" title="Update" data-toggle="tooltip" href="'.$this->createUrl('/inventory/inventory/update',array('id'=>$value->inventory_id)).'" data-original-title="View"><i class="fa fa-pencil"></i></a>'
                        . '&nbsp;<a class="delete" title="Delete" data-toggle="tooltip" href="'.$this->createUrl('/inventory/inventory/delete',array('id'=>$value->inventory_id)).'" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>';

            $output['data'][] = $row;
        }

        echo json_encode( $output );
    }

    /**
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
    public function actionView($id)
    {
        $model=$this->loadModel($id);

        $this->pageTitle = 'View Inventory '.$model->inventory_id;

        $this->menu=array(
                array('label'=>'Create Inventory', 'url'=>array('create')),
                array('label'=>'Update Inventory', 'url'=>array('update', 'id'=>$model->inventory_id)),
                array('label'=>'Delete Inventory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->inventory_id),'confirm'=>'Are you sure you want to delete this item?')),
                array('label'=>'Manage Inventory', 'url'=>array('admin')),
                '',
                array('label'=>'Help', 'url' => '#'),
        );
        
        $this->render('view',array(
            'model'=>$model,
        ));
    }

    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate()
    {
        
        $this->pageTitle = 'Create Inventory';

        $this->menu=array(
                array('label'=>'Manage Inventory', 'url'=>array('admin')),
                '',
                array('label'=>'Help', 'url' => '#'),
        );
    
        $model=new Inventory('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Inventory']))
        {
            $model->attributes=$_POST['Inventory'];
            if($model->save()){
                Yii::app()->user->setFlash('success',"Successfully created");
                $this->redirect(array('view','id'=>$model->inventory_id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
    */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
            
        $this->menu=array(
                array('label'=>'Create Inventory', 'url'=>array('create')),
                array('label'=>'View Inventory', 'url'=>array('view', 'id'=>$model->inventory_id)),
                array('label'=>'Manage Inventory', 'url'=>array('admin')),
                '',
                array('label'=>'Help', 'url' => '#'),
        );

        $this->pageTitle = 'Update Inventory '.$model->inventory_id;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Inventory']))
        {
            $model->attributes=$_POST['Inventory'];
            if($model->save()){
                Yii::app()->user->setFlash('success',"Successfully updated");
                $this->redirect(array('view','id'=>$model->inventory_id));
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax'])){
                Yii::app()->user->setFlash('success',"Successfully deleted");
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }else{

                echo "Successfully deleted";
                exit;

            }
        }
        else
        throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
    * Lists all models.
    */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Inventory');
        
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $this->layout='//layouts/column1';
        $this->pageTitle = 'Manage Inventory';
        
        $model=new Inventory('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Inventory']))
            $model->attributes=$_GET['Inventory'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer the ID of the model to be loaded
    */
    public function loadModel($id)
    {
        $model=Inventory::model()->findByAttributes(array('inventory_id'=>$id,'company_id'=>Yii::app()->user->company_id));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

        return $model;
    }

    /**
    * Performs the AJAX validation.
    * @param CModel the model to be validated
    */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='inventory-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
