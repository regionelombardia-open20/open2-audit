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

use Yii;
use open20\amos\audit\models\AuditError;
use open20\amos\audit\components\panels\DataStoragePanel;
use yii\data\ArrayDataProvider;

/**
 * Class CurlPanel
 * @package open20\amos\audit\src\panels
 */
class SoapPanel extends DataStoragePanel
{
    public function getName()
    {
        return Yii::t('audit', 'SOAP');
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->data) . ')</small>';
    }

    /**
     * Receives a bunch of information about a SOAP request and logs it.
     * If you are unable to use the modules' SoapClient class you can call this function manually to log the data.
     *
     * @param array $data
     */
    public function logSoapRequest($data)
    {
        $this->module->registerPanel($this);

        if (!is_array($this->data))
            $this->data = [];

        if (isset($data['error'])) {
            $error = $this->module->exception($data['error']);
            $data['error'] = [$data['error']->faultcode, $error ? $error->id : null];
        }
        $this->data[] = array_filter($data);
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

        return Yii::$app->view->render('panels/soap/index', [
            'panel'        => $this,
            'dataProvider' => $dataProvider,
        ]);
    }
}