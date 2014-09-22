<?php

/**
 * This is the model class for table "CTP".
 *
 * The followings are the available columns in table 'CTP':
 * @property integer $idCTP
 * @property string $fechaOrden
 * @property integer $tipoOrden
 * @property integer $formaPago
 * @property integer $idCliente
 * @property string $fechaPlazo
 * @property string $codigo
 * @property integer $serie
 * @property integer $numero
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
 * @property integer $idUserOT
 * @property integer $idUserVenta
 * @property integer $idImprenta
 * @property integer $idCTPParent
 * @property integer $tipoCTP
 * @property string $fechaEntega
 * @property string $obsCaja
 *
 * The followings are the available model relations:
 * @property CTP $idCTPParent0
 * @property CTP[] $cTPs
 * @property User $idUserOT0
 * @property User $idUserVenta0
 * @property CajaMovimientoVenta $idCajaMovimientoVenta0
 * @property Cliente $idCliente0
 * @property DetalleCTP[] $detalleCTPs
 * @property FallasCTP[] $fallasCTPs
 */
class CTP extends CActiveRecord
{
	public $max;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CTP';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('montoVenta, montoPagado, montoCambio, montoDescuento, estado', 'required'),
			array('tipoOrden, formaPago, idCliente, serie, numero, estado, idCajaMovimientoVenta, idUserOT, idUserVenta, idImprenta, idCTPParent, tipoCTP', 'numerical', 'integerOnly'=>true),
			array('montoVenta, montoPagado, montoCambio, montoDescuento', 'numerical'),
			array('codigo', 'length', 'max'=>45),
			array('factura, autorizado, responsable', 'length', 'max'=>50),
			array('obs', 'length', 'max'=>200),
			array('obsCaja', 'length', 'max'=>500),
			array('fechaOrden, fechaPlazo, fechaEntega', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCTP, fechaOrden, tipoOrden, formaPago, idCliente, fechaPlazo, codigo, serie, numero, montoVenta, montoPagado, montoCambio, montoDescuento, estado, factura, autorizado, responsable, obs, idCajaMovimientoVenta, idUserOT, idUserVenta, idImprenta, idCTPParent, tipoCTP, fechaEntega, obsCaja', 'safe', 'on'=>'search'),
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
			'idCTPParent0' => array(self::BELONGS_TO, 'CTP', 'idCTPParent'),
			'cTPs' => array(self::HAS_MANY, 'CTP', 'idCTPParent'),
			'idUserOT0' => array(self::BELONGS_TO, 'Users', 'idUserOT'),
			'idUserVenta0' => array(self::BELONGS_TO, 'Users', 'idUserVenta'),
			'idCajaMovimientoVenta0' => array(self::BELONGS_TO, 'CajaMovimientoVenta', 'idCajaMovimientoVenta'),
			'idCliente0' => array(self::BELONGS_TO, 'Cliente', 'idCliente'),
			'detalleCTPs' => array(self::HAS_MANY, 'DetalleCTP', 'idCTP'),
			'fallasCTPs' => array(self::HAS_MANY, 'FallasCTP', 'idCtpRep'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCTP' => 'Id Ctp',
			'fechaOrden' => 'Fecha Orden',
			'tipoOrden' => 'Tipo Orden',
			'formaPago' => 'Forma Pago',
			'idCliente' => 'Id Cliente',
			'fechaPlazo' => 'Fecha Plazo',
			'codigo' => 'Codigo',
			'serie' => 'Serie',
			'numero' => 'Numero',
			'montoVenta' => 'Total',
			'montoPagado' => 'Cancelado',
			'montoCambio' => 'Saldo',
			'montoDescuento' => 'Monto Descuento',
			'estado' => 'Estado',
			'factura' => 'Factura',
			'autorizado' => 'Autorizado',
			'responsable' => 'Responsable',
			'obs' => 'Obs',
			'idCajaMovimientoVenta' => 'Id Caja Movimiento Venta',
			'idUserOT' => 'Id User Ot',
			'idUserVenta' => 'Id User Venta',
			'idImprenta' => 'Id Imprenta',
			'idCTPParent' => 'Id Ctpparent',
			'tipoCTP' => 'Tipo Ctp',
			'fechaEntega' => 'Fecha Entega',
			'obsCaja' => 'Obs Caja',
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

		$criteria->compare('idCTP',$this->idCTP);
		$criteria->compare('fechaOrden',$this->fechaOrden,true);
		$criteria->compare('tipoOrden',$this->tipoOrden);
		$criteria->compare('formaPago',$this->formaPago);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('fechaPlazo',$this->fechaPlazo,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('serie',$this->serie);
		$criteria->compare('numero',$this->numero);
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
		$criteria->compare('idUserOT',$this->idUserOT);
		$criteria->compare('idUserVenta',$this->idUserVenta);
		$criteria->compare('idImprenta',$this->idImprenta);
		$criteria->compare('idCTPParent',$this->idCTPParent);
		$criteria->compare('tipoCTP',$this->tipoCTP);
		$criteria->compare('fechaEntega',$this->fechaEntega,true);
		$criteria->compare('obsCaja',$this->obsCaja,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public $apellido;
	public $nit; 
	public function searchCTP()
	{
		$criteria=new CDbCriteria;
	
		$criteria->with= array(
				'idCliente0',
		);
		$criteria->order='fechaOrden DESC';
		//$criteria->condition = 'idAlmacen=2';
	
		$criteria->compare('idCTP',$this->idCTP);
		$criteria->compare('fechaOrden',$this->fechaOrden,true);
		$criteria->compare('idCliente',$this->idCliente);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('montoVenta',$this->montoVenta);
		$criteria->compare('montoPagado',$this->montoPagado);
		$criteria->compare('montoCambio',$this->montoCambio);
		$criteria->compare('montoDescuento',$this->montoDescuento);
		$criteria->compare('tipoOrden',$this->tipoOrden);
		$criteria->compare('idCliente0.apellido',$this->apellido,true);
		$criteria->compare('idCliente0.nitCi',$this->nit);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CTP the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
