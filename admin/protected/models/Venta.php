<?php

/**
 * This is the model class for table "venta".
 *
 * The followings are the available columns in table 'venta':
 * @property integer $idVenta
 * @property integer $idCaja
 * @property string $fechaVenta
 * @property integer $tipoVenta
 * @property string $formaPago
 * @property integer $idCliente
 * @property string $fechaPlazo
 * @property string $codigo
 * @property integer $serie
 * @property double $montoVenta
 * @property double $montoPagado
 * @property double $montoCambio
 * @property double $montoDescuento
 * @property integer $estado
 * @property string $factura
 * @property string $autorizado
 * @property string $responsable
 *
 * The followings are the available model relations:
 * @property DetalleVenta[] $detalleVentas
 * @property Cliente $idCliente0
 * @property CajaVenta $idCaja0
 */
class Venta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'venta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCaja, tipoVenta, idCliente, serie, estado', 'numerical', 'integerOnly'=>true),
			array('montoVenta, montoPagado, montoCambio, montoDescuento', 'numerical'),
			array('codigo', 'length', 'max'=>45),
			array('factura, autorizado, responsable', 'length', 'max'=>50),
			array('fechaVenta, formaPago, fechaPlazo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idVenta, idCaja, fechaVenta, tipoVenta, formaPago, idCliente, fechaPlazo, codigo, serie, montoVenta, montoPagado, montoCambio, montoDescuento, estado, factura, autorizado, responsable', 'safe', 'on'=>'search'),
		);
	}
	public $cant; 
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'detalleVentas' => array(self::HAS_MANY, 'DetalleVenta', 'idVenta'),
			'idCliente0' => array(self::BELONGS_TO, 'Cliente', 'idCliente'),
			'idCaja0' => array(self::BELONGS_TO, 'CajaVenta', 'idCaja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idVenta' => 'Id Venta',
			'idCaja' => 'Id Caja',
			'fechaVenta' => 'Fecha Venta',
			'tipoVenta' => 'Tipo Venta',
			'formaPago' => 'Forma Pago',
			'idCliente' => 'Id Cliente',
			'fechaPlazo' => 'Fecha Plazo',
			'codigo' => 'Codigo',
			'serie' => 'Serie',
			'montoVenta' => 'Monto Venta',
			'montoPagado' => 'Monto Pagado',
			'montoCambio' => 'Monto Cambio',
			'montoDescuento' => 'Monto Descuento',
			'estado' => 'Estado',
			'factura' => 'Factura',
			'autorizado' => 'Autorizado',
			'responsable' => 'Responsable',
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

		$criteria->compare('idVenta',$this->idVenta);
		$criteria->compare('idCaja',$this->idCaja);
		$criteria->compare('fechaVenta',$this->fechaVenta,true);
		$criteria->compare('tipoVenta',$this->tipoVenta);
		$criteria->compare('formaPago',$this->formaPago,true);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('fechaPlazo',$this->fechaPlazo,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('serie',$this->serie);
		$criteria->compare('montoVenta',$this->montoVenta);
		$criteria->compare('montoPagado',$this->montoPagado);
		$criteria->compare('montoCambio',$this->montoCambio);
		$criteria->compare('montoDescuento',$this->montoDescuento);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('factura',$this->factura,true);
		$criteria->compare('autorizado',$this->autorizado,true);
		$criteria->compare('responsable',$this->responsable,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Venta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
