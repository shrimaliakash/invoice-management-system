
<?php if( isset( $_SESSION['error']) && !empty( $_SESSION['error'] )){ ?>
<div class="row">
	<div class="col-sm-12">
		<div class="message_error message_div" style="margin-bottom: 10px">
			<p class="text-center"> <?php echo $_SESSION['error']; ?>  </p>
		</div>
	</div>
</div>	

	
<?php $s = 1;  ?>
<?php unset($_SESSION['error']); }elseif ( isset( $_SESSION['success']) && !empty( $_SESSION['success'] )){ ?>
<?php //print_r( $_SESSION );exit; ?>
<div class="row">
	<div class="col-sm-12">
		<div class="text-center message_success message_div" style="margin-bottom: 10px">
			<p class="text-center"> <?php echo $_SESSION['success']; ?> </p>
		</div>
	</div>
</div>
	
<?php $s = 1; ?>
<?php unset($_SESSION['success']); }else{
	$s =0;
} ?>




<?php if($s){ $s = 0; ?>
	<script>
		var errorFlag = true;
    </script>
<?php } ?>
