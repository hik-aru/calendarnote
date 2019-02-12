<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 *
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchedulesController extends AppController
{
    public $autoRender= true;

    public function initialize()
    {
        parent::initialize();
        
        $this->viewBuilder()->enableAutoLayout(true);
        $this->loadComponent('Calendar');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($scope='week', $year=false, $month=false, $day=false)
    {
        if(!$year) $year = date('Y');
		if(!$month) $month = date('m');
        if(!$day) $day = date('d');
        $current = sprintf("%d/%02d/%02d", $year, $month, $day);
        $this->getRequest()->getSession()->write('SCHEDULE_INDEX_CONDITION', compact('scope', 'current'));
        
        $times = $this->Calendar->scopeToTimes($scope, $year, $month, $day);
        $schedules = $this->findByTimes($times);
        $this->set(compact('schedules', 'scope', 'times', 'current'));
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => []
        ]);

        $this->set('schedule', $schedule);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schedule = $this->Schedules->newEntity();
        if ($this->request->is('post')) {
            $schedule = $this->Schedules->newEntity($this->request->getData());

            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $this->set(compact('schedule'));
    }

    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, ['contain' => []]);
        if($this->request->is(['patch', 'post', 'put'])){
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            //Debugger::dump($schedule,10);

            if($this->Schedules->save($schedule)){
                $this->Flash->success(__('The schedule has been updated.'));
                return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('The shcedule could not be update. Please, try again.'));
            }
        }
        $this->set(compact('schedule'));
        $this->set('_serialize', ['schedule']);
    }

    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $res = $this->request->getData();
        Debugger::dump($res);
        
        $schedule = $this->Schedules->get($id);
        if($this->Schedules->delete($schedule)){
            $this->Flash->success(__('The {0} article has been deleted.', $schedule->title));
            return $this->redirect(['action' => 'index']);
        }else{
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }
    }

    public function findByTimes($times)
    {
        extract($times);
        $from = date("Y-n-j H:i:s", $from_time);
        $to = date("Y-n-j H:i:s", $to_time);

        $record = $this->Schedules->find()
                    ->where(['OR' => [ ['StartDate BETWEEN :from AND :to'], ['EndDate BETWEEN :from AND :to']] ])
                    ->bind(':from', $from)
                    ->bind(':to', $to)
                    ->order(['StartDate'=>'ASC']);

        return $record;
    }

    public function redirect($url, $status = null, $exit = true) {
		if(is_array($url) && $url['action'] == 'index') {
			$prev = $this->getRequest()->getSession()->read('SCHEDULE_INDEX_CONDITION');
			if(!empty($prev)) {
				extract($prev);
				$url['action'] .= "/$scope";
                $url[] = $current;
			}
		}
		return parent::redirect($url, $status, $exit);
    }

}
