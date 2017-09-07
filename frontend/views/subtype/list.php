<?php
/* @var $this yii\web\View */
if(count($subtypes) > 0){
    foreach($subtypes as $subtype) { ?>
        <option value="<?= $subtype->id ?>"><?= $subtype->name ?></option>;
    <?php }
}
