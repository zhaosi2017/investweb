<?php

namespace backend\controllers;

use backend\models\Admin;
use common\models\AuthAssignment;
use Yii;
use common\models\AuthItem;
use common\models\AuthItemSearch;
use common\models\AuthItemChild;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthitemController extends PController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 权限列表.
     */
    public function actionPrivilege()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 2);

        return $this->render('privilege', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionTrash()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('trash', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 新增权限.
     */
    public function actionCreatePrivilege()
    {
        $model = new AuthItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['privilege', 'id' => $model->name]);
        } else {
            return $this->render('create-privilege', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param integer $id 角色id.
     *
     * @return string|\yii\web\Response
     */
    public function actionAuth($id)
    {
        $model = $this->findModel($id);

        $auth = Yii::$app->authManager;
        if ($model->load(Yii::$app->request->post())) {
            $posts = Yii::$app->request->post();

            if (isset($posts['Auth'])) {
                AuthItemChild::deleteAll('parent=:id', [':id' => $model->name]);
                $role = $auth->getRole($model->name);
                //重新分配许可
                foreach ($posts['Auth'] as $permission){
                    $permissionData = $auth->getPermission($permission);
                    $auth->addChild($role, $permissionData);
                }
            } else {
                AuthItemChild::deleteAll('parent=:id', [':id' => $model->name]);
            }

            return $this->redirect(['auth', 'id' => $model->name]);
        } else {
            $alreadyAuth = $auth->getChildren($model->name);
            $alreadyAuth = array_keys($alreadyAuth);
            // 查出所以权限.
            $moduleArr = Yii::$app->params['roleModule'];

            $allPrivilegesArray = [];
            $allPrivileges = AuthItem::find()
                ->select(['name', 'description'])
                ->where(['type' => 2])
                ->orderBy('description')
                ->all();
            foreach ($allPrivileges as $pri) {
                $tmp = [];
                $tmodule = explode('/', $pri->name);
                $tmp['route'] = $pri->name;
                $tmp['description'] = $pri->description;
                $module = array_shift($tmodule);
                $allPrivilegesArray[$module][] = $tmp;
            }

            // 角色已经拥有的权限.
            return $this->render(
                'auth',
                [
                    'model' => $model,
                    'moduleArr' => $moduleArr,
                    'allPrivileges' => $allPrivilegesArray,
                    'alreadyAuth' => $alreadyAuth,
                ]
            );
        }
    }

    /**
     * 给用户分配角色.
     *
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUserRole($id)
    {
        $model = Admin::findOne($id);
        // 获取当前所以角色.
        $allRoles = Yii::$app->authManager->getRoles();
        $allRolesArray = ArrayHelper::map($allRoles, 'name', 'description');

        // 当前用户的权限.
        $userRoles =  Yii::$app->authManager->getRolesByUser($id);
        $userRolesArray = array_keys($userRoles);

        // 用表单提交过来的数据更新AuthAssignment, 从而用户角色发生变化.
        if (isset($_POST['newPri'])) {
            AuthAssignment::deleteAll('user_id=:id', [':id' => $id]);
            $newPri = $_POST['newPri'];
            $length = count($newPri);
            for($i=0; $i<$length; $i++) {
                $aPri = new AuthAssignment();
                $aPri->item_name = $newPri[$i];
                $aPri->user_id = $id;
                $aPri->created_at = time();

                $aPri->save();
            }

            return $this->redirect('/admin/index');
        }

        // 渲染checkboxlist表单.
        return $this->render('user-role', ['id' => $id, 'model' => $model, 'allRolesArray' => $allRolesArray, 'userRolesArray' => $userRolesArray]);
    }

    /**
     * 更新权限描述.
     */
    public function actionUpdatePermission($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/authitem/privilege', 'id' => $model->name]);
        } else {
            return $this->render('update-permission', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
