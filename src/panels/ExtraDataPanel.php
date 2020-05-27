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

use open20\amos\audit\components\panels\DataStoragePanel;

use Yii;
use yii\data\ArrayDataProvider;
use yii\grid\GridViewAsset;

/**
 * ExtraDataPanel
 * @package open20\amos\audit\panels
 */
class ExtraDataPanel extends DataStoragePanel
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->module->registerFunction('data', [$this, 'trackData']);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return Yii::t('audit', 'Extra Data');
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->data) . ')</small>';
    }

    /**
     * @param $type
     * @param $data
     */
    public function trackData($type, $data)
    {
        $this->module->getEntry(true);
        if (!is_array($this->data))
            $this->data = [];

        $this->data[] = ['type' => $type, 'data' => $data];
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $dataProvider = new ArrayDataProvider();
        $dataProvider->allModels = $this->data;

        return Yii::$app->view->render('panels/extra/detail', [
            'panel'        => $this,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

}