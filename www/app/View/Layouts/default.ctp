<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
	<head>
	    <link rel="stylesheet" href="css/normalize.css">
	    <link rel="stylesheet" href="css/main.css">
	<title>
		LUIS
	</title>
	<?php

		echo $this->Html->css('main');
		echo $this->Html->css('normalize');

		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

	<?php echo $this->fetch('content'); ?>

</body>
</html>
