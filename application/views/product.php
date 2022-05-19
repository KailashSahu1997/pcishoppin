<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>Shop</title>
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
                            <h1 class="page-title">Shop</h1>
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
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
          <span id="cart_success"></span>
      <?php 

      $result=
               array(
                  array('id'=>1,'image'=>'/assets/images/hplc-column-storage-cabinet1.jpg','product_name'=>'storage cabinets : csc 30,60,90 & csc 120 P','price'=>10,'hsncode'=>'84198990','discription'=>' <h5>Specification</h5>
                                    <h6 class="text-black"><i class="fas fa-angle-double-right"></i>  CSC 30</h6>
                                    <ul class="list list-mark">
                                        <li>Capacity : 30 HPLC column</li>
                                        <li>Dimensions (WxHxD) : 295 X 380 X 400 mm</li>
                                        <li>No. of Drawers : 5 drawers</li>
                                    </ul>
                                    <h6 class="text-black"><i class="fas fa-angle-double-right"></i>  CSC 60</h6>
                                    <ul class="list list-mark">
                                        <li>Capacity : 60 HPLC column</li>
                                        <li>Dimensions (WxHxD) :  295 X 760 X 400 mm</li>
                                        <li>No. of Drawers : 10 drawers</li>
                                    </ul>
                                    <h6 class="text-black"><i class="fas fa-angle-double-right"></i>  CSC 90</h6>
                                    <ul class="list list-mark">
                                        <li>Capacity : 100 HPLC column</li>
                                        <li>Dimensions (WxHxD) :  295 X 1140 X 400 mm</li>
                                        <li>No. of Drawers : 15 drawers</li>
                                    </ul>
                                    <h6 class="text-black"><i class="fas fa-angle-double-right"></i>  CSC 120</h6>
                                    <ul class="list list-mark">
                                        <li>Capacity : 120 HPLC column</li>
                                        <li>Dimensions (WxHxD) : 590 X 760 X 400 mm</li>
                                        <li>No. of Drawers : 20 drawers</li>
                                    </ul>
'),
                  array('id'=>2,'image'=>'/assets/images/ultrasonic-bath-with-chiller2.jpg','product_name'=>'Ultrasonic bath : 1.5 ,3.5, 6 Litre models','price'=>10,'hsncode'=>'84562000','discription'=>' <p><b>Principle of Ultrasonic Bath</b></p>
                                    <p> High frequency electrical energy is converted into ultrasound waves by means of ultrasonic Tranducers, which are bonded on the base of SS water tank. These high frequency sound waves create countless, Microscopic vacuum bubbles, which rapidly expand and collapse. This phenomenon is called as CAVITAION. These bubbles act like miniature high speed brushes, driving the liquid into all openings and minutes recesses of the object immersed in the liquid. Intense scrubbing of Cavitation cleans away all the dirt and soil from the object immersed and the object is perfectly cleaned. Intricate objects can be cleaned with either complete or little dismantling.</p><br>

                                    <p><b>Applications:</b></p>
                                    <ul class="list list-mark">
                                        <li><b>Laboratory :</b> For glassware, lters cleaning & HPLC mobile phase degassing</li>
                                        <li><b>Industrial :</b> Semi-Conductors, Electronic components, Precious parts & Mechanisms.</li>
                                        <li><b>Medical : </b> Dental & Surgical instruments.</li>
                                        <li><b>Opticals :</b> Spectacles, Spectable frames, Lenses</li>
                                        <li><b>Jewellery :</b> For all kinds of jewellery, Precious stones etc.</li>
                                        <li><b>To Remove :</b> Dust, Oil, Greases, Polishing compounds, Waxes, Swarfs, Stains, Soils and any other contaminant.</li>
                                                                            </ul><br>
                                                                            
                                        <p><b>Salient Features:</b></p>
                                        <ul class="list list-mark">
                                        <li>Easy to operate & made of one piece SS Tank.</li>
                                        <li>Indigenously manufactured with advanced MOSFET technology, with Auto-tuning facility.</li>
                                        <li>Digital tuning of transducers with generators to avoid any frequency shifted even during demanding applications.</li>
                                        <li>Compact, rugged and highly durable systems.</li>
                                        <li>Extensively protected electronic circuits means longer and safer operations.</li>
                                                                            </ul><br>

                                        <p><b>Technical Specifications</b></p>
                                        <ul class="list list-mark">
                                        <li>Operating frequency 33 ±3 KHz, for all general purpose cleaning is highly recommended. Frequency of 40 KHz is also available.</li>
                                        <li>Input voltage range of 200V AC - 230V AC, 50 Hz, single phase.</li>
                                        <li>Micro controller based timer range 0 to 15 minutes upto 3.5 ltrs.30/99 min. timer are also available.</li>
                                        <li>Thermostatic heating</li>
                                        <li>Digital temperature controller, degassing, PSP (optional) if required. </li>
                                        <li>Higher capacity other than mentioned are also available as per customer requirements.</li>
                                        <li>Different erent shape baskets available.</li>
                                        <li>Weight rings of differences sizes available for Different measuring cylinders.</li>
                                        <li>Available with Heater, DTC, PSP, Degassing as optional.</li>
                                    </ul><br>

'),
                  array('id'=>3,'image'=>'/assets/images/KBr-Die-set.jpg','product_name'=>'Kbr die set','price'=>10,'hsncode'=>'90279090','discription'=>'<p>Most commonly used Die for IR/FTIR for solid sampling of 13 mm pallet size consist on Anvil & Plunger, Top & Bottom Die Port, Extractor Ring, Oring.</p><p>Other sizes like 10 mm, 20 mm also available.</p>'),
                  array('id'=>4,'image'=>'/assets/images/pellet-holder-agate-mortar-pastle.jpg','product_name'=>'Pellets for Kbr die set','price'=>10,'hsncode'=>'90279090','discription'=>'<p>The pellet holder is use to hold pallet (13 mm) of KBr, suitable to any IR /FTIR </p><p>Agate, Motar pestle use to propre sample</p>'),
                  array('id'=>5,'image'=>'/assets/images/manual-press.jpg','product_name'=>'Hydraulic press manual 15 Ton','price'=>10,'hsncode'=>'84629190','discription'=>'<ul class="list list-mark">
                                        <li>A Complete Laboratory hydraulic press producing a force about 15 tones use to make high quality 13 mm pallet used for IR / FTIR / XRF solid sampling.</li>
                                        <li>15 ton laboratory hydraulic pallet press is a compact, elegant and robust machine, typically used by R&D & QC labs for various pelletizing applications for IR / XRF etc.</li>
                                        <li>The high pressure pumping unit supplies hydraulic fluid to the up-stroking ram of the cylinder. This causes the ram to rise steadily and positively in the upward direction. As a result, pressure is applied on any object placed between screw and piston top plate.</li>
                                    </ul>'),
                  array('id'=>6,'image'=>'/assets/images/hydraulic-press.jpg','product_name'=>'Hydraulic press manual 2 Ton','price'=>10,'hsncode'=>'84798930','discription'=>'<ul class="list list-mark">
                                        <li>A Complete Laboratory hydraulic press producing a force about 15 tones use to make high quality 13 mm pallet used for IR / FTIR / XRF solid sampling.</li>
                                        <li>15 ton laboratory hydraulic pallet press is a compact, elegant and robust machine, typically used by R&D & QC labs for various pelletizing applications for IR / XRF etc.</li>
                                        <li>The high pressure pumping unit supplies hydraulic fluid to the up-stroking ram of the cylinder. This causes the ram to rise steadily and positively in the upward direction. As a result, pressure is applied on any object placed between screw and piston top plate.</li>
                                    </ul>'),
                  array('id'=>7,'image'=>'/assets/images/nylon-syringe-filter1.jpg','product_name'=>'Syringe filter Nylon','price'=>10,'hsncode'=>'84219900','discription'=>'<p> Nylon syringe filters offer universal application for analytical procedures. Hydrophilic Nylon is ideal for aqueous (non-acidic) or organic sample prep and HPLC, GC or dissolution sample analysis. With its excellent flow characteristics, very low extractable levels and mechanical stability, Nylon offer the best combination of physical parameters to meet the most stringent analytical needs in 4mm, 13mm, 17mm, 25mm, 33mm diameters. The naturally hydrophilic, high protein binding and high dirt loading capacity of Nylon are natural advantages. </p>
'),
                  array('id'=>8,'image'=>'/assets/images/black-screw-cap-with-septa-white-ptfe-red-silicone.jpg','product_name'=>'Syringe filter PTFE','price'=>10,'hsncode'=>'84219900','discription'=>'<p> Syringe filters are purpose-build with features designed to bring the highest levels of performance and purity to your research. We incorporate a variety of membranes to offer separation and purification solutions for the majority of your laboratory needs. </p>
'),
                  array('id'=>9,'image'=>'/assets/images/pvdf-syringe-filter1.jpg','product_name'=>'Syringe filter PVDF','price'=>10,'hsncode'=>'84219900','discription'=>' <p> Syringe filters are purpose-build with features designed to bring the highest levels of performance and purity to your research. We incorporate a variety of membranes to offer separation and purification solutions for the majority of your laboratory needs. PVDF (Polyvinylidene fluoride) - extremely low protein-binding for filtration of non-affressive and mild organic solutions, or were maximizing protein recovery is important. </p>
'),
                  array('id'=>10,'image'=>'/assets/images/clear-glass-screw-neck-vial.jpg','product_name'=>'Vials','price'=>10,'hsncode'=>'70179090','discription'=>'1.5ml, Screw Neck Vial N8, 32 X 11.6 mm, clear glass, 1st hydrol. class, small opening, label + filing lines'),
                  array('id'=>11,'image'=>'/assets/images/9mm-pp-short-thread-cap-blue-silicone-beige-ptfe-with-slit-bonding.jpg','product_name'=>'Caps','price'=>10,'hsncode'=>'83099020','discription'=>'9 mm PP Short Thread Cap Blue, 6 mm centre hole ( Silicone  beige / PTFE with slit bonding )'),
               );
               foreach($result as $list){
                  if($id==$list['id']){?>
                    <section class="client_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6" style="border:1px solid #ddd">
                  <img src="<?=base_url()?><?=$list['image']?>">
               </div>
               <div class="col-md-6">
                  <h2><?=$list['product_name']?></h2>
                  <h2>₹ <?=$list['price']?></h2>
                  <p><?=$list['discription']?></p>
                     <hr>
                     <input type="hidden" id="productid<?=$list['id']?>" value="<?=$list['id']?>">
                     <input type="hidden" id="image<?=$list['id']?>" value="<?=$list['image']?>">
                     <input type="hidden" id="name<?=$list['id']?>" value="<?=$list['product_name']?>">
                     <input type="hidden" id="price<?=$list['id']?>" value="<?=$list['price']?>">
                     <span class="minus border-rounded" onclick="minues('<?=$list['id']?>')">-</span>
                     <span id="qnt<?=$list['id']?>">1</span>
                     <span class="plus" onclick="plush('<?=$list['id']?>')">+</span>
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('<?=$list['id']?>');">Add to cart</button>
                     <hr>
                  <p><b><?=$list['hsncode']?></b></p>
               </div>
            </div>
         </div>
      </section>
                 <?php } }?>
      
      <!-- end client section -->
      <!-- start related product section-->
      <!-- end related product section -->
      <script type='text/javascript'>
 
 
   function addtocart(id){
    var productid = $('#productid'+id).val();
    var image = $('#image'+id).val();
    var name = $('#name'+id).val();
    var price = $('#price'+id).val();
    var qnt=$('#qnt'+id).html();
    $.ajax({
     url:'<?=base_url()?>addcard',
     method: 'post',
     data: {productid: productid,image:image,name:name,price:price,qnt:qnt},
     success: function(response){
         if(response==1)
         {
           $('#cart_success').html('<div class="alert alert-success" role="alert">Product Add To cart Successfully ..</div>')
           total_cart();
           setInterval(function () {$('#cart_success').hide()}, 1000);

         }

     }
   });
  }
 </script>
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
