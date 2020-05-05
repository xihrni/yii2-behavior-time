# Yii2 时间行为

## Introduction
用于自动更新模型中数据库表的创建、更新和删除字段

## Install
```composer
$ composer require xihrni/yii2-behavior-time
```

## Demo
```mysql
CREATE TABLE `xi_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

```php
<?php

namespace app\models;

use xihrni\yii2\behaviors\TimeBehavior;

class Article extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%article}}';
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'time' => [
                'class' => TimeBehavior::className(),
            ],
        ]);
    }
}
```
