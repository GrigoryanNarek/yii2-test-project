<?php
namespace tests\unit\modules\user\models;
use app\models\User;
use Codeception\Test\Unit;
use app\tests\codeception\unit\fixtures\UserFixture;

class UserTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    public function _before()
    {
//        $this->tester->haveFixtures([
//            'user' => [
//                'class' => UserFixture::className(),
//                'dataFile' => '@tests/_fixtures/data/user.php'
//            ]
//        ]);
    }
    public function testValidateWrongData()
    {
        $model = new User([
            'nik' => '',
        ]);
        expect('model is not valid', $model->validate())->false();
        expect('Nik cannot be blank.', $model->errors)->hasKey('nik');
    }

    public function testValidateExistingData()
    {
//        $model = new User([
//            'nik' => 'admin',
//        ]);
//        expect('model is not valid', $model->validate())->false();
//        expect('nik exists', $model->errors)->hasKey('nik');
    }

    public function testValidateCorrectData()
    {
        $model = new User([
            'nik' => 'task',
            'balance' => '12',
        ]);
        expect('model is valid', $model->validate())->true();
    }

    public function testValidateWrongDataLength()
    {
        $model = new User([
            'nik' => 'tasktaske',
        ]);
        expect('Nik should contain at most 5 characters', $model->validate())->false();
    }

    public function testValidateWrongBalanceData()
    {
        $model = new User([
            'nik' => 'task',
            'balance' => 'task',
        ]);
        expect('balance is not valid', $model->validate())->false();
    }

    public function testValidateNullBalanceData()
    {
        $model = new User([
            'nik' => 'task',
            'balance' => '0',
        ]);
        expect('balance is not valid', $model->validate())->false();
    }
}