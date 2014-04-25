<?php

/**
 * This is the model class for table "credito".
 *
 * The followings are the available columns in table 'credito':
 * @property integer $id
 * @property integer $idVenta
 * @property double $monto
 * @property double $saldo
 * @property string $fechaPago
 * @property integer $idRecibo
 * @property integer $idCliente
 */
class Credito extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'credito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idVenta, monto, saldo, fechaPago, idRecibo, idCliente', 'required'),
			array('idVenta, idRecibo, idCliente', 'numerical', 'integerOnly'=>true),
			array('monto, saldo', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idVenta, monto, saldo, fechaPago, idRecibo, idCliente', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'Cliente'=>array(self::BELONGS_TO, 'Cliente', 'idCliente'),
				'Venta'=>array(self::BELONGS_TO, 'Venta', 'idVenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idVenta' => 'Id Venta',
			'monto' => 'Monto',
			'saldo' => 'Saldo',
			'fechaPago' => 'Fecha Pago',
			'idRecibo' => 'Id Recibo',
			'idCliente' => 'Id Cliente',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('idVenta',$this->idVenta);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('fechaPago',$this->fechaPago,true);
		$criteria->compare('idRecibo',$this->idRecibo);
		$criteria->compare('idCliente',$this->idCliente);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Credito the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
