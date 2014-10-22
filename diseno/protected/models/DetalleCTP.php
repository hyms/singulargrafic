<?php

/**
 * This is the model class for table "detalleCTP".
 *
 * The followings are the available columns in table 'detalleCTP':
 * @property integer $idDetalleCTP
 * @property integer $idCTP
 * @property integer $idAlmacenProducto
 * @property integer $nroPlacas
 * @property string $formato
 * @property string $trabajo
 * @property integer $pinza
 * @property double $resolucion
 * @property double $costo
 * @property double $costoAdicional
 * @property double $costoTotal
 * @property integer $estado
 * @property integer $C
 * @property integer $M
 * @property integer $Y
 * @property integer $K
 *
 * The followings are the available model relations:
 * @property AlmacenProducto $idAlmacenProducto0
 * @property CTP $idCTP0
 */
class DetalleCTP extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'detalleCTP';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nroPlacas, trabajo, pinza, resolucion', 'required'),
            array('idCTP, idAlmacenProducto, nroPlacas, estado, C, M, Y, K', 'numerical', 'integerOnly'=>true),
            array('resolucion, costo, costoAdicional, costoTotal', 'numerical'),
            array('formato', 'length', 'max'=>50),
            array('trabajo', 'length', 'max'=>100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idDetalleCTP, idCTP, idAlmacenProducto, nroPlacas, formato, trabajo, pinza, resolucion, costo, costoAdicional, costoTotal, estado, C, M, Y, K', 'safe', 'on'=>'search'),
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
            'idCTP0' => array(self::BELONGS_TO, 'CTP', 'idCTP'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'idDetalleCTP' => 'Id Detalle Ctp',
            'idCTP' => 'Id Ctp',
            'idAlmacenProducto' => 'Id Almacen Producto',
            'nroPlacas' => 'Nro Placas',
            'formato' => 'Formato',
            'trabajo' => 'Trabajo',
            'pinza' => 'Pinza',
            'resolucion' => 'Resolucion',
            'costo' => 'Costo',
            'costoAdicional' => 'Costo Adicional',
            'costoTotal' => 'Costo Total',
            'estado' => 'Estado',
            'C' => 'C',
            'M' => 'M',
            'Y' => 'Y',
            'K' => 'K',
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

        $criteria->compare('idDetalleCTP',$this->idDetalleCTP);
        $criteria->compare('idCTP',$this->idCTP);
        $criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
        $criteria->compare('nroPlacas',$this->nroPlacas);
        $criteria->compare('formato',$this->formato,true);
        $criteria->compare('trabajo',$this->trabajo,true);
        $criteria->compare('pinza',$this->pinza);
        $criteria->compare('resolucion',$this->resolucion);
        $criteria->compare('costo',$this->costo);
        $criteria->compare('costoAdicional',$this->costoAdicional);
        $criteria->compare('costoTotal',$this->costoTotal);
        $criteria->compare('estado',$this->estado);
        $criteria->compare('C',$this->C);
        $criteria->compare('M',$this->M);
        $criteria->compare('Y',$this->Y);
        $criteria->compare('K',$this->K);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public $codigo;
    public $cliente;
    public $fecha;
    public $estado;
    public $sucursal;

    public function searchPlacas()
    {
        $criteria=new CDbCriteria;

        $criteria->with = array('idCTP0','idCTP0.idCliente0');
        //$criteria->condition = "";
        $criteria->order = "idCTP0.fechaOrden Desc";

        $criteria->compare('idDetalleCTP',$this->idDetalleCTP);
        $criteria->compare('idCTP',$this->idCTP);
        $criteria->compare('idAlmacenProducto',$this->idAlmacenProducto);
        $criteria->compare('nroPlacas',$this->nroPlacas);
        $criteria->compare('formato',$this->formato,true);
        $criteria->compare('trabajo',$this->trabajo,true);
        $criteria->compare('pinza',$this->pinza);
        $criteria->compare('resolucion',$this->resolucion);
        $criteria->compare('costo',$this->costo);
        $criteria->compare('costoAdicional',$this->costoAdicional);
        $criteria->compare('costoTotal',$this->costoTotal);
        $criteria->compare('estado',$this->estado);
        $criteria->compare('C',$this->C);
        $criteria->compare('M',$this->M);
        $criteria->compare('Y',$this->Y);
        $criteria->compare('K',$this->K);

        $criteria->compare('idCTP0.codigo',$this->codigo);
        $criteria->compare('idCTP0.idSucursal',$this->sucursal );
        $criteria->compare('idCTP0.fechaOrden',$this->fecha);
        $criteria->compare('idCTP0.estado',$this->estado);
        $criteria->compare('idCliente0.apellido',$this->cliente);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DetalleCTP the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
