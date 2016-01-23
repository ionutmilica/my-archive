<?php

require '../cURL.php';
require 'uvtClient.php';

$u = new uvtClient;
$u->fetch(); // we need a small cache system

?>
<html>
<head>
	<?php echo $u->getHTMLHead(); ?>
</head>
<body>

<h1>Salut</h1>

</body>
</html>


