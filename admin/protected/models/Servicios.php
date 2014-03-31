<?php

/**
 * This is the model class for table "servicios".
 *
 * The followings are the available columns in table 'servicios':
 * @property integer $id
 * @property string $nombre
 * @property string $detalle
 * @property string $fechaCreacion
 * @property integer $idParent
 * 
 */
class Servicios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'servicios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, fechaCreacion', 'required','message'=>'El campo <b>{attribute}</b> es obligatorio',),
			array('nombre', 'length', 'max'=>100,'message'=>'<b>{attribute}</b> solo puede contener 100 caracteres',),
			array('detalle', 'length', 'max'=>500,'message'=>'<b>{attribute}</b> solo puede contener 500 caracteres',),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nombre, fechaCreacion', 'safe', 'on'=>'search'),
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
        	//'empresaServicio' => array(self::HAS_MANY, 'EmpresaServicio', 'idServicio'),
			'empresaServicio'=>array(self::MANY_MANY, 'Empresa', 'empresaServicio(idServicio, idEmpresa)'),
    	);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'detalle' => 'Detalle',
			'fechaCreacion' => 'Fecha Creacion',
			'idParent' => 'Servicio',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fechaCreacion',$this->fechaCreacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Servicios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
