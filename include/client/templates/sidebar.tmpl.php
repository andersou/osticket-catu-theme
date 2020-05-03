<?php
$BUTTONS = isset($BUTTONS) ? $BUTTONS : true;
?>
<div class="home container">
    <?php if ($BUTTONS) { ?>
        <div class="row justify-content-center">

            <?php
            if (
                $cfg->getClientRegistrationMode() != 'disabled'
                || !$cfg->isClientLoginRequired()
            ) { ?>
                <div class="col-md-6  my-4">
                    <div class="card" style="">
                        <div class="card-body">
                            <h5 class="card-title"><?php
                                                    echo __('Open a New Ticket'); ?></h5>
                            <p class="card-text">Abra um ticket com nossa equipe de suporte para que seu problema seja resolvido o mais breve possível.</p>
                            <a href="open.php" class="btn btn-outline-secondary"><?php
                                                                                    echo __('Open a New Ticket'); ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-6  my-4">
                <div class="card" style="">
                    <div class="card-body">
                        <h5 class="card-title"><?php
                                                echo __('Check Ticket Status'); ?></h5>
                        <p class="card-text">Abra um ticket com nossa equipe de suporte para que seu problema seja resolvido o mais breve possível.</p>
                        <a href="view.php" class="btn btn-outline-secondary"><?php
                                                                                echo __('Check Ticket Status'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="content"><?php
                            if (
                                $cfg->isKnowledgebaseEnabled()
                                && ($faqs = FAQ::getFeatured()->select_related('category')->limit(5))
                                && $faqs->all()
                            ) { ?>
            <section>
                <div class="header"><?php echo __('Featured Questions'); ?></div>
                <?php foreach ($faqs as $F) { ?>
                    <div><a href="<?php echo ROOT_PATH; ?>kb/faq.php?id=<?php
                                                                        echo urlencode($F->getId());
                                                                        ?>"><?php echo $F->getLocalQuestion(); ?></a></div>
                <?php   } ?>
            </section>
        <?php
                            }
                            $resources = Page::getActivePages()->filter(array('type' => 'other'));
                            if ($resources->all()) { ?>
            <section>
                <div class="header"><?php echo __('Other Resources'); ?></div>
                <?php foreach ($resources as $page) { ?>
                    <div><a href="<?php echo ROOT_PATH; ?>pages/<?php echo $page->getNameAsSlug();
                                                                ?>"><?php echo $page->getLocalName(); ?></a></div>
                <?php   } ?>
            </section>
        <?php
                            }
        ?></div>
</div>