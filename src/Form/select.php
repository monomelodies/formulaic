<?php namespace Formulaic ?>
<select <?=$o->renderOptions()?>>
<?php foreach ($o->getChoices() as $choice) { ?>
    <?=$choice?>

<?php } ?>
</select>

