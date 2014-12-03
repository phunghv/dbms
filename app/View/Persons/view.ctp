<?php

/**
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

$title = "Thông tin cá nhân";
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <title>
		<?php echo $title ?>:
		<?php echo $this->fetch('title'); ?>
        </title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    </head>
    <body>
        <?php
            if($data==NULL){
                echo "<h2>Không có thông tin cá nhân người này.</h2>";
            }else{
                echo "<table>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>Telephone</td>
                    </tr>";
                $item;
                foreach($data as $item){
                
                    echo "<tr>";
                    echo "<td>".$item['Person']['id']."</td>";
                    echo "<td><a href='".$this->webroot."Persons/view/".$item['Person']['id']."' >".$item['Person']['name']."</a></td>";
                    echo "<td>".$item['Person']['address']."</td>";
                    echo "<td>".$item['Person']['tel']."</td>";
                    echo "</tr>";
               }
                echo "<table class='person_info'>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                         <td>Type</td>
                    </tr>";
                $listPet = array();
                foreach($data as $item){
                    echo "<tr>";
                    echo "<td>".$item['Pet']['id']."</td>";
                    echo "<td><a href='".$this->webroot."Pets/view/".$item['Pet']['id']."' >".$item['Pet']['name']."</a></td>";
                    echo "<td>".$item['Pet']['type']."</td>";
                    echo "</tr>";
                }
                
                foreach($data as $item){
                    echo "<tr>";
                    echo "<td><a href='".$this->webroot."Vehicles/view/".$item['Vehicle']['id']."' >".$item['Vehicle']['id']."</a></td>";
                    echo "<td>".$item['Vehicle']['type']."</td>";
                    echo "<td>".$item['Vehicle']['branch']."</td>";
                    echo "</tr>";
                }
            }
        ?>
    </body>
</html>
