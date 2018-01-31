<?php
namespace tests\_fixtures;
use yii\test\ActiveFixture;
/**
 * User fixture
 */
class UserFixture extends ActiveFixture
{
    public $modelClass = 'app\models\User';
    public $dataFile = '@tests/_fixtures/data/user.php';
}