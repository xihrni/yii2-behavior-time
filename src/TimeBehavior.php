<?php

namespace xihrni\yii2\behaviors;

use yii\db\ActiveRecord;

/**
 * 时间行为
 *
 * Class TimeBehavior
 * @package app\components\behaviors
 */
class TimeBehavior extends \yii\base\Behavior
{
    /**
     * @var string
     */
    public $createdAtAttribute = 'created_at';

    /**
     * @var string
     */
    public $updatedAtAttribute = 'updated_at';

    /**
     * @var string
     */
    public $deletedAtAttribute = 'deleted_at';

    /**
     * 事件
     *
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
        ];
    }

    /**
     * Insert 之前
     *
     * @param  object $event 事件类
     * @return void
     */
    public function beforeInsert($event)
    {
        $createdAt = $this->createdAtAttribute;

        unset($this->owner->$createdAt);
    }

    /**
     * Update 之前
     *
     * @param  object $event 事件
     * @return void
     */
    public function beforeUpdate($event)
    {
        $createdAt = $this->createdAtAttribute;
        $updatedAt = $this->updatedAtAttribute;
        $deletedAt = $this->deletedAtAttribute;

        unset($this->owner->$createdAt, $this->owner->$updatedAt);

        if ($this->owner->getAttribute($deletedAt) == $this->owner->getOldAttribute($deletedAt)) {
            unset($this->owner->$deletedAt);
        }
    }
}
