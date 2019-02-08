<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Routing\Router;
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
          
            ->add('StartDate', 'custom',
            [
                'rule' => [$this, 'compareFromTo'],
                'message' => 'Start time should specify the past from finish time.',
            ])
            ->add('StartDate', 'custom',
            [
                'rule' => [$this, 'isDuplicate'],
                'message' => 'There are already other schedules.',
            ]);

        $validator
            ->dateTime('EndDate')
            ->requirePresence('EndDate', 'create')
            ->allowEmptyDateTime('EndDate', false);

        $validator
            ->notEmpty('title')
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create');

        $validator
            ->scalar('contents')
            ->requirePresence('contents', 'create')
            ->allowEmptyString('contents', false);

        return $validator;
    }

    function compareFromTo($value){
        $from = $this->getUnixTime($value);
        $to = $this->getUnixTime(Router::getRequest()->data('EndDate'));
        
        return $from <= $to;
    }

    function isDuplicate($value){
        $from = $this->getUnixTime($value);
        $to = $this->getUnixTime(Router::getRequest()->data('EndDate'));

        $count = $this->find()
                        ->where(['OR' => [ ['StartDate BETWEEN :from AND :to'], ['EndDate BETWEEN :from AND :to']] ])
                        ->bind(':from', $from)
                        ->bind(':to', $to)
                        ->count();

        return $count === 0;
    }

    function getUnixTime($date){
        $tmpDate = '';

        foreach($date as $d){
            $tmpDate .= $d;
        }

        return date("Y-n-j H:i:s", strtotime($tmpDate));
    }
}
