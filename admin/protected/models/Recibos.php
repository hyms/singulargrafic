<?php

/**
 * This is the model class for table "recibos".
 *
 * The followings are the available columns in table 'recibos':
 * @property integer $idRecibos
 * @property string $categoria
 * @property string $codigo
 * @property integer $idCliente
 * @property string $responsable
 * @property string $celular
 * @property string $fechaRegistro
 * @property string $concepto
 * @property string $codigoNumero
 * @property string $servicio
 * @property double $monto
 * @property double $acuenta
 * @property double $saldo
 * @property string $obs
 * @property integer $tipoRecivo
 * @property double $descuento
 * @property integer $idCajaMovimientoVenta
 * @property integer $idSucursal
 *
 * The followings are the available model relations:
 * @property CajaMovimientoVenta $idCajaMovimientoVenta0
 * @property Cliente $idCliente0
 * @property Sucursal $idSucursal0
 */
class Recibos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recibos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCajaMovimientoVenta', 'required'),
			array('idCliente, tipoRecivo, idCajaMovimientoVenta, idSucursal', 'numerical', 'integerOnly'=>true),
			array('monto, acuenta, saldo, descuento', 'numerical'),
			array('categoria, responsable', 'length', 'max'=>40),
			array('codigo, celular, codigoNumero, servicio', 'length', 'max'=>20),
			array('concepto', 'length', 'max'=>100),
			array('obs', 'length', 'max'=>200),
			array('fechaRegistro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idRecibos, categoria, codigo, idCliente, responsable, celular, fechaRegistro, concepto, codigoNumero, servicio, monto, acuenta, saldo, obs, tipoRecivo, descuento, idCajaMovimientoVenta, idSucursal', 'safe', 'on'=>'search'),
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
			'idCliente0' => array(self::BELONGS_TO, 'Cliente', 'idCliente'),
			'idSucursal0' => array(self::BELONGS_TO, 'Sucursal', 'idSucursal'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idRecibos' => 'Id Recibos',
			'categoria' => 'Categoria',
			'codigo' => 'Codigo',
			'idCliente' => 'Id Cliente',
			'responsable' => 'Responsable',
			'celular' => 'Celular',
			'fechaRegistro' => 'Fecha Registro',
			'concepto' => 'Concepto',
			'codigoNumero' => 'Codigo Numero',
			'servicio' => 'Servicio',
			'monto' => 'Monto',
			'acuenta' => 'Acuenta',
			'saldo' => 'Saldo',
			'obs' => 'Obs',
			'tipoRecivo' => 'Tipo Recivo',
			'descuento' => 'Descuento',
			'idCajaMovimientoVenta' => 'Id Caja Movimiento Venta',
			'idSucursal' => 'Id Sucursal',
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

		$criteria->compare('idRecibos',$this->idRecibos);
		$criteria->compare('categoria',$this->categoria,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('responsable',$this->responsable,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);
		$criteria->compare('concepto',$this->concepto,true);
		$criteria->compare('codigoNumero',$this->codigoNumero,true);
		$criteria->compare('servicio',$this->servicio,true);
		$criteria->compare('monto',$this->monto);
		$criteria->compare('acuenta',$this->acuenta);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('obs',$this->obs,true);
		$criteria->compare('tipoRecivo',$this->tipoRecivo);
		$criteria->compare('descuento',$this->descuento);
		$criteria->compare('idCajaMovimientoVenta',$this->idCajaMovimientoVenta);
		$criteria->compare('idSucursal',$this->idSucursal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recibos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
