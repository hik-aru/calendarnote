<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;


/**
 * Schedules Model
 *
 * @method \App\Model\Entity\Schedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\Schedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Schedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Schedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Schedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Schedule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SchedulesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('schedules');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->dateTime('StartDate')
            ->requirePresence('StartDate', 'create')
            ->allowEmptyDateTime('StartDate', false)
            ->add('StartDate', 'custom',
            [
                'rule' => [$this, 'dateFormat'],
                'message' => 'Please input in the date format.',
            ])
            ->add('EndDate', 'custom',
            [
                'rule' => [$this, 'compareFromTo'],
                'message' => 'Start time should specify the past from finish time.',
            ]);
            /*->add('StartDate', 'custom',
            [
                'rule' => [$this, 'isDuplicate'],
                'message' => 'There are already other schedules.',
            ]);*/

        $validator
            ->dateTime('EndDate')
            ->requirePresence('EndDate', 'create')
            ->allowEmptyDateTime('EndDate', false)
            ->add('EndDate', 'custom',
            [
                'rule' => [$this, 'dateFormat'],
                'message' => 'Please input in the date format.',
            ]);

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->allowEmptyString('title', false);

        $validator
            ->scalar('contents')
            ->requirePresence('contents', 'create')
            ->allowEmptyString('contents', false);

        return $validator;
    }

    function dateFormat($value){
        Debugger::dump($value, 10); 
        $value = array_shift($value);
        $db = ConnectionManager::get($this->useDbConfig);
        $format = $db->columns['datetime']['format'];
        $dt = date($format, strtotime($value));
        return $dt === $value;
    }

    function compareFromTo($value){
        //$db = ConnectionManager::get($this->useDbConfig);
        //$format = $db->columns['datetime']['format'];
        //Debugger::dump($value, 10);
        $from = strtotime($this->request->getData('Schedule.StartDate'));
        $to = strtotime($this->request->getData('Schedule.EndDate'));
        return $from <= $to;
    }

    /*function isDuplicate($value){
        $from = $this->request->getData('Schedule.StartDate');
        $to = $this->request->getData('Schedule.EndDate');
        $conditions = array('or' => array(
            array("StartDate BETWEEN ? AND ?" => array($from, $to)),
            array("EndDate BETWEEN ? AND ?" => array($from, $to))
        ));
        if($this->id){
            $conditions[$this->alias . '.' . $this->primaryKey] = '!= '.$this->id;
        }
        $count = $this->find('count', compact('condtions'));
        return $count === 0;
    }*/
}
