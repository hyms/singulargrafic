<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $id
 * @property string $codigo
 * @property integer $idMaterial
 * @property string $peso
 * @property integer $idColor
 * @property string $dimension
 * @property string $procedencia
 * @property double $costoSF
 * @property double $costoSFUnidad
 * @property double $costoCF
 * @property double $costoCFUnidad
 * @property integer $idIndustria
 * @property integer $cantidad
 * @property string $obs
 */
class Producto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, idMaterial, peso, idColor, dimension, procedencia, costoSF, costoSFUnidad, costoCF, costoCFUnidad, idIndustria, cantidad', 'required'),
			array('cantidad', 'numerical', 'integerOnly'=>true),
			array('costoSF, costoSFUnidad, costoCF, costoCFUnidad', 'numerical'),
			array('codigo', 'length', 'max'=>50),
			array('peso', 'length', 'max'=>10),
			array('dimension', 'length', 'max'=>20),
			array('obs', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, codigo, idMaterial, peso, idColor, dimension, procedencia, costoSF, costoSFUnidad, costoCF, costoCFUnidad, idIndustria, cantidad, obs, color', 'safe', 'on'=>'search'),
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
			'Color'=>array(self::BELONGS_TO, 'Color', 'idColor'),
			'Material'=>array(self::BELONGS_TO, 'Material', 'idMaterial'),
			'Industria'=>array(self::BELONGS_TO, 'Industria', 'idIndustria'),
				
			'Almacen'=>array(self::HAS_MANY, 'Almacen', 'idProducto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'idMaterial' => 'Material',
			'peso' => 'Peso',
			'idColor' => 'Color',
			'dimension' => 'Dimension',
			'procedencia' => 'Procedencia',
			'costoSF' => 'Costo Sin Factura',
			'costoSFUnidad' => 'Costo Sin Factura Unidad',
			'costoCF' => 'Costo Con Factura',
			'costoCFUnidad' => 'Costo Con Factura Unidad',
			'idIndustria' => 'Industria',
			'cantidad' => 'Cantidad',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('idMaterial',$this->idMaterial);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('idColor',$this->idColor);
		$criteria->compare('dimension',$this->dimension,true);
		$criteria->compare('procedencia',$this->procedencia);
		$criteria->compare('costoSF',$this->costoSF);
		$criteria->compare('costoSFUnidad',$this->costoSFUnidad);
		$criteria->compare('costoCF',$this->costoCF);
		$criteria->compare('costoCFUnidad',$this->costoCFUnidad);
		$criteria->compare('idIndustria',$this->idIndustria);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('obs',$this->obs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public $color;
	
	public function searchAll()
	{
		$criteria=new CDbCriteria;
		
		$criteria->with = 'Color';
		$criteria->with = 'Material';
		$criteria->with = 'Industria';
		//$criteria->with('Almacen');
		
		$criteria->compare('id',$this->id);
		$criteria->compare('codigo',$this->codigo,true);
		//$criteria->compare('Material.nombre',$this->Material->nombre);
		$criteria->compare('peso',$this->peso,true);
		$criteria->compare('Color.nombre', $this->color,true);
		$criteria->compare('dimension',$this->dimension,true);
		$criteria->compare('procedencia',$this->procedencia);
		//$criteria->compare('industria',$this->Industria->nombre);
		//$criteria->compare('industria',$this->Almacen->id);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
