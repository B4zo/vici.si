<?php ob_start()?>

<div class="row">
    <h1>Zabava</h1>
</div>
<div>
    <p>Oče vpraša Janezka, ob koncu šolskega leta: ''No, Janezek, kako je?'' Janezek: ''Vse je v najlepšem redu, ati.'' Oče: ''Kaj to pomeni?'' Janezek: ''To pomeni, da je moja pogodba za drugi razred podaljšana za eno leto!''</p>
</div>

<?php
$content=ob_get_clean();
require "template/layout.html.php";
?>
