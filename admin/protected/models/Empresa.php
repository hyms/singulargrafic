<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $id
 * @property string $nombre
 * @property string $ciudad
 * @property string $calle
 * @property string $maps
 * @property string $fax
 * @property string $correo
 * @property string $telefono
 * @property string $horarios
 * @property string $skype
 * @property string $facebook
 * @property integer $patern
 */
class Empresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, calle, correo, telefono, horarios', 'required'),
			array('patern', 'numerical', 'integerOnly'=>true),
			array('nombre, calle, correo, skype, facebook', 'length', 'max'=>500),
			array('ciudad', 'length', 'max'=>100),
			array('maps', 'length', 'max'=>1000),
			array('fax, telefono', 'length', 'max'=>20),
			array('horarios', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, ciudad, calle, maps, fax, correo, telefono, horarios, skype, facebook, patern', 'safe', 'on'=>'search'),
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
			'ciudad' => 'Ciudad',
			'calle' => 'Calle',
			'maps' => 'Maps',
			'fax' => 'Fax',
			'correo' => 'Correo',
			'telefono' => 'Telefono',
			'horarios' => 'Horarios',
			'skype' => 'Skype',
			'facebook' => 'Facebook',
			'patern' => 'Central',
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
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('calle',$this->calle,true);
		$criteria->compare('maps',$this->maps,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('horarios',$this->horarios,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('patern',$this->patern);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getCiudades(){
		return array(
				'La Paz' => 'La Paz', 
				'Cochabamba' => 'Cochabamba',
				'Santa Cruz' => 'Santa Cruz',
				'Oruro' => 'Oruro',
				'Potosi' => 'Potosi',
				'Chuquisaca' => 'Chuquisaca',
				'Tarija' => 'Tarija',
				'Beni' => 'Beni',
				'Pando' => 'Pando',
		);
	}
	
	public function getSuperiores(){
		if($this->id==null)
			return CHtml::listData( $this::model()->findAll(array('select'=>'id, nombre','group'=>'nombre')),'id','nombre' );
		return CHtml::listData( $this::model()->findAll('id!='.$this->id, array('select'=>'id, nombre','group'=>'nombre')),'id','nombre' );
	}
	
	public function getServicios(){
		return CHtml::listData( Servicios::model()->findAll(array('select'=>'id, nombre')),'id','nombre' );
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
