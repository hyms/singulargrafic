<?php

/**
 * This is the model class for table "MatrizPreciosCTP".
 *
 * The followings are the available columns in table 'MatrizPreciosCTP':
 * @property integer $idMatrizPreciosCTP
 * @property integer $idTiposClientes
 * @property integer $idHorario
 * @property integer $idCantidad
 * @property integer $idAlmacenProducto
 * @property double $precioSF
 * @property double $precioCF
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property AlmacenProducto $idAlmacenProducto0
 * @property CantidadCTP $idCantidad0
 * @property Horario $idHorario0
 * @property TiposClientes $idTiposClientes0
 */
class MatrizPreciosCTP extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'MatrizPreciosCTP';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('precioSF, precioCF', 'required'),
			array('idTiposClientes, idHorario, idCantidad, idAlmacenProducto', 'numerical', 'integerOnly'=>true),
			array('precioSF, precioCF', 'numerical'),
			array('nombre', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMatrizPreciosCTP, idTiposClientes, idHorario, idCantidad, idAlmacenProducto, precioSF, precioCF, nombre', 'safe', 'on'=>'search'),
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
			'idCantidad0' => array(self::BELONGS_TO, 'CantidadCTP', 'idCantidad'),
			'idHorario0' => array(self::BELONGS_TO, 'Horario', 'idHorario'),
			'idTiposClientes0' => array(self::BELONGS_TO, 'TiposClientes', 'idTiposClientes'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMatrizPreciosCTP' => 'Id Matriz Precios Ctp',
			'idTiposClientes' => 'Id Tipos Clientes',
			'idHorario' => 'Id Horario',
			'idCantidad' => 'Id Cantidad',
			'idAlmacenProducto' => 'Id Almacen Producto',
			'precioSF' => 'Precio Sf',
			'precioCF' => 'Precio Cf',
			'nombre' => 'Nombre',
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

		$criteria->compare('idMatrizPreciosCTP',$this->idMatrizPreciosCTP);
		$criteria->compare('idTiposClientes',$this->idTiposClientes);
		$criteria->compare('idHorario',$this->idHorario);
		$criteria->compare('idCantidad',$this->idCantidad);
		$criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
		$criteria->compare('precioSF',$this->precioSF);
		$criteria->compare('precioCF',$this->precioCF);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MatrizPreciosCTP the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
