<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

namespace open20\amos\audit\components;

use open20\amos\audit\Audit;


/**
 * Class Migration
 * @package open20\amos\audit\components
 */
class Migration extends \yii\db\Migration
{

    /**
     *
     */
    public function init()
    {
        /** @var Audit $audit */
        $audit = \Yii::$app->getModule('audit');
        if ($audit) {
            $this->db = $audit->db;
        }
        parent::init();
    }

}