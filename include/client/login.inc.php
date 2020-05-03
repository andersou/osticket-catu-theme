<?php
if (!defined('OSTCLIENTINC')) die('Access Denied');

$email = Format::input($_POST['luser'] ?: $_GET['e']);
$passwd = Format::input($_POST['lpasswd'] ?: $_GET['t']);

$content = Page::lookupByType('banner-client');

// if ($content) {
//     list($title, $body) = $ost->replaceTemplateVariables(
//         array($content->getLocalName(), $content->getLocalBody()));
// } else {
//     $title = __('Sign In');
//     $body = __('To better serve you, we encourage our clients to register for an account and verify the email address we have on record.');
// }

?>

<div class="row">


    <div class="col-md-6 col-lg-4 ">

        <form class=" " action="login.php" method="post" id="clientLogin">
            <h1>Entre</h1>
            <p>Para melhor ajudar, sugerimos que crie uma conta.</p>
            <?php csrf_token(); ?>

            <div class="card ">
                <div class="card-body">
                    <strong><?php echo Format::htmlchars($errors['login']); ?></strong>
                    <div>
                        <input class="form-control my-2" id="username" placeholder="<?php echo __('Email or Username'); ?>" type="text" name="luser" value="<?php echo $email; ?>">
                        <input class="form-control my-2" id="passwd" placeholder="<?php echo __('Password'); ?>" type="password" name="lpasswd" value="<?php echo $passwd; ?>">
                    </div>
                    <p>
                        <input class="btn btn-outline-secondary" type="submit" value="<?php echo __('Sign In'); ?>">
                        <?php if ($suggest_pwreset) { ?>
                            <a style="padding-top:4px;display:inline-block;" href="pwreset.php"><?php echo __('Forgot My Password'); ?></a>
                        <?php } ?>
                    </p>
                </div>
                <div class="card-footer">
                    <?php

                    $ext_bks = array();
                    foreach (UserAuthenticationBackend::allRegistered() as $bk)
                        if ($bk instanceof ExternalAuthentication)
                            $ext_bks[] = $bk;

                    if (count($ext_bks)) {
                        foreach ($ext_bks as $bk) { ?>
                            <div class="external-auth"><?php $bk->renderExternalLink(); ?></div><?php
                                                                                            }
                                                                                        }
                                                                                        if ($cfg && $cfg->isClientRegistrationEnabled()) {
                                                                                            if (count($ext_bks)) echo '<hr style="width:70%"/>'; ?>
                        <div style="margin-bottom: 5px">
                            <?php echo __('Not yet registered?'); ?> <a href="account.php?do=create"><?php echo __('Create an account'); ?></a>
                        </div>
                    <?php } ?>
                    <div>
                        <b><?php echo __("I'm an agent"); ?></b> —
                        <a href="<?php echo ROOT_PATH; ?>scp/"><?php echo __('sign in here'); ?></a>
                    </div>
                </div>
            </div>
            <p class="my-4">
                <?php
                if (
                    $cfg->getClientRegistrationMode() != 'disabled'
                    || !$cfg->isClientLoginRequired()
                ) {
                    echo sprintf(
                        __('If this is your first time contacting us or you\'ve lost the ticket number, please %s open a new ticket %s'),
                        '<a href="open.php">',
                        '</a>'
                    );
                } ?>
            </p>
        </form>



    </div>
    <div class="col-md-6 col-lg-8 d-none d-md-block">

        <img class="img-fluid " style='position: relative;    top: 50%;   left:50%; transform: translate(-50%,-50%);' src="assets/catu-theme/img-login.png" alt="">
    </div>
</div>
<br>