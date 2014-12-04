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

$title = "Tìm kiếm";
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
        <?php $this->Paginator->options(array('url' => $this->passedArgs)); ?>
        <?php echo $this->Form->create('Pets',array('action'=>'search'));?>
        <fieldset>
            <legend><?php __('Pet Search');?></legend>
            <?php
                echo $this->Form->input('address');
                echo $this->Form->submit('Search');
            ?>
        </fieldset>
        <?php echo $this->Form->end();?>
        <?php
            if($data==NULL){
                echo "<h2>Nhập từ khóa để tìm kiếm.</h2>";
            }else{
                if($has==1){
                    echo $data;
                }else{
                    echo $this->Paginator->first('«First ');//di den trang dau tien
                    echo $this->Paginator->prev('Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
                    echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
                    echo $this->Paginator->next(' Next ', null, null, array('class' => 'disabled')); //Shows the next and previous links
                    echo $this->Paginator->last('Last»');//di den trang cuoi cung
                    echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
                    echo "<table>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Type</td>
                        <td>Owner</td>
                    </tr>";
                    foreach($data as $item){
                        echo "<tr>";
                        echo "<td>".$item['Pet']['id']."</td>";
                        echo "<td><a href='".$this->webroot."Pets/view/".$item['Pet']['id']."' >".$item['Pet']['name']."</a></td>";
                        echo "<td>".$item['Pet']['type']."</td>";
                        echo "<td>".$item['Pet']['person_id']."</td>";
                        echo "</tr>";
                    }
            }
        }?>
    </body>
</html>
