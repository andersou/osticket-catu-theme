        </div>
        </div>
        <div id="footer" class="d-flex  justify-content-between">
            <p><?php echo __('Copyright &copy;'); ?> <?php echo date('Y'); ?> <?php
                                                                                echo Format::htmlchars((string) $ost->company ?: 'osTicket.com'); ?> - <?php echo __('All rights reserved.'); ?></p>
            <a id="poweredBy" href="https://osticket.com" target="_blank"><?php echo __('Helpdesk software - powered by osTicket'); ?></a>
        </div>
        <div id="overlay"></div>
        <div id="loading">
            <h4><?php echo __('Please Wait!'); ?></h4>
            <p><?php echo __('Please wait... it will take a second!'); ?></p>
        </div>
        <?php
        if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
            <script type="text/javascript" src="<?php echo ROOT_PATH; ?>ajax.php/i18n/<?php
                                                                                        echo $lang; ?>/js"></script>
        <?php } ?>
        <script type="text/javascript">
            getConfig().resolve(<?php
                                include INCLUDE_DIR . 'ajax.config.php';
                                $api = new ConfigAjaxAPI();
                                print $api->client(false);
                                ?>);
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>

        </html>