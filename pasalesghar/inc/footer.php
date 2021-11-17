<?php  
if(getCurrentPage()!= 'index'){

 ?>
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_VENDORS_URL;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo ADMIN_VENDORS_URL;?>fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo ADMIN_VENDORS_URL;?>nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_JS_URL;?>custom.min.js"></script>

    <?php }    ?>


    <?php 

if(isset($scripts) && !empty($scripts)){
    echo $scripts;
}
     ?>

<script type="text/javascript">
    

setTimeout(function(){
    $('.alert').slideUp('slow');
}, 3000);


</script>


  </body>
</html>