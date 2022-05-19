<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>Cart PCI Analytics Pvt Ltd</title>
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
                            <h1 class="page-title">Cart</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
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

              <div class="row justify-content-md-center">
               <div class="col-sm-8">
                      <div class="col-sm-12">
                      <div class="detail-box">
                      <h5>Your order items</h5>
                      </div>
                      </div>
                       <table class="table table-responsive">
                     <tr>
                        <th>Product List</th>
                        <th>QNT</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>
                        <th></th>
                     </tr>
                     <?php 
                     $i=1;
                     $grand_total=0;
                     foreach($cartItems as $item){ ?>
                        <tr>
                           <td><img src="<?=base_url();?><?=$item["image"]?>" alt="" style="width: 100px;height: 150px;"> &nbsp; <?=$item['name'];?></td>
                           <td>
                             <span class="minus border-rounded" onclick="minues(<?=$item['id'];?>)">-</span>
                             <span id="qnt<?=$item['id']?>"><?php echo $item["qty"]; ?></span>
                             <span class="plus" onclick="plush(<?=$item['id'];?>)">+</span>
                             <input type="hidden" id="rowid<?=$item['id']?>" value="<?=$item['rowid']?>">
                          </td>
                          <td><?=$item['price']?></td>
                          <td><?=$item['subtotal'];?></td>
                          <td><a href="javascript:void(0)" class="text-danger" onclick="cart_item_remove(<?=$item['id'];?>)">X</a></td>
                       </tr>
                  <?php  $grand_total+=$item['subtotal'];
                  $i++;}?>
                  </table>
               </div> 
               <div class="col-md-4">
                  <div class="box">
                     <b>Items Subtotal : <?=$grand_total?></b>
                  <hr>
                  <a href="<?=base_url('checkout');?>" class="btn btn-sm btn-danger">Proceed to Checkout</a>
                  </div>
               </div>

            </div>
           
         </div>
      </section>
      <!-- end product section -->
      <!-- end subscribe section -->
      <!-- jQery -->

      <script>
        
        function minues(id) {
         var input=$('#qnt'+id).html();
         var rowid=$('#rowid'+id).val();

         var count = parseInt(input) - 1;

               if(count!=0)
               {
                  $('#qnt'+id).html(count);

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
             var input=$('#qnt'+id).html();
             var rowid=$('#rowid'+id).val();
             newqn=parseInt(input)+1;
            $('#qnt'+id).html(newqn);
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
