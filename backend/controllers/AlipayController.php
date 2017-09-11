<?php
namespace backend\controllers;

use backend\models\Alipay;
use backend\models\AlipayForm;
use backend\models\AlipaySearch;
use backend\models\AlipayWarn;
use backend\models\AlipayWarnForm;
use backend\models\PasswordForm;
use Yii;
use backend\models\Admin;
use backend\models\AdminSearch;
use backend\controllers\PController;
use yii\base\ErrorException;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use backend\models\MyDbManager;
use backend\models\LoginLogsSearch;
use yii\web\UploadedFile;
use SphinxClient;
/**
 * ManagerController implements the CRUD actions for Manager model.
 */
class AlipayController extends PController
{

    public function actionIndex()
    {
        $searchModel = new AlipaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new AlipayForm();
        if(Yii::$app->request->isPost){
            $model->file = UploadedFile::getInstance($model, 'file');
            if ( $model->validate()) {
                if( !in_array($model->file->extension,['xlsx','xls'] )){
                    $model->addError('file','文件后缀名必须是xlsx,xls');
                    return $this->render('create',['model'=>$model]);
                }
                ini_set('memory_limit', '-1');
                set_time_limit(0);
                $filename = 'uploads/' . $model->file->baseName.time() . '.' . $model->file->extension;

                if(!$model->file->saveAs($filename)) {
                    Yii::$app->session->setFlash('error','导入失败');
                    return $this->render('create',['model'=>$model]);
                }
                libxml_use_internal_errors(true);
                try{
                    $data = \moonland\phpexcel\Excel::widget([
                        'mode' => 'import',
                        'fileName' => APP_ROOT.'/'.$filename,
                        'setFirstRecordAsKeys' => true,
                        'setIndexSheetByName' => true,
                        'getOnlySheet' => 'Sheet2',
                    ]);

                }catch (ErrorException $e) {
                    Yii::$app->session->setFlash('error',$e->getMessage());
                    return $this->redirect('index')->send();
                }

                if(!empty($data)) {
                    $_data = [];
                    foreach ($data as $key => $val) {
                        $tmp = [];
                        $tmp['系统日期'] = $val['协查系统日期'];
                        $tmp['名例名称'] = $val['实例名称'];
                        $tmp['名例详情'] = $val['实例详情'];
                        $tmp['调取账户'] = $val['调取账户'];
                        $tmp['time'] = isset($tmp['系统日期'])? strtotime($tmp['系统日期']):'0';
                        $_data[$key] = $tmp;
                        $count  = count($_data);
                        if ($count >= 500) {
                            try {
                                Yii::$app->db->createCommand()
                                    ->batchInsert(Alipay::tableName(), ['systime', 'title', 'detail', 'account', 'time'],
                                        $_data)
                                    ->execute();
                                $_data = [];
                            } catch (Exception $e) {
                                Yii::$app->session->setFlash('error',substr($e->getMessage(),0,100));
                                return $this->redirect('index')->send();
                            }
                        }
                    }

                    // 少于500的情况.
                    if (!empty($_data)) {
                        try {
                            Yii::$app->db->createCommand()
                                ->batchInsert(Alipay::tableName(), ['systime', 'title', 'detail', 'account', 'time'],
                                    $_data)
                                ->execute();
                        } catch (Exception $e) {
                            Yii::$app->session->setFlash('error',substr($e->getMessage(),0,100));
                            return $this->redirect('index')->send();
                        }
                    }

                }else{
                    Yii::$app->session->setFlash('info','导入的数据为空');
                    return $this->render('create',['model'=>$model]);
                }

                Yii::$app->session->setFlash('success','导入成功');
                return $this->redirect('index')->send();
            }else{
                return $this->render('create',['model'=>$model]);
            }
        }
        return $this->render('create',['model'=>$model]);
    }

    public function actionAdd()
    {
        $model = new AlipayWarnForm();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->create())
            {
                Yii::$app->session->setFlash('success','操作成功');
                return $this->redirect('index');
            }else{
                return $this->render('add',['model'=>$model]);
            }

        }
        $res = AlipayWarn::find()->one();
        if(!empty($res)){
            $model->title = $res->title;
        }

        return $this->render('add',['model'=>$model]);
    }

    public function actionUpdate($id)
    {
        $model = Alipay::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setScenario('update-detail');
            if($model->update()) {
                Yii::$app->session->setFlash('success','操作成功');
            } else{
                Yii::$app->session->setFlash('error','操作失败');
            }
            return $this->render('update', [
                'model' => $model,
            ]);

        }
        return $this->render('update', [
            'model' => $model,
        ]);


    }

    public function actionOneSearch()
    {
        $alipayWarn = AlipayWarn::find()->one();
        if(empty($alipayWarn))
        {
            Yii::$app->session->setFlash('info','请先添加预警搜索信息');
            return $this->redirect('add');
        }
        $title = $alipayWarn->title;
        $alipay = new Alipay();
        $query = $alipay->oneSearch($title);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize'   => 10,
        ]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if(empty($models))
        {
            Yii::$app->session->setFlash('error','没有相关数据');
            return $this->redirect('index');
        }
        return $this->render('one-search',['model'=>$models,'pages'=>$pages]);

    }

    public function actionOneOut()
    {
        $alipayWarn = AlipayWarn::find()->one();
        if(empty($alipayWarn))
        {
            Yii::$app->session->setFlash('info','请先添加预警搜索信息');
            return $this->redirect('add');
        }
        $title = $alipayWarn->title;
        $alipay = new Alipay();
        $query = $alipay->oneSearch($title);
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $data = $query->select(['systime','title','detail','account'])->all();
        try{
            \moonland\phpexcel\Excel::export([
                'models' => $data,
                'columns' => ['systime','title','detail','account'],
            ]);
        }catch (\yii\base\Exception $e){
            echo $e->getMessage();
        }

    }


}