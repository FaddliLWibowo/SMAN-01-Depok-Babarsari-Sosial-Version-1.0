/****************************
AJAX UNTUK SISWA
*****************************/
function searchuser(){
//SEARCH WHEN SEND MESSAGE
$('#loader').show();//SHOW LOADING
var iduser = $('#txtsearchuser').val();//LOAD ID USER ON INPUT TEXT
$.ajax({
	type:"GET",
	url:"http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/search_user",
	data:"iduser="+iduser,
	success:function(result){
		$('#resultuser').html(result);//RESULT USER
		$('#loader').hide();//HIDE LOADING
		$('#resultuser').show();//RESULT USER
	}
});
}
/////////// SHOW LATTEST STATUS
function lattestStatus(){
//alert('work');
$('#top-loader').show();//SHOW LOADING
$.ajax({
	url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/json/start_status',
	dataType:'json',
	timeout: 50000,//50000MS
	success:function(data){
		timeline ='';
		$.each(data['result'], function(i,n){
			timeline = '<div class=\'timeline\'>'+
			'<div name=\''+n['id']+'\' class=\'row name\'>'+
			'<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' /><button onclick="deleteMyStatus()" class=\'btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
			'<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
			'</div>'+     
			'</div>'+
			'<div class=\'row\'>'+
			'<div class=\'col-md-12\'>'+
			'<p>'+n['content']+'</p>'+
			'<p>'+
			'<button onclick="addlike('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'> '+n['like']+' </span>'+
			
			'<button onclick=\'getCommentById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
			'</p>'+
			'</div>'+
			'</div>'+			
			'<div class=\'container\'>'+
			'<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'

			+'</div>'+//END OF #COMMENTS
			'<div class=\'comment row\'>'+
			'<div class=\'col-md-2\'><img class="myavatar" /></div>'+
			'<div class=\'col-md-10\'>'+
			'<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
			'</div>'+
			'</div>'+
			'</div>'+
			'</div>';
			timeline = timeline+'';
			$('#all-timeline').append(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
			$('#top-loader').hide();
		});
		$('#btn-more').show();//show btn to more status
	},
	error: function(){
		alert('Terjadi masalah');
		$('#top-loader').hide();
	}
});

}

/////////////////SHOW UPDATED STATUS
function showUpdatedStatus(){
$('#top-loader').show();//SHOW LOADING
lastid = $('#all-timeline .timeline div').first().attr('name');//GET ELEMENT NAME
$.ajax({
	url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/json/start_status?lastid='+lastid,
	dataType:'json',
	timeout: 50000,//50000MS
	success:function(data){
		timeline ='';
		$.each(data['result'], function(i,n){
			timeline = '<div class=\'timeline\'>'+
			'<div name=\''+n['id']+'\' class=\'row name\'>'+
			'<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' /><button  class=\'btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
			'<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
			'</div>'+     
			'</div>'+
			'<div class=\'row\'>'+
			'<div class=\'col-md-12\'>'+
			'<p>'+n['content']+'</p>'+
			'<p>'+
			'<button onclick="addlike('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'>'+n['like']+'</span>'+
			
			'<button onclick=\'getCommentById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
			'</p>'+
			'</div>'+
			'</div>'+
			'<div class=\'container\'>'+
			'<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'+
			
			'</div>'+//END #COMMENTS 
			'<div class=\'comment row\'>'+
			'<div class=\'col-md-2\'><img class="myavatar" /></div>'+
			'<div class=\'col-md-10\'>'+
			'<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
			'</div>'+
			'</div>'+
			'</div>'+
			'</div>';
			timeline = timeline+'';
		$('#all-timeline').prepend(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
	});
},
error: function(){
		//alert('Terjadi masalah');
	}
});
	$('#top-loader').hide();//SHOW LOADING
}

/////////////////SHOW MORE STATUS
function showMoreStatus(){
$('#bottom-loader').show();//SHOW LOADING
var id = $('#all-timeline .timeline .name').last().attr('name');//GET ELEMENT NAME
//alert(id);
$.ajax({
	url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/json/start_status?smallid='+id,
	dataType:'json',
	timeout: 50000,//50000MS
	success:function(data){
		timeline ='';
		$.each(data['result'], function(i,n){
			timeline = '<div class=\'timeline\'>'+
			'<div name=\''+n['id']+'\' class=\'row name\'>'+
			'<div class=\'col-md-12\'><img src=\''+n['avatar']+'\' /><button onclick="deleteMyStatus()" class=\'btn btn-xs btn-default\' style=\'float:right;top:0\'>x</button>'+
			'<h5><a href=\''+n['profile']+'\'><strong>'+n['name']+'</strong></a> > <a href=\''+n['des_profile']+'\'><strong>'+n['des_name']+'</strong></a></h5><h6>'+n['time']+'</h6>'+
			'</div>'+     
			'</div>'+
			'<div class=\'row\'>'+
			'<div class=\'col-md-12\'>'+
			'<p>'+n['content']+'</p>'+
			'<p>'+
			'<button onclick="addlike('+n['id']+')" class=\'btn btn-xs btn-default\'><span class=\'glyphicon glyphicon-thumbs-up\'></span> </button> <span class="'+n['id']+'" style=\'font-size:10px\'>'+n['like']+'</span>'+
			
			'<button onclick=\'getCommentById('+n['id']+')\' class="btn btn-default btn-xs"> Lihat Komentar</button>'+
			'</p>'+
			'</div>'+
			'</div>'+
			'<div class=\'container\'>'+
			'<div class="comments'+n['id']+'" name=\''+n['id']+'\'>'+			
			'</div>'+//end of #comments
			'<div class=\'comment row\'>'+
			'<div class=\'col-md-2\'><img class="myavatar" /></div>'+
			'<div class=\'col-md-10\'>'+
			'<div class="input-group"><textarea id="writecomment'+n['id']+'" class=\'form-control\' id=\'comment\' placeholder=\'your comment...\'></textarea><span class="input-group-btn"><button class="btn btn-default" onclick="writecomment('+n['id']+')"><span class="glyphicon glyphicon-play"></span></button></span></div>'+
			'</div>'+
			'</div>'+
			'</div>'+
			'</div>';
			timeline = timeline+'';
		$('#all-timeline').append(timeline);//ADD NEW TO BOTTOM prepend() //TO TOP
	});
},
error: function(){
	alert('Tidak ada lagi status');
}
});
$('#bottom-loader').hide();//SHOW LOADING
}

/////////////////UPDATE STATUS
function updateStatus(x,y,z,a,b,c){ //X= ID_SISWA,y = ID_GURU,Z = ID_GRUP | a = DES_ID_SISWA,b = DES_ID_GURU,c=DES_ID_GRUP  
	$('#top-loader').show();//SHOW LOADING
	var isi = $('#newpost').val();//GET STATUS FROM TEXAREA
	if(isi == ''){//NOT FILL UP STATUS = ALERT + REFRESH PAGE
		alert('Status Harus Diisi');
		$('#top-loader').hide();//SHOW LOADING	
	} else {
		$.ajax({
			type:'POST',
			url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/update_status',
		timeout: 50000,//50000MS
		data:{idsiswa:x,idguru:y,idgrup:z,isi:isi,desidsiswa:a,desidguru:b,desidgrup:c},
		success:function(data){ //SUCCESS INSERT TO DB
			showUpdatedStatus();
		},
		error:function(data){
			alert('ERROR'+data);
		}
	});
                //$('#newpost').val() = '';//EMPTY STATUS TEXTAREA
		$('#top-loader').hide();//SHOW LOADING
		$('#newpost').val() = ' ';
	}

}

//DELETE MY STATUS
function deleteMyStatus(){
	var status = confirm('Anda Yakin');
}

/*
* AJAX FOR COMMENTS
*/
//BUTTON SHOW COMMENTS CLICKED
function getCommentById(x){ //COMMENT BY ID STATUS	
	$.ajax({ //x=id_status		
		type:'GET',
		dataType:'json',
		url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/json/show_comment_by_id?id='+x,
		timeout: 50000,//50000MS
		success:function(data){ //SUCCESS INSERT TO DB			
			//alert(x);
			$('.comments'+x).html('<div></div>');
			$.each(data['result'], function(i,n){//LOPPING COMMENTS
				comment = '<div class=\'comment row\'>'+
				'<div class=\'col-md-2\'>'+            
				'<img src=\''+n['avatar']+'\' />'+
				'</div>'+
				'<div class=\'col-md-10\'>'+
				'<p><span><strong><a href=\'#\'>'+n['name']+'</a></strong> '+n['isi']+'</p>'+
				'<h6>'+n['waktu']+'</h6>'+
				'</div>'+
				'</div>';
				comment = comment+'';
				$('.comments'+x).append(comment);							
			});								
		},
		error:function(){
			alert('Tidak ada komentar');
		}
	});
}

function addlike(x){ //x id status
	like = $('.'+x).html();
	newlike = parseInt(like);//convert to INT
	newlike = newlike + 1;
	//ajax to insert DB
	$.ajax({
		url:'http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/addlike?idpost='+x,
		success:function(){
			$('.'+x).html();
			$('.'+x).html(newlike);
		},
		error:function(){
			alert('error add like');			
		}
	});	
}

/*****************************
AJAX UNTUK SEMUA
******************************/
function showmessage(x,y){
	//SHOW MESSAGE BY USER x= pengirim , y = penerima
	//$('#pengirim').html(x);
	$('#isithread').modal('show');
	$('#loader').show();
	$.ajax({
		type:"GET",
		url:"http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/isi_pesan_saya",
		data:{pengirim:x,penerima:y},
		success:function(result){
			$('#loader').hide();//HIDE LOADING
			$('#isipesan').html(result);			
			$('#isipesan').show();
		}
	});
}

function sendmessageviamodal(x,y){ //x=pengirim, y=penerima
	$('#loader').show();//LOADING
	//GET THE DATA
	var isi = $('#isibalasan').val();
	//KIRIM PESAN KE SERVER
	$.ajax({
		type:"POST",
		url:"http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/kirim_pesan_via_modal",
		data:{isi:isi,pengirim:x,penerima:y},
		success:function(){ //SUCCESS
			$.ajax({ //REFRESH THREAD
				type:"GET",
				url:"http://localhost/2014-Project/SMAN01DEPOKBABARSARI-SOCIAL/index.php/all/isi_pesan_saya",
				data:{pengirim:y,penerima:x},
				success:function(result){
				$('#loader').hide();//HIDE LOADING
				$('#isipesan').html(result);			
				$('#isipesan').show();
			}
		});
		}
	});
}