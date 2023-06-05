function toastr(alert,msg) {
	var inner = '<div class="toastr alert alert-'+alert+'" id="toastr"><div class="row"><div class="exit col-2"><i onclick="hidetoastd();" class="fas fa-window-close"></i></div><div class="content col-10"><span>'+msg+'</span></div></div></div>';
	$("#body").append(inner);
	setTimeout(function() {
	    $('#toastr').hide('fast');
	}, 4000); 
}

function hidetoastd() {
	$('#toastr').hide('fast');
}


