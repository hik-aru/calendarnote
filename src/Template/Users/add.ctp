
<?= $this->AppForm->create($user) ?>
<?= $this->AppForm->input('username', ['label'=>__('Login Name',true)]) ?>
<?= $this->AppForm->input('password', ['value'=>'']) ?>
<?= $this->AppForm->input('confirm_password', ['label'=>__('Password (for a check)'), 'type'=>'password', 'value'=>'']) ?>
<?= $this->AppForm->input('fullname') ?>
<?= $this->AppForm->input('email') ?>
<?= $this->AppForm->input('tel') ?>
<?= $this->AppForm->input('memo') ?>

<tr><td colspan="2" class="buttons">

<?= $this->AppForm->submit(__('Save',true), array('div'=>false)) ?>

</td></tr>

<?= $this->AppForm->end() ?>

