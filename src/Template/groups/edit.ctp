<?= $this->AppForm->create($group) ?>
<?= $this->AppForm->hidden('id') ?>
<?= $this->AppForm->input('name', array('label'=>__('Group Name',true))) ?>
<?= $this->AppForm->input('memo') ?>

<tr><td colspan="2" class="buttons">

<?= $this->AppForm->submit(__('Save',true), array('div'=>false)) ?>
<?= $this->AppForm->delete_button('/groups/delete/'.$this->data['Group']['id']) ?>
<input type="button" onclick="location.href='../delete/<?= $this->requsest->data['group']['id'] ?>'" value="Delete">

</td></tr>

<?= $this->AppForm->end() ?>

