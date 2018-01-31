<?php
namespace models;


use app\models\Transactions;

class TransactionsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testValidateCorrectData()
    {
        $model = new Transactions([
            'sum' => '31',
        ]);
        expect('model is valid', $model->validate())->true();
    }

    public function testValidateWrongData()
    {
        $model = new Transactions([
            'sum' => 'tasl',
        ]);
        expect('Sum must be a number.', $model->validate())->false();
    }

    public function testValidateWrongBalanceData()
    {
        $model = new Transactions([
            'sum' => '-31',
        ]);
        expect('Sum in not vallid.', $model->validate())->false();
    }


}