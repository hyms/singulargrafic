<?php

/**
 * This is the model class for table "Imprenta".
 *
 * The followings are the available columns in table 'Imprenta':
 * @property integer $idImprenta
 * @property string $fechaOrden
 * @property integer $tipoOrden
 * @property integer $formaPago
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
 * @property string $obs
 * @property integer $idCajaMovimientoVenta
 * @property integer $numero
 * @property integer $idUserOT
 * @property integer $idUserVenta
 *
 * The followings are the available model relations:
 * @property CTP[] $cTPs
 * @property Cliente $idCliente0
 * @property CajaMovimientoVenta $idCajaMovimientoVenta0
 * @property User $idUserOT0
 * @property User $idUserVenta0
 */
class Imprenta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Imprenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('montoVenta, montoPagado, montoCambio, montoDescuento, estado, idUserOT, idUserVenta', 'required'),
			array('tipoOrden, formaPago, idCliente, serie, estado, idCajaMovimientoVenta, numero, idUserOT, idUserVenta', 'numerical', 'integerOnly'=>true),
			array('montoVenta, montoPagado, montoCambio, montoDescuento', 'numerical'),
			array('codigo', 'length', 'max'=>45),
			array('factura, autorizado, responsable', 'length', 'max'=>50),
			array('obs', 'length', 'max'=>200),
			array('fechaOrden, fechaPlazo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idImprenta, fechaOrden, tipoOrden, formaPago, idCliente, fechaPlazo, codigo, serie, montoVenta, montoPagado, montoCambio, montoDescuento, estado, factura, autorizado, responsable, obs, idCajaMovimientoVenta, numero, idUserOT, idUserVenta', 'safe', 'on'=>'search'),
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
			'cTPs' => array(self::HAS_MANY, 'CTP', 'idImprenta'),
			'idCliente0' => array(self::BELONGS_TO, 'Cliente', 'idCliente'),
			'idCajaMovimientoVenta0' => array(self::BELONGS_TO, 'CajaMovimientoVenta', 'idCajaMovimientoVenta'),
			'idUserOT0' => array(self::BELONGS_TO, 'User', 'idUserOT'),
			'idUserVenta0' => array(self::BELONGS_TO, 'User', 'idUserVenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idImprenta' => 'Id Imprenta',
			'fechaOrden' => 'Fecha Orden',
			'tipoOrden' => 'Tipo Orden',
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
			'obs' => 'Obs',
			'idCajaMovimientoVenta' => 'Id Caja Movimiento Venta',
			'numero' => 'Numero',
			'idUserOT' => 'Id User Ot',
			'idUserVenta' => 'Id User Venta',
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

		$criteria->compare('idImprenta',$this->idImprenta);
		$criteria->compare('fechaOrden',$this->fechaOrden,true);
		$criteria->compare('tipoOrden',$this->tipoOrden);
		$criteria->compare('formaPago',$this->formaPago);
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
		$criteria->compare('obs',$this->obs,true);
		$criteria->compare('idCajaMovimientoVenta',$this->idCajaMovimientoVenta);
		$criteria->compare('numero',$this->numero);
		$criteria->compare('idUserOT',$this->idUserOT);
		$criteria->compare('idUserVenta',$this->idUserVenta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imprenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
