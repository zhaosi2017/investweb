<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // 添加 权限.
        $UserList = $auth->createPermission('admin/index');
        $UserList->description = '用户列表';
        $auth->add($UserList);

        // 添加 权限.
        $UserTrash = $auth->createPermission('admin/trash');
        $UserTrash->description = '用户垃圾筒';
        $auth->add($UserTrash);

        // 添加 权限.
        $createUser = $auth->createPermission('admin/create');
        $createUser->description = '创建用户';
        $auth->add($createUser);

        // 添加 权限.
        $deleteUser = $auth->createPermission('admin/delete');
        $deleteUser->description = '删除用户';
        $auth->add($deleteUser);

        // 添加 权限.
        $updateUser = $auth->createPermission('admin/update');
        $updateUser->description = '更新用户';
        $auth->add($updateUser);

        // 添加 权限.
        $UserPrivilege = $auth->createPermission('admin/privilege');
        $UserPrivilege->description = '用户角色分配';
        $auth->add($UserPrivilege);

        // 添加 权限.
        $log = $auth->createPermission('admin/login-logs');
        $log->description = '登陆日志';
        $auth->add($log);

        // 添加 权限.
        $roleList = $auth->createPermission('role/index');
        $roleList->description = '角色列表';
        $auth->add($roleList);

        // 添加 权限.
        $roleTrash = $auth->createPermission('role/trash');
        $roleTrash->description = '角色垃圾筒';
        $auth->add($roleTrash);

        // 添加 权限.
        $updateRole = $auth->createPermission('role/update');
        $updateRole->description = '编辑角色';
        $auth->add($updateRole);

        // 添加 权限.
        $authRole = $auth->createPermission('role/auth');
        $authRole->description = '角色权限分配';
        $auth->add($authRole);

        // 添加 权限.
        $deleteRole = $auth->createPermission('role/delete');
        $deleteRole->description = '删除角色';
        $auth->add($deleteRole);

        // 添加 "author" 角色并赋予 "createPost" 权限
        $author = $auth->createRole('userManager');
        $auth->add($author);
        $auth->addChild($author, $UserList);
        $auth->addChild($author, $UserTrash);
        $auth->addChild($author, $createUser);
        $auth->addChild($author, $deleteUser);
        $auth->addChild($author, $updateUser);
        $auth->addChild($author, $UserPrivilege);
        $auth->addChild($author, $log);
        $auth->addChild($author, $roleList);
        $auth->addChild($author, $roleTrash);
        $auth->addChild($author, $updateRole);
        $auth->addChild($author, $authRole);
        $auth->addChild($author, $deleteRole);

        // 添加 "admin" 角色并赋予 "updatePost"
        // 和 "author" 权限
        /*
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);
        */

        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($author, 2);
        $auth->assign($author, 1);
    }
}