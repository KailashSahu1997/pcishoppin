<!DOCTYPE html>
<html>
   <head>
   <title>Invoice</title>
    <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="<?=base_url();?>/assets/images/favicon.png" type="">
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="<?=base_url();?>/assets/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="<?=base_url();?>/assets/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="<?=base_url();?>/assets/css/responsive.css" rel="stylesheet" />
   </head>
   <body>         
      <!-- product section -->
      <div class="container">
         <div class="row" style="border: 1px solid #ddd; padding: 10px;">
            <div class="col-md-12">
               <div class="col-md-12">Name: <b><?=$name?></b></div>
               <div class="col-md-12">Email: <b><?=$email?></b></div>
               <div class="col-md-12">Mobile: <b><?=$mobile?></b></div>
               <div class="col-md-12">Address: <b><?=$mobile?></b></div>
            </div>
            <div class="col-md-12 mt-3">
               <table class="table table-responsive" border="1px solid #000" width="100%">
                     <tr>
                        <th>s.no</th>
                        <th>Name</th>
                        <th>QNT</th>
                        <th>Subtotal</th>
                     </tr>
                     <?php 
                     $i=1;
                     $grand_total=0;
                     foreach($cartItems as $item){ ?>
                        <tr>
                           <td><?=$i?></td>
                           <td><?=$item["name"]?></td>
                           <td><div class="number">
                             
                             <?php echo $item["qty"]; ?>
                          </div></td>
                          <td><?=$item['subtotal'];?></td>
                       </tr>
                  <?php  $grand_total+=$item['subtotal'];
                  $i++;}?>
                  <tr>
                     <td colspan="3"><b>Sub Total</b></td>
                     <td><?=$grand_total?></td>
                  </tr>
                  </table>
            </div>
         </div>
      </div>
      <!-- end product section -->
      <!-- end subscribe section -->

      
   </body>
</html>