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


$(".groupinfo").on( "click", function() {
	var id = $( this ).attr("val");
	
	$('#groupmodal').html('<div class="d-flex justify-content-center"><div class="spinner-grow spinner-grow-md" role="status"><span class="sr-only">Loading...</span></div></div>');

	$.ajax({
	   type:'GET',
	   url:'./group/info/' + id,
	   success:function(data) {
	   		$('#groupmodal').html(data);
	   }
	});
});


$("#search").keyup(function(){
	var id=$(this).attr('val');
	var value=$(this).val();
	$.ajax({
	type : 'get',
	url : '../../ajax/search' + id,
	data:{'search':value},
	success:function(data){
		$('#tezt').html(data);
		}
	});
});


$("#searchuser").keyup(function(){
	var value=$(this).val();
	$.ajax({
	type : 'get',
	url : '../ajax/user/search',
	data:{'search':value},
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
		$(".custom-file-uploaded").append("<p>- " + files[i].name +"</p>");
	}
});

/*
$('.multi-option').mousedown(function(e) {
});
*/

$(document).on('mousedown', '.multi-option', function(e){
    e.preventDefault();
    $(this).prop('selected', !$(this).prop('selected'));
});


$(document).on( "click", ".usertogroup" ,function() {
	var uid = $( this ).attr("val");
	
	$.ajax({
	   	type:'GET',
	   	url: window.location.href + '/' +uid,
	   	success:function(data) {
	   		$("#userstoadd").load( location.href+" #userstoadd");
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

$(document).on("click", "#clearusers", function(){
	var id = $(this).attr('val');
	$.ajax({
	   	type:'GET',
	   	url: '../clear/' +id,
	   	success:function(data) {
	   		$("#userstoadd").load( location.href+" #userstoadd");
	   }
	});
});

$(document).on("click", "#changeuser", function(e){
	e.preventDefault();
	$('#searchuser').show();
	$('#tezt').show();
	$(this).hide();
});

$(document).on("click",".show_message" ,function(){
	var val = $(this).attr('val');
	var type = $(this).attr('type');
	$.ajax({
	   	type:'GET',
	   	url: './message/read/'+ type +'/'+val,
	   	success:function(data) {
	   }
	});
	$('#message_content'+type+'_'+val).removeClass('d-none');
	$('#message_content'+type+'_'+val).toggle();
});

$(".recieved").on("click", function(){
	var val = $(this).attr('val');
	$.ajax({
	   	type:'GET',
	   	url: './message/x/'+val,
	   	success:function(data) {
	   		$("#messagebox").html(data);
			if(val==1)
				$("#messagebox").prepend("<br><h5>Odebrane</h5>");
			else if(val==2)
				$("#messagebox").prepend("<br><h5>Wysłane</h5>");
			else if(val==3)
				$("#messagebox").prepend("<br><h5>Nieodczytane</h5>");

	   }
	});
});



$(document).on("click",'.uinfo',function(){
	$('#userinfo').html('<div class="d-flex justify-content-center"><div class="spinner-grow spinner-grow-md" role="status"><span class="sr-only">Loading...</span></div></div>');
	var id = $(this).attr('val')
	$.ajax({
	   	type:'GET',
	   	url: './userinfo/'+id,
	   	success:function(data) {
	   		$("#userinfo").html(data);
	   }
	});
});



$('#filterusers').on("click", function(){
	var value=$('#suser').val();
	var id = $('#userslist').val();
	$.ajax({
	type : 'get',
	url : 'users/x/' + id ,
	data:{'search':value},
	success:function(data){
		$('#usersbox').html(data);
		}
	});
});

$('#filterposts').on("click", function(){
	var id=$('#filtercond').val();
	var datefrom = $('#filterdate_from').val();
	var dateto = $('#filterdate_to').val();
	$.ajax({
	type : 'get',
	url : 'post/filter/' + id ,
	data: {'datefrom': datefrom, 'dateto':dateto},
	success:function(data){
		$('#posts').html(data);
		readpost();
		}
	});
});

$('#filterposts_show').click(function(){
	$('#filterposts_box').toggle(500);
});

$(document).ready(readpost());
function readpost()
{
	$('.singlepost').each(function(index){
		var text = $(this).html();
		var lines = text.split("\n"); 
		if(lines.length>4)
		{
			var res = text.substr(0, 100);

			$(this).html('<div id="res'+ index + '">' + res + '</div>');
			$(this).append("<a id='more" + index + "'>...czytaj więcej</a>");
			$(document).on('click', '#more'+index, function(){
				$('#res' + index).html(text);
				$(this).remove();
				$('#res' + index).append("<p id='less" + index + "'>...czytaj mniej</p>");
			});
			$(document).on('click','#less'+index, function(){
				$('#res' + index).html(res);
				$(this).remove();
				$('#res' + index).append("<p id='more" + index + "'>...czytaj więcej</p>");
			});
		}
		else
			$(this).html(text);
	});
}
