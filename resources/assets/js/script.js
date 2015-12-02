// Ajax request to ensure reload of pages does not loose 
// data during barcode scanning due to pages refresh

document.getElementsByClassName('trackClass')[0].addEventListener('submit', function(e) {
 e.preventDefault();
 
 var data = new FormData(e.currentTarget);
 e.currentTarget.reset();
 var request = new XMLHttpRequest();
 request.addEventListener('load', function(response) {
 	if (response.target.status === 422) {
 		 var json = JSON.parse(response.target.responseText);
 		 //json = JSON.stringify(json);
 		 document.getElementById('info').style.display = 'block';
 		 info.innerHTML= json.nhi_and_ward[0];
 		 //alert("myObject is " + json.toSource());

 	}
 	else {
 		document.getElementById('info').style.display = 'none';
 	}
 });
 request.open(e.currentTarget.method, e.currentTarget.action);
 request.setRequestHeader('x-requested-with', 'xmlhttprequest');
 request.setRequestHeader('Accept', 'application/json');
 request.send(data);
 
});


