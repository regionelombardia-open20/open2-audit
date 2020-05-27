<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */
/**
 * Console compatible error handler
 */

namespace open20\amos\audit\components\console;

use open20\amos\audit\components\base\ErrorHandlerTrait;

/**
 * ErrorHandler
 * @package open20\amos\audit\components\console
 */
class ErrorHandler extends \yii\console\ErrorHandler
{
    use ErrorHandlerTrait;
}