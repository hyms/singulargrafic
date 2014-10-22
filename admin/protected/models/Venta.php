<?php

/**
 * This is the model class for table "venta".
 *
 * The followings are the available columns in table 'venta':
 * @property integer $idVenta
 * @property string $fechaVenta
 * @property integer $tipoVenta
 * @property integer $formaPago
 * @property integer $idCliente
 * @property string $fechaPlazo
 * @property string $codigo
 * @property integer $numero
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
 * @property integer $idSucursal
 *
 * The followings are the available model relations:
 * @property DetalleVenta[] $detalleVentas
 * @property CajaMovimientoVenta $idCajaMovimientoVenta0
 * @property Cliente $idCliente0
 * @property Sucursal $idSucursal0
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
			array('numero', 'required'),
			array('tipoVenta, formaPago, idCliente, numero, serie, estado, idCajaMovimientoVenta, idSucursal', 'numerical', 'integerOnly'=>true),
			array('montoVenta, montoPagado, montoCambio, montoDescuento', 'numerical'),
			array('codigo', 'length', 'max'=>45),
			array('factura, autorizado, responsable', 'length', 'max'=>50),
			array('obs', 'length', 'max'=>200),
			array('fechaVenta, fechaPlazo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idVenta, fechaVenta, tipoVenta, formaPago, idCliente, fechaPlazo, codigo, numero, serie, montoVenta, montoPagado, montoCambio, montoDescuento, estado, factura, autorizado, responsable, obs, idCajaMovimientoVenta, idSucursal', 'safe', 'on'=>'search'),
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
			'detalleVentas' => array(self::HAS_MANY, 'DetalleVenta', 'idVenta'),
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
			'idVenta' => 'Id Venta',
			'fechaVenta' => 'Fecha Venta',
			'tipoVenta' => 'Tipo Venta',
			'formaPago' => 'Forma Pago',
			'idCliente' => 'Id Cliente',
			'fechaPlazo' => 'Fecha Plazo',
			'codigo' => 'Codigo',
			'numero' => 'Numero',
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

		$criteria->compare('idVenta',$this->idVenta);
		$criteria->compare('fechaVenta',$this->fechaVenta,true);
		$criteria->compare('tipoVenta',$this->tipoVenta);
		$criteria->compare('formaPago',$this->formaPago);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('fechaPlazo',$this->fechaPlazo,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('numero',$this->numero);
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
		$criteria->compare('idSucursal',$this->idSucursal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public $apellido;
    public $nit;
    public function searchDistribuidora()
    {
        $criteria=new CDbCriteria;

        $criteria->with= array(
            'idCliente0','idCajaMovimientoVenta0',
        );
        $criteria->order='fechaVenta ASC';
        //$criteria->limit = 200;
        //$criteria->condition = 'idAlmacen=2';

        $criteria->compare('idVenta',$this->idVenta);
        $criteria->compare('fechaVenta',$this->fechaVenta,true);
        $criteria->compare('idCliente',$this->idCliente);
        $criteria->compare('codigo',$this->codigo,true);
        $criteria->compare('montoVenta',$this->montoVenta);
        $criteria->compare('montoPagado',$this->montoPagado);
        $criteria->compare('montoCambio',$this->montoCambio);
        $criteria->compare('montoDescuento',$this->montoDescuento);
        $criteria->compare('tipoVenta',$this->tipoVenta);
        $criteria->compare('idCliente0.apellido',$this->apellido,true);
        $criteria->compare('idCliente0.nitCi',$this->nit);

        $data=new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
        Yii::app()->session['excel']=$this;
        return $data;
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
