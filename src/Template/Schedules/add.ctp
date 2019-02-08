
<?= $this->AppForm->create('Schedule') ?>
<?= $this->AppForm->input('StartDate', ['type'=>'datetime']) ?>
<?= $this->AppForm->input('EndDate', ['type'=>'datetime']) ?>
<?= $this->AppForm->input('title') ?>
<?= $this->AppForm->input('contents', ['rows'=>'3']) ?>

<tr><td colspan="2">
<?= $this->AppForm->submit() ?>
</td></tr>
<?= $this->AppForm->end() ?>