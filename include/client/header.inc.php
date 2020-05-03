<?php
$title = ($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: ' . __('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=" . urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=" . $ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8");
header("Content-Security-Policy: frame-ancestors " . $cfg->getAllowIframes() . ";");

if (($lang = Internationalization::getCurrentLanguage())) {
    $langs = array_unique(array($lang, $cfg->getPrimaryLanguage()));
    $langs = Internationalization::rfc1766($langs);
    header("Content-Language: " . implode(', ', $langs));
}
?>
<!DOCTYPE html>
<html class="bg-light" <?php
                        if (
                            $lang
                            && ($info = Internationalization::getLanguageInfo($lang))
                            && (@$info['direction'] == 'rtl')
                        )
                            echo ' dir="rtl" class="rtl"';
                        if ($lang) {
                            echo ' lang="' . $lang . '"';
                        }

                        // Dropped IE Support Warning
                        if (osTicket::is_ie())
                            $ost->setWarning(__('osTicket no longer supports Internet Explorer.'));
                        ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="description" content="customer support platform">
    <meta name="keywords" content="osTicket, Customer support system, support ticket system">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?cba6035" media="screen" />
    <!-- <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?cba6035" media="screen" /> -->
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?cba6035" media="print" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?cba6035" media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?cba6035" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH ?>css/jquery-ui-timepicker-addon.css?cba6035" media="all" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?cba6035" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?cba6035" media="screen" />
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?cba6035" />
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?cba6035" />
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?cba6035" />
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/select2.min.css?cba6035" />
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?php echo ROOT_PATH ?>images/oscar-favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo ROOT_PATH ?>images/oscar-favicon-16x16.png" sizes="16x16" />
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-3.4.0.min.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.12.1.custom.min.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-timepicker-addon.js?cba6035"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?cba6035"></script>
    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-plugins.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?cba6035"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/select2.min.js?cba6035"></script>
    <!-- Catu.IO -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php
    if ($ost && ($headers = $ost->getExtraHeaders())) {
        echo "\n\t" . implode("\n\t", $headers) . "\n";
    }

    // Offer alternate links for search engines
    // @see https://support.google.com/webmasters/answer/189077?hl=en
    if (($all_langs = Internationalization::getConfiguredSystemLanguages())
        && (count($all_langs) > 1)
    ) {
        $langs = Internationalization::rfc1766(array_keys($all_langs));
        $qs = array();
        parse_str($_SERVER['QUERY_STRING'], $qs);
        foreach ($langs as $L) {
            $qs['lang'] = $L; ?>
            <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>?<?php
                                                                                                            echo http_build_query($qs); ?>" hreflang="<?php echo $L; ?>" />
        <?php
        } ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" hreflang="x-default" />
    <?php
    }
    ?>
    <style>
        bg-catu,
        thead {

            background-color: #633991;
        }


        h1,
        text-catu {
            color: #633991;
        }

        a {
            color: #FB76B6
        }

        a:hover {
            color: #FB76B6
        }

        .navbar-nav a {



            border-bottom: 1.2px solid rgba(255, 255, 255, 0.9);


            color: rgba(255, 255, 255, 0.9)
        }

        .navbar-nav a:hover {
            text-decoration: none;
            color: #FB76B6
        }

        .navbar-nav a:hover {

            border-bottom-color: #FB76B6
        }

        .btn-outline-secondary:not(:disabled):not(.disabled).active,
        .btn-outline-secondary:not(:disabled):not(.disabled):active,
        .show>.btn-outline-secondary.dropdown-toggle {
            color: #fff;
            background-color: #633991;
            border-color: #633991;
        }

        .btn-outline-secondary {
            color: #633991;
            border-color: #633991;
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #633991;
            border-color: #633991;
        }

        .card-title {
            color: #633991;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        body div:first-child {
            flex-grow: 1
        }

        #footer {

            bottom: 0;
            width: 100%;
            padding: 0 1rem;
            z-index: 1;
        }

        header {
            background-color: rgb(74, 13, 143);
            background: -moz-linear-gradient(135deg, rgb(74, 13, 143) 0%, rgb(250, 42, 143) 100%);
            background: -webkit-linear-gradient(135deg, rgb(74, 13, 143) 0%, rgb(250, 42, 143) 100%);
            background: linear-gradient(135deg, rgb(74, 13, 143) 0%, rgb(250, 42, 143) 100%);
            -webkit-box-shadow: 0px 5px 23px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0px 5px 23px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 5px 23px 0px rgba(0, 0, 0, 0.1);
            color: rgba(255, 255, 255, 0.6)
        }

        .navbar-brand,
        .navbar-brand img {
            max-height: 80px;
            max-width: 50%
        }

        .main-content h5 {
            font-weight: 400
        }

        .error {
            color: red
        }

        #profile input,
        #account input {
            width: 20rem;
            max-width: 100%
        }

        .thread-entry .header {
            color: white;
            background-color: #FB76B6
        }

        /**?Order 0 é do consumer e order 1 do atendente */


        .order-0~div .thread-body {
            border-bottom: 1px solid #FB76B6;
            border-right: 1px solid #FB76B6;
            border-bottom-right-radius: 1rem;

        }

        .order-1~div .thread-body {
            border-bottom: 1px solid #633991;
            border-left: 1px solid #633991;
            border-bottom-left-radius: 1rem;

        }

        .order-0~div .header {
            border-top-right-radius: 1rem;
            padding-left: 1rem
        }

        .order-1~div .header {
            border-top-left-radius: 1rem;
            text-align: right;
            padding-right: 1rem;
            background-color: #633991
        }

        .thread-event .avatar {
            height: 1.5rem
        }

        .thread-event {
            margin: 1rem 2rem
        }

        .thread-body,
        .thread-entry {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .thread-body p {
            word-break: break-word
        }

        .order-0.avatar {
            border-bottom: 1px solid #FB76B6
        }

        .order-1.avatar {
            border-bottom: 1px solid #633991
        }

        .home .card {
            z-index: 1;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .home-img {
            width: 15rem;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        #main-section {
            position: relative
        }

        /*medium devices*/
        @media (min-width: 992px) {
            .home-img {
                width: 20rem;
            }
        }
    </style>
</head>

<body class="bg-light text-black-50">
    <div id="main-section" id="container ">
        <?php
        if ($ost->getError())
            echo sprintf('<div class="error_bar">%s</div>', $ost->getError());
        elseif ($ost->getWarning())
            echo sprintf('<div class="warning_bar">%s</div>', $ost->getWarning());
        elseif ($ost->getNotice())
            echo sprintf('<div class="notice_bar">%s</div>', $ost->getNotice());
        ?>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark  container text-uppercase">
                <a class="navbar-brand" href="<?php echo ROOT_PATH; ?>index.php" title="<?php echo __('Support Center'); ?>">

                    <img class="img-fluid" src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php
                                                                                                echo $ost->getConfig()->getTitle(); ?>">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">

                        <?php
                        if (
                            $thisclient && is_object($thisclient) && $thisclient->isValid()
                            && !$thisclient->isGuest()
                        ) {

                        ?>
                            <li class="mx-2"><?= Format::htmlchars($thisclient->getName()) ?> </li>

                            <li class="mx-2"><a href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a> </li>
                            <li class="mx-2"><a href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a></li>
                            <li class="mx-2"><a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a></li>
                            <?php
                        } elseif ($nav) {
                            if ($cfg->getClientRegistrationMode() == 'public') { ?>
                                <?php echo __('Guest User'); ?> </li>
                                <li class="mx-2"> <?php
                                                }
                                                if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                                    <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a><?php
                                                                                                        } elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                                    <a href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></a>
                            <?php
                                                                                                        }
                                                                                                    } ?>
                                </li>

                                <?php
                                if (($all_langs = Internationalization::getConfiguredSystemLanguages())
                                    && (count($all_langs) > 1)
                                ) {
                                    $qs = array();
                                    parse_str($_SERVER['QUERY_STRING'], $qs);
                                    foreach ($all_langs as $code => $info) {
                                        list($lang, $locale) = explode('_', $code);
                                        $qs['lang'] = $code;
                                ?>
                                        <li>
                                            <a class="flag flag-<?php echo strtolower($info['flag'] ?: $locale ?: $lang); ?>" href="?<?php echo http_build_query($qs);
                                                                                                                                        ?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a>
                                        </li> <?php }
                                        } ?>

                    </ul>
                </div>
            </nav>

        </header>
        <div class="clear"></div>
        <?php
        if ($nav) { ?>
            <ul id="nav" class="flush-left">
                <?php
                // if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)){
                //     foreach($navs as $name =>$nav) {
                //         echo sprintf('<li><a class="%s %s" href="%s">%s</a></li>%s',$nav['active']?'active':'',$name,(ROOT_PATH.$nav['href']),$nav['desc'],"\n");
                //     }
                // } 
                ?>
            </ul>
        <?php
        } else { ?>
            <hr>
        <?php
        } ?>
        <div id="content" class="container mb-4">

            <?php if ($errors['err']) { ?>
                <div class="alert alert-danger"><?php echo $errors['err']; ?></div>
            <?php } elseif ($msg) { ?>
                <div class="alert alert-secondary"><?php echo $msg; ?></div>
            <?php } elseif ($warn) { ?>
                <div class="alert alert-warning"><?php echo $warn; ?></div>
            <?php } ?>