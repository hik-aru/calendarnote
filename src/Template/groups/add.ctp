<?= $this->AppForm->create($group) ?>
<?= $this->AppForm->input('name', array('label'=>__('Group Name',true))) ?>
<?= $this->AppForm->input('memo') ?>

<tr><td colspan="2" class="buttons">

<?= $this->AppForm->submit(__('Save',true), array('div'=>false)) ?>

</td></tr>

<?= $this->AppForm->end() ?>
