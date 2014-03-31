<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $id
 * @property string $nitCi
 * @property string $apellido
 * @property string $nombre
 * @property string $correo
 * @property string $telefono
 * @property string $fechaRegistro
 */
class Cliente extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nitCi, apellido, nombre, correo, telefono, fechaRegistro', 'required','message'=>'El campo <b>{attribute}</b> es obligatorio',),
			array('nitCi, telefono', 'numerical', 'integerOnly'=>true, 'message'=>'El campo <b>{attribute}</b> solo puede ser numerico'),
			array('nitCi, telefono', 'length', 'max'=>15,'message'=>'<b>{attribute}</b> solo puede contener 15 caracteres'),
			array('apellido, nombre', 'length', 'max'=>30,'message'=>'<b>{attribute}</b> solo puede contener 30 caracteres'),
			array('correo', 'length', 'max'=>100,'message'=>'<b>{attribute}</b> solo puede contener 100 caracteres'),
			array('correo','email','message'=>'La direccion de <b>{attribute}</b> no es valido'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nitCi, apellido, nombre, correo, telefono, fechaRegistro', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nitCi' => 'Nit Ci',
			'apellido' => 'Apellido',
			'nombre' => 'Nombre',
			'correo' => 'Correo',
			'telefono' => 'Telefono',
			'fechaRegistro' => 'Fecha Registro',
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
		$criteria->compare('nitCi',$this->nitCi,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fechaRegistro',$this->fechaRegistro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cliente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
