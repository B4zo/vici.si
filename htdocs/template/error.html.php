<?php ob_start()?>

<div class="row">
<h1>Napaka</h1>

</div>

<?php
$content=ob_get_clean();

require "template/layout.html.php";

?>
