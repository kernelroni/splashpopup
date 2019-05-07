
<div class="wrap">
 
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 
 
 <div class="welcome-panel">
	<form method="POST" action="?page=SplashPopup">
		
	<table id="form-table striped">
	<thead>

	</thead>
	<tbody id="the-list">

	<tr>
		<td class="left">
			<h3> Check and Active </h3>
		</td>
		
		<td>
			<input type="checkbox" name="splashinfo[is_active]" value="1" <?php echo $is_active == 1 ? "checked" : ""; ?> />
		</td>
	</tr>
	
	
	<tr>
		<td class="left">
			Image
		</td>
		
		<td>
			<input type="text" name="splashinfo[image]" id="splashimageinput" value="<?php echo $image ;?>" class="regular-text" />
			<input type="button" id="splashSelectImage" value="Select Image" class="button button-info" />
		</td>
	</tr>	
	
	<tr>
		<td class="left">
			Start Date Time
		</td>
		
		<td>
			<input type="text" name="splashinfo[startdate]" id="startdate" class="datetime" value="<?php echo $startdate ;?>" class="regular-text"/>
			<select name="splashinfo[starthr]">
			<option value="0">Hr</option>
			<?php
			for($i = 1; $i<=24; ++$i){ ?>
			
			<option value="<?php echo $i; ?>" <?php echo $starthr == $i ? " selected" : "" ?>><?php echo $i; ?></option>
			<?php } ?>
			
			</select>
			<select name="splashinfo[startmin]">
			<option value="0">Min</option>
			<?php
			for($i = 1; $i<=59; ++$i){ ?>
			
			<option value="<?php echo $i; ?>" <?php echo $startmin == $i ? " selected" : "" ?>><?php echo $i; ?></option>
			<?php } ?>
			
			</select>
			
			
		</td>
	</tr>	
	
	<tr>
		<td class="left">
			End Date Time
		</td>
		
		<td>
			<input type="text" name="splashinfo[enddate]" id="enddate" class="datetime" value="<?php echo $enddate ;?>"/>
			<select name="splashinfo[endhr]">
			<option value="0">Hr</option>
			<?php
			for($i = 1; $i<=24; ++$i){ ?>
			
			<option value="<?php echo $i; ?>" <?php echo $endhr == $i ? " selected" : "" ?>><?php echo $i; ?></option>
			<?php } ?>
			
			</select>
			<select name="splashinfo[endmin]">
			<option value="0">Min</option>
			<?php
			for($i = 1; $i<=59; ++$i){ ?>
			
			<option value="<?php echo $i; ?>" <?php echo $endmin == $i ? " selected" : "" ?>><?php echo $i; ?></option>
			<?php } ?>
			
			</select>
		</td>
	</tr>	
	
	<tr>
		<td class="left">
			Time Zone
		</td>
		
		<td>
			<input type="text" name="splashinfo[timezone]" id="splashtimezone" value="<?php echo $timezone ;?>" class="regular-text" placeholder="Asia/Dhaka" />
			<small> see timezone <a href="https://www.php.net/manual/en/timezones.php" target="_blank" /> PHP Timezone </a> Default : Asia/Dhaka </small>
		</td>
	</tr>	
	
	<tr>
		<td class="left">
			
		</td>
		
		<td>
			<input type="submit" value="Save" class="button button-primary button-hero" />
		</td>
	</tr>		
	
	
	
	</tbody>
</table>

</form>
</div>

<div class="welcome-panel" style="">

<div id="splashimage">
<img src="<?php echo $image; ?>" />
</div>


</div>




 
</div><!-- .wrap -->