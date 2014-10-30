<!doctype html>
<html lang='<? $tango->lang()?>'>
<head>
<meta charset='utf-8'/>
<title><?php echo $tango->title() ?></title>
<?php if(isset($favicon)): ?><link rel='shortcut icon' href='<?=$favicon?>'/><?php endif; ?>
<link rel='stylesheet' type='text/css' href='<? echo $tango->style()?>'/>
</head>
<body>
  <div id='wrapper'>
    <div id='header'><? echo $tango->header()?></div>
    <div id='main'><? echo $tango->main()?></div>
    <div id='footer'><? echo $tango->footer()?></div>
  </div>
</body>
</html>