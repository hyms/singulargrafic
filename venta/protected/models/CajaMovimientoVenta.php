<?php

/**
 * This is the model class for table "cajaMovimientoVenta".
 *
 * The followings are the available columns in table 'cajaMovimientoVenta':
 * @property integer $idCajaMovimientoVenta
 * @property integer $idUser
 * @property double $monto
 * @property string $motivo
 * @property string $fechaMovimiento
 * @property integer $tipo //0=entrada de dinero; 1= salida de dienero, -1=movimiento interno
 * @property integer $arqueo
 * @property integer $idCaja
 *
 * The followings are the available model relations:
 * @property CTP[] $cTPs
 * @property Imprenta[] $imprentas
 * @property CajaArqueo[] $cajaArqueos
 * @property Caja $idCaja0
 * @property User $idUser0
 * @property Recibos[] $reciboses
 * @property Venta[] $ventas
 */
class CajaMovimientoVenta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cajaMovimientoVenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('monto, motivo, tipo', 'required'),
			array('idUser, tipo, arqueo, idCaja', 'numerical', 'integerOnly'=>true),
			array('monto', 'numerical'),
			array('motivo', 'length', 'max'=>100),
			array('fechaMovimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCajaMovimientoVenta, idUser, monto, motivo, fechaMovimiento, tipo, arqueo, idCaja', 'safe', 'on'=>'search'),
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
			'cTPs' => array(self::HAS_MANY, 'CTP', 'idCajaMovimientoVenta'),
			'imprentas' => array(self::HAS_MANY, 'Imprenta', 'idCajaMovimientoVenta'),
			'cajaArqueos' => array(self::HAS_MANY, 'CajaArqueo', 'idCajaMovimientoVenta'),
			'idCaja0' => array(self::BELONGS_TO, 'Caja', 'idCaja'),
			'idUser0' => array(self::BELONGS_TO, 'Users', 'idUser'),
			'reciboses' => array(self::HAS_MANY, 'Recibos', 'idCajaMovimientoVenta'),
			'ventas' => array(self::HAS_MANY, 'Venta', 'idCajaMovimientoVenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCajaMovimientoVenta' => 'Id Caja Movimiento Venta',
			'idUser' => 'Id User',
			'monto' => 'Monto',
			'motivo' => 'Motivo',
			'fechaMovimiento' => 'Fecha Movimiento',
			'tipo' => 'Tipo',
			'arqueo' => 'Arqueo',
			'idCaja' => 'Id Caja',
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

		$criteria->compare('idCajaMovimientoVenta',$this->idCajaMovimientoVenta);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('motivo',$this->motivo,true);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('arqueo',$this->arqueo);
		$criteria->compare('idCaja',$this->idCaja);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CajaMovimientoVenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
