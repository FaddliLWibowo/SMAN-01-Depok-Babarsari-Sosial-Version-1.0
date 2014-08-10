/****************************
	AJAX UNTUK SISWA
	*****************************/
	function searchuser(){
	//SEARCH WHEN SEND MESSAGE
	$('#loader').show();//SHOW LOADING
	var iduser = $('#txtsearchuser').val();//LOAD ID USER ON INPUT TEXT
	$.ajax({
		type:"GET",
		url:"http://localhost/2014-Project/SMAN01DEPOK-SOCIAL/index.php/all/search_user",
		data:"iduser="+iduser,
		success:function(result){
			$('#resultuser').html(result);//RESULT USER
			$('#loader').hide();//HIDE LOADING
			$('#resultuser').show();//RESULT USER
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
		url:"http://localhost/2014-Project/SMAN01DEPOK-SOCIAL/index.php/all/isi_pesan_saya",
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
		url:"http://localhost/2014-Project/SMAN01DEPOK-SOCIAL/index.php/all/kirim_pesan_via_modal",
		data:{isi:isi,pengirim:x,penerima:y},
		success:function(){ //SUCCESS
			$.ajax({ //REFRESH THREAD
			type:"GET",
			url:"http://localhost/2014-Project/SMAN01DEPOK-SOCIAL/index.php/all/isi_pesan_saya",
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