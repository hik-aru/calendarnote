<?php
    echo($this->AppForm->create('Schedule'));
    echo($this->AppForm->input('StartDate', ['type'=>'datetime']));
    echo($this->AppForm->input('EndDate', ['type'=>'datetime']));
    echo($this->AppForm->input('title'));
    echo($this->AppForm->input('contents'));
?>
<tr><td colspan="2">
<?php
    echo($this->AppForm->submit());
?>
</td></tr>
<?php
    echo($this->AppForm->end());
?>