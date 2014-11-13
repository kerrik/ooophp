<!DOCTYPE html>
        <?=$tango->head()?>
    <body>
        <div id='wrapper'>
            <div id='header'>
                <?=$tango->header()?>
                <?=$tango->menu($main_menu) ?>
            </div><!-- header -->
            <div id='main'>
                <?=$tango->main()?>
                
            </div><!-- main -->
            <footer id='footer'>
                <?=$tango->footer()?>
            </footer>
            <?= $tango->scripts_footer(); ?>
        </div> <!-- wrapper -->
    </body>
</html>