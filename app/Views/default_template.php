<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8" />
      <title>Some Title</title>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/app.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/<?php echo $css; ?>" />
   </head>
   <body>
     <header></header>
     hihi
     <section id="container" role="main">
     <?php return view($yield); ?>
     </section>
     <footer></footer>
     <script src="<php echo base_url(); ?>assets/js/app.js"></script>
     <script src="<php echo base_url(); ?>assets/js/<?php echo $js; ?>"></script>
  </body>
</html>