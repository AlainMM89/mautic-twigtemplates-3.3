<?php

/*
 * @copyright   2020 mtcextendee.com All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
?>

<?php if ($tmpl == 'index'): ?>
<div class="row">
    <hr>
    <h3 class="col-xs-12"><?php echo $view['translator']->trans(
            'mautic.twigTemplates.testing_area'
        ); ?>
    </h3>
    <br style="clear:both">
    <div class="contact-form">
        <div class="col-xs-4">
            <?php echo $view->render(
                'MauticCoreBundle:Helper:search.html.php',
                [
                    'searchValue' => $searchValue,
                    'action'      => $action,
                    'searchHelp'  => false,
                    'target'      => '.contact-options',
                    'tmpl'        => 'update',
                ]
            ); ?></div>
        <?php endif; ?>
        <div class="contact-options mt-5">


            <div class="col-xs-4"><?php echo $view['form']->form($form); ?></div>
            <div class="col-xs-12">
                <br>
                <?php if ($contactId): ?>
                    <h3><?php echo $view['translator']->trans(
                            'mautic.twigTemplates.example.content.filter.contact',
                            ['%contactId%' => $contactId]
                        ); ?>
                        <a href="" onclick="Mautic.reloadTwigTemplatesExample(mQuery('#contact_search_contact')); return false;" ><small><?php echo $view['translator']->trans(
                                'mautic.twigTemplates.test'
                            ); ?></small></a>
                    </h3>
                <?php endif; ?>
                <hr>
                <div id="twigTemplateExample"></div>
            </div>
            <?php if ($tmpl == 'index'): ?>
        </div>
    </div>
</div>
<?php endif; ?>


