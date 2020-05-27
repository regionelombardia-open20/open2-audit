<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

use open20\amos\audit\models\AuditError;

class m150622_000003_update_audit_error extends \yii\db\Migration
{
    const TABLE = '{{%audit_error}}';

    public function up()
    {
        $this->addColumn(self::TABLE, 'emailed', 'int(11) NOT NULL AFTER trace');
        AuditError::updateAll(['emailed' => 1]); // set to 1 so we don't email all the old errors
    }

    public function down()
    {
        $this->dropColumn(self::TABLE, 'emailed');
    }
}