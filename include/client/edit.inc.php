<?php

if (!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) die('Access Denied!');

?>

<h1>
    <?php echo sprintf(__('Editing Ticket #%s'), $ticket->getNumber()); ?>
</h1>

<form action="tickets.php" method="post">
    <?php echo csrf_token(); ?>
    <input type="hidden" name="a" value="edit" />
    <input type="hidden" name="id" value="<?php echo Format::htmlchars($_REQUEST['id']); ?>" />

    <div id="dynamic-form">
        <?php if ($forms)
            foreach ($forms as $form) {
                $form->render(['staff' => false]);
            } ?>
    </div>

    <hr>
    <p style="text-align: center;">
        <input type="submit" class="btn btn-outline-secondary m-1" value="<?= __('Update') ?>" />
        <input type="reset" class="btn btn-outline-secondary m-1" value="<?= __('Reset') ?>" />
        <input type="button" class="btn btn-outline-secondary m-1" value="<?= __('Cancel') ?>" onclick="javascript:
        window.location.href='index.php';" />
    </p>
</form>