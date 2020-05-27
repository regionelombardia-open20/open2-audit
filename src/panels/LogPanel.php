<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

namespace open20\amos\audit\panels;

use open20\amos\audit\components\panels\DataStoragePanelTrait;

use Yii;
use yii\debug\models\search\Log;
use yii\grid\GridViewAsset;

/**
 * LogPanel
 * @package open20\amos\audit\panels
 */
class LogPanel extends \yii\debug\panels\LogPanel
{
    use DataStoragePanelTrait;

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        $messageCount = isset($this->data['messages']) ? count($this->data['messages']) : 0;
        return $this->getName() . ($messageCount ? ' <small>(' . $messageCount . ')</small>' : '');
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $searchModel = new Log();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $this->getModels());

        return Yii::$app->view->render('@yii/debug/views/default/panels/log/detail', [
            'dataProvider' => $dataProvider,
            'panel' => $this,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $data = parent::save();
        return (isset($data['messages']) && count($data['messages']) > 0) ? $data : null;
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

}