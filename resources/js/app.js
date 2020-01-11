/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');


$(".xxx").on( "click", function() {
	var id = $( this ).attr("val");
	
	$('#test').html('<div class="d-flex justify-content-center"><div class="spinner-grow spinner-grow-md" role="status"><span class="sr-only">Loading...</span></div></div>');

	$.ajax({
	   type:'GET',
	   url:'./group/info/' + id,
	   success:function(data) {
	   		$('#test').html(data);
	   }
	});
});


$("#search").keyup(function(){
	$value=$(this).val();
	$.ajax({
	type : 'get',
	url : '../../ajax/search',
	data:{'search':$value},
	success:function(data){
		$('#tezt').html(data);
		}
	});
});


$("#searchuser").keyup(function(){
	$value=$(this).val();
	$.ajax({
	type : 'get',
	url : '../ajax/searchuser',
	data:{'search':$value},
	success:function(data){
		$('#tezt').html(data);
		}
	});
});


$(".custom-file-input").on("change", function() {
	var files = $(this)[0].files;
	$(".custom-file-uploaded").empty();
	$(".custom-file-uploaded").append("<h5><b><u>Załączone pliki:</u></b></h5>");
	$(this).siblings(".custom-file-label").html("Wybrane pliki: "+files.length);
	console.log(files.length);
	for(var i=0; i<files.length; i++)
	{
		console.log(files[i].name);
		$(".custom-file-uploaded").append("<p>- " + files[i].name +"</p>");
	}
});


$('.multi-option').mousedown(function(e) {
    e.preventDefault();
    $(this).prop('selected', !$(this).prop('selected'));
});



$(document).on( "click", ".zxc" ,function() {
	var uid = $( this ).attr("val");
	
	$.ajax({
	   	type:'GET',
	   	url: window.location.href + '/' +uid,
	   	success:function(data) {
	   		$("#x").load( location.href+" #x");

	   }
	});
});

$('#ypublic').click(function(){
	$("#selectgroup").hide();
});

$('#npublic').click(function(){
	$("#selectgroup").show();
});

$(document).on("click", ".adduser", function(){
	var uid = $(this).attr("val"); 
	$.ajax({
	   	type:'GET',
	   	url: './add/'+uid,
	   	success:function(data) {
	   		$("#user").load(location.href+" #user");

	   }
	});
	$('#searchuser').hide();
	$('#tezt').hide();
});

$(document).on("click", "#changeuser", function(e){
	e.preventDefault();
	$('#searchuser').show();
	$('#tezt').show();
	$(this).hide();
});

$(document).on("click",".show_message" ,function(){
	var val = $(this).attr('val');
	$.ajax({
	   	type:'GET',
	   	url: './message/read/'+val,
	   	success:function(data) {
	   }
	});
	$('#message_content'+val).removeClass('d-none');
	$('#message_content'+val).toggle();
});

$(".recieved").on("click", function(){
	var val = $(this).attr('val');
	$.ajax({
	   	type:'GET',
	   	url: './message/x/'+val,
	   	success:function(data) {
	   		$("#messagebox").html(data);

	   }
	});
});
