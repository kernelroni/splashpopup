jQuery(document).ready(function(){
	
//alert("ready");

jQuery("#splashSelectImage").on( 'click', function( event ){
    var frame;
    event.preventDefault();
    
    // If the media frame already exists, reopen it.
    if ( frame ) {
      frame.open();
      return;
    }
    
    // Create a new media frame
    frame = wp.media({
      title: 'Select or Upload Media Of Your Chosen Persuasion',
      button: {
        text: 'Use this media'
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    
    // When an image is selected in the media frame...
    frame.on( 'select', function() {
      
      // Get media attachment details from the frame state
      var attachment = frame.state().get('selection').first().toJSON();

      // Send the attachment URL to our custom image input field.
      jQuery("#splashimage").html( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );

      // Send the attachment id to our hidden input
      jQuery("#splashimageinput").val( attachment.url );


    });

    // Finally, open the modal on click
    frame.open();
  });

  
	// date picker
	jQuery( ".datetime" ).datepicker({dateFormat : "yy-mm-dd"});
  
  
	
});