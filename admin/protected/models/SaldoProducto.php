<?php

/**
 * This is the model class for table "saldoProducto".
 *
 * The followings are the available columns in table 'saldoProducto':
 * @property integer $idsaldoProducto
 * @property integer $idAlmacen
 * @property integer $saldoU
 * @property integer $saldoP
 * @property string $fechaSaldo
 * @property string $fechaRealizado
 *
 * The followings are the available model relations:
 * @property AlmacenProducto $idAlmacen0
 */
class SaldoProducto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'saldoProducto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idAlmacen, saldoU, saldoP', 'numerical', 'integerOnly'=>true),
			array('fechaSaldo, fechaRealizado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsaldoProducto, idAlmacen, saldoU, saldoP, fechaSaldo, fechaRealizado', 'safe', 'on'=>'search'),
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
			'idAlmacen0' => array(self::BELONGS_TO, 'AlmacenProducto', 'idAlmacen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idsaldoProducto' => 'Idsaldo Producto',
			'idAlmacen' => 'Id Almacen',
			'saldoU' => 'Saldo U',
			'saldoP' => 'Saldo P',
			'fechaSaldo' => 'Fecha Saldo',
			'fechaRealizado' => 'Fecha Realizado',
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

		$criteria->compare('idsaldoProducto',$this->idsaldoProducto);
		$criteria->compare('idAlmacen',$this->idAlmacen);
		$criteria->compare('saldoU',$this->saldoU);
		$criteria->compare('saldoP',$this->saldoP);
		$criteria->compare('fechaSaldo',$this->fechaSaldo,true);
		$criteria->compare('fechaRealizado',$this->fechaRealizado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SaldoProducto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
