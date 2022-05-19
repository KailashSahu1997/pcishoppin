<!DOCTYPE html>
<html class="no-js" lang="en-US">
<head>
<meta charset="utf-8">
<title>Gas Equipment Manufacturers in India, Gas Generators, PCI Analytics Pvt. Ltd</title> 
<meta name="description" content="PCI Analytics Pvt. Ltd, an ISO9001:2015 certified, MSME registered Manufacturers and exporters of Laboratory Gas Purification Panel, Gas Purity Analyzer, Gas Detection and Safety Instruments, Gas Distribution Panel, Gas Fittings, Gas Regulator, Gas Flow Meter">
<meta name="keywords" content="Gas Generators, Laboratory Scientific, Gas Handling System Exporters, Analytical Equipment Suppliers, Consumables HPLC, Capillary Columns, Packed Columns, Caps, Vials, Septa, Gas Equipment Manufacturers in India, Gas Generators, Laboratory Scientific, Gas Handling System Exporters, Analytical Equipment Suppliers, Gas Handling Equipment, Gas Handling System, Air Compressors, laboratory oil-free air compressor, laboratory air compressor, laboratory air compressor suppliers, Air Dryer, Automatic Changeover, automatic changeover for generator, Automatic Changeover Mechanical, Automatic Changeover Electronic, Mechanical Auto Gas Changeover, Electronic (Digital) Auto Gas Changeover, Automatic Gas Cylinder Changeover Systems, on-Electric Gas Cylinder Changeover Systems, Gas Cylinder Auto change, Gas Auto Changeover, Cylinder Trolley, Cylinder Mounting Bracket, Gas Cylinder Regulators, Gas Detection System, hazardous gas detection system, Gas Distribution Panel & Selector Boxes, Gas Monitoring System, gas monitoring system project, Gas Purification & Control System For AAS, Gas Purification & Control System For GC, Gas Purification & Control System For ICP, Inline Micron Filters, Oxygen Analyser, oxygen analyser calibration, oxygen flow analyzer, Cylinder Regulator, cylinder regulator acetylene, Point of Use Regulators, point of use air regulator, Compression Fittings, compression fittings manufacturers">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="4 days">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>/pci/img/fav.png">
    <meta name="theme-color" content="#d52027">

    <link rel="stylesheet" href="<?=base_url();?>/pci/css/swc.css">

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
       

             <!-- product section -->
      <span id="cart_success"></span>
      <section class="product_section layout_padding">
         <div class="container p-2">
            <div class="row">
               <?php $result=
               array(
                  array('id'=>1,'image'=>'/assets/images/hplc-column-storage-cabinet1.jpg','product_name'=>'storage cabinets : csc 30,60,90 & csc 120 P','price'=>10,'hsncode'=>'84198990'),
                  array('id'=>2,'image'=>'/assets/images/ultrasonic-bath-with-chiller2.jpg','product_name'=>'Ultrasonic bath : 1.5 ,3.5, 6 Litre models','price'=>10,'hsncode'=>'84562000'),
                  array('id'=>3,'image'=>'/assets/images/KBr-Die-set.jpg','product_name'=>'Kbr die set','price'=>10,'hsncode'=>'90279090'),
                  array('id'=>4,'image'=>'/assets/images/pellet-holder-agate-mortar-pastle.jpg','product_name'=>'Pellets for Kbr die set','price'=>10,'hsncode'=>'90279090'),
                  array('id'=>5,'image'=>'/assets/images/manual-press.jpg','product_name'=>'Hydraulic press manual 15 Ton','price'=>10,'hsncode'=>'84629190'),
                  array('id'=>6,'image'=>'/assets/images/hydraulic-press.jpg','product_name'=>'Hydraulic press manual 2 Ton','price'=>10,'hsncode'=>'84798930'),
                  array('id'=>7,'image'=>'/assets/images/nylon-syringe-filter1.jpg','product_name'=>'Syringe filter Nylon','price'=>10,'hsncode'=>'84219900'),
                  array('id'=>8,'image'=>'/assets/images/black-screw-cap-with-septa-white-ptfe-red-silicone.jpg','product_name'=>'Syringe filter PTFE','price'=>10,'hsncode'=>'84219900'),
                  array('id'=>9,'image'=>'/assets/images/pvdf-syringe-filter1.jpg','product_name'=>'Syringe filter PVDF','price'=>10,'hsncode'=>'84219900'),
                  array('id'=>10,'image'=>'/assets/images/clear-glass-screw-neck-vial.jpg','product_name'=>'Vials','price'=>10,'hsncode'=>'70179090'),
                  array('id'=>11,'image'=>'/assets/images/9mm-pp-short-thread-cap-blue-silicone-beige-ptfe-with-slit-bonding.jpg','product_name'=>'Caps','price'=>10,'hsncode'=>'83099020'),
               );
               foreach($result as $list)
                  {?>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                     <div class="img-box">
                         <a href="<?=base_url();?>product/<?=$list['id']?>">
                        <img src="<?=base_url()?><?=$list['image']?>" alt="">
                        </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                          <?=$list['product_name']?>
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹<?=$list['price']?>
                    </h5>
                    </div>
                     <input type="hidden" id="productid<?=$list['id']?>" value="<?=$list['id']?>">
                     <input type="hidden" id="image<?=$list['id']?>" value="<?=$list['image']?>">
                     <input type="hidden" id="name<?=$list['id']?>" value="<?=$list['product_name']?>">
                     <input type="hidden" id="price<?=$list['id']?>" value="<?=$list['price']?>">
                     <input type="hidden" id="qnt<?=$list['id']?>" value="1">
                      <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('<?=$list['id']?>');">Add to cart</button>
                  </div>
               </div>
               <?php }?>
               <!-- <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                     <div class="img-box">
                         <a href="<?=base_url();?>product/2">
                        <img src="./assets/images/hplc-column-storage-cabinet1.jpg" alt="">
                        </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           Column storage cabinets : csc 30,60,90 & csc 120 P models
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid2" value="2">
                     <input type="hidden" id="image2" value="/assets/images/hplc-column-storage-cabinet1.jpg">
                     <input type="hidden" id="name2" value="Column storage cabinets : csc 30,60,90 & csc 120 P models">
                     <input type="hidden" id="price2" value="10">
                     <input type="hidden" id="qnt2" value="1">
                      <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('2');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    <a href="<?=base_url();?>product/2">
                     <div class="img-box">
                        <a href="<?=base_url();?>product/3">
                        <img src="./assets/images/Column-Storage-30-01.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           Column Storage - 30
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid3" value="3">
                     <input type="hidden" id="image3" value="/assets/images/Column-Storage-30-01.jpg">
                     <input type="hidden" id="name3" value="Column Storage - 30">
                     <input type="hidden" id="price3" value="10">
                     <input type="hidden" id="qnt3" value="1">
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('3');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                        <a href="<?=base_url();?>product/4">
                        <img src="./assets/images/Sterility-test-unit.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           Solvent Filtration Kit
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid4" value="4">
                     <input type="hidden" id="image4" value="/assets/images/Sterility-test-unit.jpg">
                     <input type="hidden" id="name4" value="Solvent Filtration Kit">
                     <input type="hidden" id="price4" value="10">
                     <input type="hidden" id="qnt4" value="1">
                      <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('4');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                        <a href="<?=base_url();?>product/5">
                        <img src="./assets/images/Syringe-filter-all-model-03.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                        Syringe filter all
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid5" value="5">
                     <input type="hidden" id="image5" value="/assets/images/Syringe-filter-all-model-03.jpg">
                     <input type="hidden" id="name5" value="Syringe filter all model">
                     <input type="hidden" id="price5" value="10">
                     <input type="hidden" id="qnt5" value="1">
                      <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('5');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                        <a href="<?=base_url();?>product/6">
                        <img src="./assets/images/vials-2ml-all-model-02.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           Vials – 2ml All model
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid6" value="6">
                     <input type="hidden" id="image6" value="/assets/images/vials-2ml-all-model-02.jpg">
                     <input type="hidden" id="name6" value="Vials – 2ml All model">
                     <input type="hidden" id="price6" value="10">
                     <input type="hidden" id="qnt6" value="1">
                      <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('6');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                        <a href="<?=base_url();?>product/7">
                        <img src="./assets/images/oxygen.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           Oxygen Analyser
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid7" value="7">
                     <input type="hidden" id="image7" value="/assets/images/oxygen.jpg">
                     <input type="hidden" id="name7" value="Oxygen Analyser">
                     <input type="hidden" id="price7" value="10">
                     <input type="hidden" id="qnt7" value="1">
                      <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('7');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                        <a href="<?=base_url();?>product/8">
                        <img src="./assets/images/Quartz-cuvette-02.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           Quartz cuvette
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid8" value="8">
                     <input type="hidden" id="image8" value="/assets/images/Quartz-cuvette-02.jpg">
                     <input type="hidden" id="name8" value="Quartz cuvette">
                     <input type="hidden" id="price8" value="10">
                     <input type="hidden" id="qnt8" value="1">
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('8');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                         <a href="<?=base_url();?>product/9">
                        <img src="./assets/images/Solvent-safety-cap-02.jpg" alt="">
                        </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                          Solvent safety cap
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid9" value="9">
                     <input type="hidden" id="image9" value="/assets/images/Solvent-safety-cap-02.jpg">
                     <input type="hidden" id="name9" value="Solvent safety cap">
                     <input type="hidden" id="price9" value="10">
                     <input type="hidden" id="qnt9" value="1">
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('9');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                     <div class="img-box">
                        <a href="<?=base_url();?>product/10">
                        <img src="./assets/images/HPLC-Column-04.jpg" alt="">
                       </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           HPLC Column Oven
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid10" value="10">
                     <input type="hidden" id="image10" value="/assets/images/HPLC-Column-04.jpg">
                     <input type="hidden" id="name10" value="HPLC Column Oven">
                     <input type="hidden" id="price10" value="10">
                     <input type="hidden" id="qnt10" value="1">
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('10');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                     <a href="<?=base_url();?>product/11">
                        <img src="./assets/images/Ultrasonic-Bath-3.5-Ltr.jpg" alt="">
                     </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                          Ultrasonic Bath 6.5 Ltr
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid11" value="11">
                     <input type="hidden" id="image11" value="/assets/images/Ultrasonic-Bath-3.5-Ltr.jpg">
                     <input type="hidden" id="name11" value="Ultrasonic Bath 6.5 Ltr">
                     <input type="hidden" id="price11" value="10">
                     <input type="hidden" id="qnt11" value="1">
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('11');">Add to cart</button>
                  </div>
               </div>
               <div class="col-sm-6 col-xs-6 col-md-3 col-lg-3">
                  <div class="box">
                    
                     <div class="img-box">
                         <a href="<?=base_url();?>product/12">
                        <img src="./assets/images/D2-Lamp.jpg" alt="">
                        </a>
                     </div>
                     <div class="detail-box">
                        <h5>
                           D2 Lamp
                        </h5>
                     </div>
                     <div class="detail-box">
                     <h5>
                           ₹ 10
                    </h5>
                    </div>
                     <input type="hidden" id="productid12" value="12">
                     <input type="hidden" id="image12" value="/assets/images/D2-Lamp.jpg">
                     <input type="hidden" id="name12" value="D2 Lamp">
                     <input type="hidden" id="price12" value="10">
                     <input type="hidden" id="qnt12" value="1">
                     <button type="button" class="btn btn-sm btn-danger" onclick="addtocart('12');">Add to cart</button>
                  </div>
               </div> -->
            </div>
         </div>
      </section>
      <!-- end product section -->
      <!-- end subscribe section -->

<script type='text/javascript'>
 
 
   function addtocart(id){
    var productid = $('#productid'+id).val();
    var image = $('#image'+id).val();
    var name = $('#name'+id).val();
    var price = $('#price'+id).val();
    var qnt = $('#qnt'+id).val();
    $.ajax({
     url:'<?=base_url()?>addcard',
     method: 'post',
     data: {productid: productid,image:image,name:name,price:price,qnt:qnt},
     success: function(response){
         if(response==1)
         {
           $('#cart_success').html('<div class="alert alert-success" role="alert">Product Add To cart Successfully ..</div>')
           setInterval(function () {$('#cart_success').hide()}, 1000); 
           total_cart();
         }

     }
   });
  }
 </script>
        
       <?php include 'footer.php';?> 
</body>

</html>