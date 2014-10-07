<?php

/**
 * This is the model class for table "detalleVenta".
 *
 * The followings are the available columns in table 'detalleVenta':
 * @property integer $idDetalleVenta
 * @property integer $idVenta
 * @property integer $cantidadU
 * @property double $costoU
 * @property integer $cantidadP
 * @property double $costoP
 * @property double $costoAdicional
 * @property double $costoTotal
 * @property integer $idAlmacenProducto
 *
 * The followings are the available model relations:
 * @property AlmacenProducto $idAlmacenProducto0
 * @property Venta $idVenta0
 */
class DetalleVenta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	public function tableName()
	{
		return 'detalleVenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('cantidadU, costoU, cantidadP, costoP', 'required'),
			array('idVenta, cantidadU, cantidadP, idAlmacenProducto', 'numerical', 'integerOnly'=>true),
			array('costoU, costoP, costoAdicional, costoTotal', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idDetalleVenta, idVenta, cantidadU, costoU, cantidadP, costoP, costoAdicional, costoTotal, idAlmacenProducto', 'safe', 'on'=>'search'),
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
			'idAlmacenProducto0' => array(self::BELONGS_TO, 'AlmacenProducto', 'idAlmacenProducto'),
			'idVenta0' => array(self::BELONGS_TO, 'Venta', 'idVenta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idDetalleVenta' => 'Id Detalle Venta',
			'idVenta' => 'Id Venta',
			'cantidadU' => 'Cantidad U',
			'costoU' => 'Costo U',
			'cantidadP' => 'Cantidad P',
			'costoP' => 'Costo P',
			'costoAdicional' => 'Costo Adicional',
			'costoTotal' => 'Costo Total',
			'idAlmacenProducto' => 'Id Almacen Producto',
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

		$criteria->compare('idDetalleVenta',$this->idDetalleVenta);
		$criteria->compare('idVenta',$this->idVenta);
		$criteria->compare('cantidadU',$this->cantidadU);
		$criteria->compare('costoU',$this->costoU);
		$criteria->compare('cantidadP',$this->cantidadP);
		$criteria->compare('costoP',$this->costoP);
		$criteria->compare('costoAdicional',$this->costoAdicional);
		$criteria->compare('costoTotal',$this->costoTotal);
		$criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public $cantidad;
    public $apellido;
    public $codigo;
    public $fecha;
    public $material;
    public $detalle;
    public $codigoProducto;
    public $color;
    public function searchVenta()
    {
        $criteria=new CDbCriteria;

        $criteria->order='fechaVenta DESC';

        $criteria->with= array(
            'idVenta0',
            'idVenta0.idCliente0',
            'idAlmacenProducto0',
            'idAlmacenProducto0.idProducto0',
        );

        $criteria->compare('idVenta0.codigo',$this->codigo);
        $criteria->compare('idVenta0.fechaVenta',$this->fecha,true);
        $criteria->compare('idCliente0.apellido',$this->apellido,true);
        $criteria->compare('idProducto0.codigo',$this->codigoProducto,true);
        $criteria->compare('idProducto0.color',$this->color);
        $criteria->compare('idProducto0.material',$this->material);
        $criteria->compare('idProducto0.detalle',$this->detalle,true);

        $data = new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>'10',
            ),
        ));
        Yii::app()->session['excel'] = $this;
        return $data;
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetalleVenta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
