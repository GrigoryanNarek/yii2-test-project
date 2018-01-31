<?php
namespace tests\unit\modules\user\controllers;
use app\controllers\SiteController;
use Codeception\Test\Unit;
use Yii;
use yii\web\Controller;
use app\models\User;

class SiteControllerTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public function _before()
    {
    }

    public function testCorrectIndex()
    {
        $model = new User([
            'nik' => 'task',
            'balance' => 31
        ]);
        expect('nik is valid', $model->validate())->true();
        expect('balance is valid', $model->validate())->true();
    }

    public function testWringIndex()
    {
        $model = new User([
            'nik' => '',
            'balance' => 'balance'
        ]);
        expect('nik is not valid', $model->validate())->false();
        expect('balance is not valid', $model->validate())->false();
    }

    public function testCorrectLogin()
    {
        $model = new User([
            'nik' => 'task',
        ]);
        expect('nik is valid', $model->validate())->true();
    }

    public function testWrongLogin()
    {
        $model = new User([
            'nik' => '',
        ]);
        expect('nik is not valid', $model->validate())->false();
    }
}