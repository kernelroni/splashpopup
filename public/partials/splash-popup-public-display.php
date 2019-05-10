<?php if($image) { 

$durationinSec = intval($duration) * 1000;
if(intval($duration) <= 0){
	$duration = 30;
	$durationinSec = $duration * 1000;
}

?>
<div id="splashModalaml" class="splashModal">
	<div class="splashModal-inner">
		<a href="javascript:void(0);" title="Close" class="splashModal-close">X</a>
		<img src="<?php echo $image ; ?>" />
	</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function(){
		
		jQuery(this).click(function(){
		
		jQuery("#splashModalaml").remove();
		
		});
		
		// hide / remove the popup after 30 second
		setTimeout(function(){
			jQuery("#splashModalaml").remove();			
		},<?php echo $durationinSec ; ?>);
		
	});

</script>

<?php } ?>