
<?= $this->AppForm->create('Schedule') ?>
<?= $this->AppForm->hidden('id') ?>
<?= $this->AppForm->input('StartDate', ['type'=>'datetime']) ?>
<?= $this->AppForm->input('EndDate', ['type'=>'datetime']) ?>
<?= $this->AppForm->input('title') ?>
<?= $this->AppForm->input('contents', ['rows'=>'3']) ?>

<tr><td colspan="2">
<?= $this->AppForm->submit(__('Save', true), ['div'=>false]) ?>
<?= $this->AppForm->delete_button('calendarnote/schedules/delete/'.$this->request->data('id')) ?>

</td></tr>
<?= $this->AppForm->end() ?>
