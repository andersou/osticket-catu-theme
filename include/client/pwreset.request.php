<?php
if (!defined('OSTCLIENTINC')) die('Access Denied');

$userid = Format::input($_POST['userid']);
?>
<h1><?php echo __('Forgot My Password'); ?></h1>
<p><?php echo __(
        'Enter your username or email address in the form below and press the <strong>Send Email</strong> button to have a password reset link sent to your email account on file.'
    );
    ?></p>
<div class="row">
    <form class="card" action="pwreset.php" method="post" id="clientLogin">
        <div class="card-body">
            <?php csrf_token(); ?>
            <input type="hidden" name="do" value="sendmail" />
            <strong><?php echo Format::htmlchars($banner); ?></strong>
            <br>

            <div class="form-group mt-2">
                <label for="username"><?php echo __('Username'); ?></label>
                <input class="form-control" id="username" type="text" name="userid" value="<?php echo $userid; ?>">
            </div>

        </div>
        <div class="card-footer">
            <p>
                <input class="btn btn-outline-secondary" type="submit" value="<?php echo __('Send Email'); ?>">
            </p>
        </div>
    </form>
</div>