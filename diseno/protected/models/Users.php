<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $idUser
 * @property string $username
 * @property string $password
 * @property string $fechaLogin
 * @property integer $estado
 * @property string $tipo
 * @property integer $idEmpleado
 *
 * The followings are the available model relations:
 * @property CTP[] $cTPs
 * @property CTP[] $cTPs1
 * @property Imprenta[] $imprentas
 * @property Imprenta[] $imprentas1
 * @property CajaArqueo[] $cajaArqueos
 * @property CajaChica[] $cajaChicas
 * @property CajaMovimientoVenta[] $cajaMovimientoVentas
 * @property MovimientoAlmacen[] $movimientoAlmacens
 * @property Empleado $idEmpleado0
 */
class Users extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('estado, idEmpleado', 'numerical', 'integerOnly'=>true),
            array('username', 'length', 'max'=>20),
            array('password', 'length', 'max'=>150),
            array('tipo', 'length', 'max'=>10),
            array('fechaLogin', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idUser, username, password, fechaLogin, estado, tipo, idEmpleado', 'safe', 'on'=>'search'),
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
            'cTPs' => array(self::HAS_MANY, 'CTP', 'idUserOT'),
            'cTPs1' => array(self::HAS_MANY, 'CTP', 'idUserVenta'),
            'imprentas' => array(self::HAS_MANY, 'Imprenta', 'idUserOT'),
            'imprentas1' => array(self::HAS_MANY, 'Imprenta', 'idUserVenta'),
            'cajaArqueos' => array(self::HAS_MANY, 'CajaArqueo', 'idUser'),
            'cajaChicas' => array(self::HAS_MANY, 'CajaChica', 'idUser'),
            'cajaMovimientoVentas' => array(self::HAS_MANY, 'CajaMovimientoVenta', 'idUser'),
            'movimientoAlmacens' => array(self::HAS_MANY, 'MovimientoAlmacen', 'idUser'),
            'idEmpleado0' => array(self::BELONGS_TO, 'Empleado', 'idEmpleado'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'idUser' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'fechaLogin' => 'Fecha Login',
            'estado' => 'Estado',
            'tipo' => 'Tipo',
            'idEmpleado' => 'Id Empleado',
        );
    }


    public function getTipos()
    {
        return array('admin'=>'admin','ventas'=>'ventas');
    }

    public function validatePassword($password){
        return $this->hashPassword($password)===$this->password;
    }

    public function hashPassword($password){
        return md5($password);
    }

    public function tipos()
    {
        return array(
            '1' => 'Admin',
            '2' => 'Administracion',
            '3' => 'Ventas',
            '4' => 'Diseño',
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

        $criteria->compare('idUser',$this->idUser);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('fechaLogin',$this->fechaLogin,true);
        $criteria->compare('estado',$this->estado);
        $criteria->compare('tipo',$this->tipo,true);
        $criteria->compare('idEmpleado',$this->idEmpleado);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
