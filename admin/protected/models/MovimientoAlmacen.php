<?php

/**
 * This is the model class for table "movimientoAlmacen".
 *
 * The followings are the available columns in table 'movimientoAlmacen':
 * @property integer $idMovimientoAlmacen
 * @property integer $idProducto
 * @property integer $idAlmacenOrigen
 * @property integer $idAlmacenDestino
 * @property integer $cantidadU
 * @property integer $cantidadP
 * @property integer $idUser
 * @property string $fechaMovimiento
 * @property string $obs
 *
 * The followings are the available model relations:
 * @property Almacen $idAlmacenOrigen0
 * @property Almacen $idAlmacenDestino0
 * @property Producto $idProducto0
 * @property User $idUser0
 */
class MovimientoAlmacen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'movimientoAlmacen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idProducto, idAlmacenOrigen, idAlmacenDestino, cantidadU, cantidadP, idUser', 'numerical', 'integerOnly'=>true),
			array('obs', 'length', 'max'=>100),
			array('fechaMovimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMovimientoAlmacen, idProducto, idAlmacenOrigen, idAlmacenDestino, cantidadU, cantidadP, idUser, fechaMovimiento, obs', 'safe', 'on'=>'search'),
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
			'idAlmacenOrigen0' => array(self::BELONGS_TO, 'Almacen', 'idAlmacenOrigen'),
			'idAlmacenDestino0' => array(self::BELONGS_TO, 'Almacen', 'idAlmacenDestino'),
			'idProducto0' => array(self::BELONGS_TO, 'Producto', 'idProducto'),
			'idUser0' => array(self::BELONGS_TO, 'User', 'idUser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMovimientoAlmacen' => 'Id Movimiento Almacen',
			'idProducto' => 'Id Producto',
			'idAlmacenOrigen' => 'Id Almacen Origen',
			'idAlmacenDestino' => 'Id Almacen Destino',
			'cantidadU' => 'Cantidad U',
			'cantidadP' => 'Cantidad P',
			'idUser' => 'Id User',
			'fechaMovimiento' => 'Fecha Movimiento',
			'obs' => 'Obs',
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

		$criteria->compare('idMovimientoAlmacen',$this->idMovimientoAlmacen);
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('idAlmacenOrigen',$this->idAlmacenOrigen);
		$criteria->compare('idAlmacenDestino',$this->idAlmacenDestino);
		$criteria->compare('cantidadU',$this->cantidadU);
		$criteria->compare('cantidadP',$this->cantidadP);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);
		$criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public $codigo;
	public $material;
	public $color;
	public $detalle;
	public $origen;
	public $destino;
	public function searchReporte()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
	
		$criteria=new CDbCriteria;
		$criteria->with=array('idAlmacenOrigen0','idAlmacenDestino0','idProducto0');
		$criteria->order='fechaMovimiento DESC';
	
		$criteria->compare('idMovimientoAlmacen',$this->idMovimientoAlmacen);
		$criteria->compare('idProducto',$this->idProducto);
		$criteria->compare('idAlmacenOrigen',$this->idAlmacenOrigen);
		$criteria->compare('idAlmacenDestino',$this->idAlmacenDestino);
		$criteria->compare('cantidadU',$this->cantidadU);
		$criteria->compare('cantidadP',$this->cantidadP);
		$criteria->compare('idUser',$this->idUser);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);
	
		$criteria->compare('idProducto0.codigo',$this->codigo,true);
		$criteria->compare('idProducto0.material',$this->material,true);
		$criteria->compare('idProducto0.color',$this->color,true);
		$criteria->compare('idProducto0.detalle',$this->detalle,true);
	
		$criteria->compare('idAlmacenOrigen0.nombre',$this->origen,true);
		$criteria->compare('idAlmacenDestino0.nombre',$this->destino,true);
	
		$data = new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>'20',
				),
		));
		//$dataExp = $data->getArrayCopy();
		//$data->Pagination = false;
		Yii::app()->session['excel']= $this;
	
		return $data;
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MovimientoAlmacen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
