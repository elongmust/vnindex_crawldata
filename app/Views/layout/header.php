<head>
<title><?php if(isset($GLOBALS['title'])) echo $GLOBALS['title'];?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($GLOBALS['meta'])) echo $GLOBALS['meta'];?>
<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>" type="text/css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo base_url('bootstrap/js/bootstrap.js') ?>"></script>
<?php if(isset($GLOBALS['sCss'])) echo $GLOBALS['sCss']; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>" type="text/css">
</head>