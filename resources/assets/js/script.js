// Ajax request to ensure reload of pages does not loose 
// data during barcode scanning due to pages refresh

document.getElementsByClassName('trackClass')[0].addEventListener('submit', function(e) {
 e.preventDefault();
 
 var data = new FormData(e.currentTarget);
 e.currentTarget.reset();
 var request = new XMLHttpRequest();
 request.addEventListener('load', function() {
  //done
 });
 request.open(e.currentTarget.method, e.currentTarget.action);
 request.send(data);
});


