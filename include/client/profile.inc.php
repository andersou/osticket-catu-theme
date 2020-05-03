<h1><?php echo __('Manage Your Profile Information'); ?></h1>
<p><?php echo __(
        'Use the forms below to update the information we have on file for your account'
    ); ?>
</p>
<form id="profile" action="profile.php" method="post">
    <?php csrf_token(); ?>

    <?php
    foreach ($user->getForms() as $f) {
        $f->render(['staff' => false]);
    }
    if ($acct = $thisclient->getAccount()) {
        $info = $acct->getInfo();
        $info = Format::htmlchars(($errors && $_POST) ? $_POST : $info);
    ?>

        <div>
            <hr>
            <h3><?php echo __('Preferences'); ?></h3>
        </div>
        <div class="form-group">
            <div class="label">
                <?php echo __('Time Zone'); ?>
            </div>
            <?php
            $TZ_NAME = 'timezone';
            $TZ_TIMEZONE = $info['timezone'];
            include INCLUDE_DIR . 'staff/templates/timezone.tmpl.php'; ?>
            <div class="error"><?php echo $errors['timezone']; ?></div>
        </div>






        <?php if ($cfg->getSecondaryLanguages()) { ?>
            <div class="form-group"><label><?php echo __('Preferred Language'); ?>:</label></div>
            <?php
            $langs = Internationalization::getConfiguredSystemLanguages(); ?>
            <select name="lang">
                <option value="">&mdash; <?php echo __('Use Browser Preference'); ?> &mdash;</option>
                <?php foreach ($langs as $l) {
                    $selected = ($info['lang'] == $l['code']) ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $l['code']; ?>" <?php echo $selected;
                                                                ?>><?php echo Internationalization::getLanguageDescription($l['code']); ?></option>
                <?php } ?>
            </select>
            <span class="error">&nbsp;<?php echo $errors['lang']; ?></span>

        <?php }
        if ($acct->isPasswdResetEnabled()) { ?>
            <div>
                <hr>
                <h3><?php echo __('Access Credentials'); ?></h3>
            </div>
            <div class="form-group"><label for=""> <?php echo __('Current Password'); ?></label><input class="form-control" type="password" size="18" name="cpasswd" value="<?php echo $info['cpasswd']; ?>">
                &nbsp;<span class="error">&nbsp;<?php echo $errors['cpasswd']; ?></span></div>
            <div class="form-group"><label for=""> <?php echo __('New Password'); ?></label> <input class="form-control" type="password" size="18" name="passwd1" value="<?php echo $info['passwd1']; ?>">
                &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span></div>
            <div class="form-group"><label for=""> <?php echo __('Confirm New Password'); ?></label> <input class="form-control" type="password" size="18" name="passwd2" value="<?php echo $info['passwd2']; ?>">
                &nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span></div>

            <?php if (!isset($_SESSION['_client']['reset-token'])) { ?>

            <?php } ?>

        <?php } ?>
    <?php } ?>

    <hr>
    <p>
        <input type="submit" class="btn btn-outline-secondary" value="Atualizar" />
        <input type="reset" class="btn btn-outline-dark" value="Resetar " />
        <input type="button" class="btn btn-outline-danger" value="Cancelar" onclick="javascript:
        window.location.href='index.php';" />
    </p>
</form>