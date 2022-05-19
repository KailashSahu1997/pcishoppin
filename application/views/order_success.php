<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>Checkout PCI Analytics Pvt Ltd</title>
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
                            <h1 class="page-title">Orders</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
            <h2>ORDER Successfully ! Thank You For Order</h2>
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
