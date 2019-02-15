<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Error\Debugger;

/**
 * AppSecurity component
 */
class ConfirmComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function checkToken(){
        $controller = $this->_registry->getController();
        $session = $controller->getRequest()->getSession();

        if($session->check('ConfirmComponent.Data')){
            return true;
        }
        $controller->Flash->error(__('セッションが切れています。'));
        return false;
    }

}
