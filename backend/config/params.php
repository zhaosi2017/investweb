<?php
return [
    'adminEmail' => 'admin@example.com',
    'inputKey'   => 'CustomerSystem@Yii2+H+',
    'timeSwith' => 0,//开启按时间搜索功能,
    'updateSwitch'=>0,//开启修改名例详情开关
    'oneKeyOut'=>0 ,//一键导出;
     // rbac节点分类.
    'roleModule' => [
        'admin' => '用户模块',
        'authitem' => '角色模块',
        'alipay' => '支付宝管理',
        'invest' => '协查信息',
    ],
    // 指定那个用户为超级管理员.
    'administrator' => 'test1234',
];