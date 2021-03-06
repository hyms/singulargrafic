<?php

/**
 * This is the model class for table "cajaArqueo".
 *
 * The followings are the available columns in table 'cajaArqueo':
 * @property integer $idCajaArqueo
 * @property integer $idCaja
 * @property integer $idUser
 * @property double $monto
 * @property string $fechaArqueo
 * @property string $fechaVentas
 * @property integer $comprobante
 * @property double $saldo
 * @property integer $idCajaMovimientoVenta
 *
 * The followings are the available model relations:
 * @property CajaMovimientoVenta $idCajaMovimientoVenta0
 * @property Caja $idCaja0
 * @property User $idUser0
 */
class CajaArqueo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaArqueo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('monto, saldo', 'required'),
			array('idCaja, idUser, comprobante, idCajaMovimientoVenta', 'numerical', 'integerOnly'=>true),
			array('monto, saldo', 'numerical'),
			array('fechaArqueo, fechaVentas', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCajaArqueo, idCaja, idUser, monto, fechaArqueo, fechaVentas, comprobante, saldo, idCajaMovimientoVenta', 'safe', 'on'=>'search'),
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
			'idCajaMovimientoVenta0' => array(self::BELONGS_TO, 'CajaMovimientoVenta', 'idCajaMovimientoVenta'),
			'idCaja0' => array(self::BELONGS_TO, 'Caja', 'idCaja'),
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCajaArqueo' => 'Id Caja Arqueo',
			'idCaja' => 'Id Caja',
			'idUser' => 'Id User',
			'monto' => 'Monto',
			'fechaArqueo' => 'Fecha Arqueo',
			'fechaVentas' => 'Fecha Ventas',
			'comprobante' => 'Comprobante',
			'saldo' => 'Saldo',
			'idCajaMovimientoVenta' => 'Id Caja Movimiento Venta',
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

		$criteria->compare('idCajaArqueo',$this->idCajaArqueo);
		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('fechaArqueo',$this->fechaArqueo,true);
		$criteria->compare('fechaVentas',$this->fechaVentas,true);
		$criteria->compare('comprobante',$this->comprobante);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('idCajaMovimientoVenta',$this->idCajaMovimientoVenta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaArqueo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
