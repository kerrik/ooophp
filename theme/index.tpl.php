<!doctype html>
<?=$tango->head()?>
<body>
  <div id='wrapper'>
    <div id='header'><?=$tango->header()?>
    
    <?=$tango->menu($main_menu) ?>
    </div>
    <div id='main'><?=$tango->main()?></div>
    <footer id='footer'><?=$tango->footer()?></footer>
  </div>
    <?= $tango->scripts_footer(); ?>
</body>
</html>