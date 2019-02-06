<?php 
e($appForm->create('Schedule'));
if ($this->action != 'add'){
	e($appForm->hidden('id'));
}
e($appForm->input('from'));
e($appForm->input('to'));
e($appForm->input('title'));
e($appForm->input('contents'));
?>
<tr><td colspan="2" class="buttons">
<?php 
e($appForm->submit(__('Save',true), array('div'=>false)));
if ($this->action != 'add'){
	e($appForm->delete_button('/schedules/delete/'.$this->data['Schedule']['id']));
}
?>
</td></tr>
<?php 
e($appForm->end());
?>
