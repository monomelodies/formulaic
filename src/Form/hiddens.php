<?php

namespace Formulaic;

if ($hiddens = $form->getHiddenFields()) {
    $render = [];
    foreach ($hiddens as $field) {
        if ($field instanceof Serial) {
            continue;
        }        
        $render[] = $field;
    }
    if ($render) {

?>
<div style="display: none"><?php

    foreach ($render as $field) {
        echo $field;
    }

?></div>
<?php

    }
}

