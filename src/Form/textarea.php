<?php namespace Formulaic ?>
<textarea <?=$o->renderOptions()?>><?=htmlentities($o->value, ENT_COMPAT, 'UTF-8')?></textarea>

