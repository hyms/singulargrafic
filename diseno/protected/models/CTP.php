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
 * @property integer $idSucursal
 * @property string $fechaGenerada
 *
 * The followings are the available model relations:
 * @property CTP $idCTPParent0
 * @property CTP[] $cTPs
 * @property Sucursal $idSucursal0
 * @property User $idUserOT0
 * @property User $idUserVenta0
 * @property CajaMovimientoVenta $idCajaMovimientoVenta0
 * @property Cliente $idCliente0
 * @property DetalleCTP[] $detalleCTPs
 * @property FallasCTP[] $fallasCTPs
 */
class CTP extends CActiveRecord
{
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
			array('tipoOrden, formaPago, idCliente, serie, numero, estado, idCajaMovimientoVenta, idUserOT, idUserVenta, idImprenta, idCTPParent, tipoCTP, idSucursal', 'numerical', 'integerOnly'=>true),
			array('montoVenta, montoPagado, montoCambio, montoDescuento', 'numerical'),
			array('codigo', 'length', 'max'=>45),
			array('factura, autorizado, responsable', 'length', 'max'=>50),
			array('obs', 'length', 'max'=>200),
			array('obsCaja', 'length', 'max'=>500),
			array('fechaOrden, fechaPlazo, fechaEntega, fechaGenerada', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCTP, fechaOrden, tipoOrden, formaPago, idCliente, fechaPlazo, codigo, serie, numero, montoVenta, montoPagado, montoCambio, montoDescuento, estado, factura, autorizado, responsable, obs, idCajaMovimientoVenta, idUserOT, idUserVenta, idImprenta, idCTPParent, tipoCTP, fechaEntega, obsCaja, idSucursal, fechaGenerada', 'safe', 'on'=>'search'),
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
			'idSucursal0' => array(self::BELONGS_TO, 'Sucursal', 'idSucursal'),
			'idUserOT0' => array(self::BELONGS_TO, 'User', 'idUserOT'),
			'idUserVenta0' => array(self::BELONGS_TO, 'User', 'idUserVenta'),
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
			'idUserOT' => 'Id User Ot',
			'idUserVenta' => 'Id User Venta',
			'idImprenta' => 'Id Imprenta',
			'idCTPParent' => 'Id Ctpparent',
			'tipoCTP' => 'Tipo Ctp',
			'fechaEntega' => 'Fecha de Entega',
			'obsCaja' => 'Obs Caja',
			'idSucursal' => 'Id Sucursal',
			'fechaGenerada' => 'Fecha Generada',
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

    public $max;
    public $apellido;
    public $nitCi;
    public $codigoP;
    public function search($cond=null)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->with = array('idCliente0','idCTPParent0');
        $criteria->order='`t`.fechaOrden Desc';
        if($cond!=null)
        {
            $criteria->condition = $cond;
        }

        $criteria->compare('`t`.idCTP',$this->idCTP);
        $criteria->compare('`t`.fechaOrden',$this->fechaOrden,true);
        $criteria->compare('`t`.tipoOrden',$this->tipoOrden);
        $criteria->compare('`t`.formaPago',$this->formaPago);
        $criteria->compare('`t`.idCliente',$this->idCliente);
        $criteria->compare('`t`.fechaPlazo',$this->fechaPlazo,true);
        $criteria->compare('`t`.codigo',$this->codigo,true);
        $criteria->compare('`t`.serie',$this->serie);
        $criteria->compare('`t`.numero',$this->numero);
        $criteria->compare('`t`.montoVenta',$this->montoVenta);
        $criteria->compare('`t`.montoPagado',$this->montoPagado);
        $criteria->compare('`t`.montoCambio',$this->montoCambio);
        $criteria->compare('`t`.montoDescuento',$this->montoDescuento);
        $criteria->compare('`t`.estado',$this->estado);
        $criteria->compare('`t`.factura',$this->factura,true);
        $criteria->compare('`t`.autorizado',$this->autorizado,true);
        $criteria->compare('`t`.responsable',$this->responsable,true);
        $criteria->compare('`t`.obs',$this->obs,true);
        $criteria->compare('`t`.idCajaMovimientoVenta',$this->idCajaMovimientoVenta);
        $criteria->compare('`t`.idUserOT',$this->idUserOT);
        $criteria->compare('`t`.idUserVenta',$this->idUserVenta);
        $criteria->compare('`t`.idImprenta',$this->idImprenta);
        $criteria->compare('`t`.idCTPParent',$this->idCTPParent);
        $criteria->compare('`t`.tipoCTP',$this->tipoCTP);
        $criteria->compare('`t`.fechaEntega',$this->fechaEntega,true);
        $criteria->compare('`t`.obsCaja',$this->obsCaja,true);
        $criteria->compare('`t`.idSucursal',$this->idSucursal);
        $criteria->compare('fechaGenerada',$this->fechaGenerada,true);

        $criteria->compare('idCliente0.apellido',$this->apellido,true);
        $criteria->compare('idCliente0.nitCi',$this->nitCi);

        $criteria->compare('idCTPParent0.codigo',$this->codigoP,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function searchReport()
    {
        $criteria=new CDbCriteria;

        $criteria->with = array('idCliente0','idCTPParent0','idUserOT0','idUserOT0.idEmpleado0');
        $criteria->order='`t`.fechaOrden Desc';

        //$criteria->condition = "";

        $criteria->compare('`t`.idCTP',$this->idCTP);
        $criteria->compare('`t`.fechaOrden',$this->fechaOrden,true);
        $criteria->compare('`t`.tipoOrden',$this->tipoOrden);
        $criteria->compare('`t`.formaPago',$this->formaPago);
        $criteria->compare('`t`.idCliente',$this->idCliente);
        $criteria->compare('`t`.fechaPlazo',$this->fechaPlazo,true);
        $criteria->compare('`t`.codigo',$this->codigo,true);
        $criteria->compare('`t`.serie',$this->serie);
        $criteria->compare('`t`.numero',$this->numero);
        $criteria->compare('`t`.montoVenta',$this->montoVenta);
        $criteria->compare('`t`.montoPagado',$this->montoPagado);
        $criteria->compare('`t`.montoCambio',$this->montoCambio);
        $criteria->compare('`t`.montoDescuento',$this->montoDescuento);
        $criteria->compare('`t`.estado',$this->estado);
        $criteria->compare('`t`.factura',$this->factura,true);
        $criteria->compare('`t`.autorizado',$this->autorizado,true);
        $criteria->compare('`t`.responsable',$this->responsable,true);
        $criteria->compare('`t`.obs',$this->obs,true);
        $criteria->compare('`t`.idCajaMovimientoVenta',$this->idCajaMovimientoVenta);
        $criteria->compare('`t`.idUserOT',$this->idUserOT);
        $criteria->compare('`t`.idUserVenta',$this->idUserVenta);
        $criteria->compare('`t`.idImprenta',$this->idImprenta);
        $criteria->compare('`t`.idCTPParent',$this->idCTPParent);
        $criteria->compare('`t`.tipoCTP',$this->tipoCTP);
        $criteria->compare('`t`.fechaEntega',$this->fechaEntega,true);
        $criteria->compare('`t`.obsCaja',$this->obsCaja,true);
        $criteria->compare('`t`.idSucursal',$this->idSucursal);
        $criteria->compare('fechaGenerada',$this->fechaGenerada,true);

        $criteria->compare('idCliente0.apellido',$this->apellido,true);
        $criteria->compare('idCliente0.nitCi',$this->nitCi);

        $criteria->compare('idCTPParent0.codigo',$this->codigoP,true);

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
