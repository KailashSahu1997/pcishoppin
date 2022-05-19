<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>Checkout</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/fav.png">
    <meta name="theme-color" content="#d52027">
    
</head>
<body class="sticky-header">
    <?php include 'header.php';?>
        
        <section class="breadcrumb-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-box">
                            <h1 class="page-title">Checkout</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=            Cart Start            =-->
        <!--=====================================-->
        <section class="product_section layout_padding">
         <div class="container p-2">
             <form action="<?=base_url('place-order')?>" method="post">
              <div class="row">
               <div class="col-sm-8">
                  <div class="row">
                      <div class="col-sm-12">
                      <div class="detail-box">
                      <h5>Contact Information</h5>
                      </div>
                      </div>
                      
                      <div class="col-md-6">
                         <label class="mt-3 h6">Name :</label>
                         <input type="text" name="name" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                         <label class="mt-3 h6">Email :</label>
                         <input type="email" name="email" class="form-control" required>
                      </div>
                      <div class="col-md-6">
                         <label class="mt-3 h6">Number :</label>
                         <input type="number" name="mobile" class="form-control" required>
                      </div>
                       <div class="col-md-6">
                         <label class="mt-3 h6">Address :</label>
                         <textarea rows="3" class="form-control" name="address"></textarea>
                      </div>
                      </div>
               </div> 
               <div class="col-md-4">
                  <div class="box">
                      <?php 
                     $i=1;
                     $grand_total=0;
                     foreach($cartItems as $item)
                        {  
                           $grand_total+=$item['subtotal'];
                        }?>
                   <b>Items Subtotal : <?=$grand_total?></b>
                  <!-- <hr>
                  Total : <?=$grand_total?> -->
                  <hr>
                  <button type="submit" class="btn btn-sm btn-danger">Place Orders</button>
                  </div>
               </div>
               </form>
            </div>
           
         </div>
      </section>
      <!-- end product section -->
      <!-- end subscribe section -->
      <!-- jQery -->

      <script>
        
        function minues(id) {
         var input=$('#qnt'+id).val();
         var rowid=$('#rowid'+id).val();

         var count = parseInt(input) - 1;

               if(count!=0)
               {
                  $('#qnt'+id).val(count);

                  $.ajax({
                   url:'<?=base_url()?>update_cart',
                   method: 'post',
                   data: {id:rowid,qnt:count},
                   success: function(response){
                     if(response==1)
                     {
                      window.location.reload();
                   }

                }
             });
               }

                
        }
        function plush(id) {
             var input=$('#qnt'+id).val();
             var rowid=$('#rowid'+id).val();
             newqn=parseInt(input)+1;
            $('#qnt'+id).val(newqn);
              $.ajax({
                   url:'<?=base_url()?>update_cart',
                   method: 'post',
                   data: {id:rowid,qnt:newqn},
                   success: function(response){
                     if(response==1)
                     {
                     window.location.reload();
                   }

                }
             });
        }

        function cart_item_remove(id) {
             var rowid=$('#rowid'+id).val();
              $.ajax({
                   url:'<?=base_url()?>update_cart',
                   method: 'post',
                   data: {id:rowid,qnt:0},
                   success: function(response){
                     if(response==1)
                     {
                     window.location.reload();
                   }

                }
             });
        }
            
      </script>
        
               <?php include 'footer.php';?> 

</html>
