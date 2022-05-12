<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
echo $view['assets']->includeScript('plugins/MauticTwigTemplatesBundle/Assets/js/twigtemplates.js');

?>

<div class="row">
    <div class="col-xs-12">
        <?php echo $view['form']->row($form['sql']); ?>
    </div>
    <div class="col-xs-12 mt-lg">
        <div class="mt-3">
            <?php echo $view['form']->row($form['newButton']); ?>
            <?php echo $view['form']->row($form['editButton']); ?>
        </div>
    </div>
</div>