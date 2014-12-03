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
        <h3>Demo code CSDL nâng cao</h3>
        <h4>Nhóm 10:</h4>
        <table>
            <tr>
                <td>STT</td>
                <td>MSSV</td>
                <td>Tên thành viên</td>
            </tr>
            <tr>
                <td>1</td>
                <td>11020237</td>
                <td>Hoàng Văn Phụng</td>
            </tr>
            <tr>
                <td>2</td>
                <td>11020088</td>
                <td>Mai Văn Đức</td>
            </tr>
            <tr>
                <td>3</td>
                <td>MSSV</td>
                <td>Nguyễn Đình Phi</td>
            </tr>
            <tr>
                <td>4</td>
                <td>MSSV</td>
                <td>Dương Kim Ngọc</td>
            </tr>
            <tr>
                <td>5</td>
                <td>MSSV</td>
                <td>Lê Đình Hiệp</td>
            </tr>
        </table>
        <div>
            <p>
                thông tin csdl
            </p>
        </div>
    </body>
</html>
