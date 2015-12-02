document.getElementsByClassName('trackClass')[0].addEventListener('submit', function(e) {
 e.preventDefault();
 
 var data = new FormData(e.currentTarget);
 e.currentTarget.reset();
 var request = new XMLHttpRequest();

 request.addEventListener('load', function() {
  //done
 });
 request.open(e.currentTarget.method, e.currentTarget.action);
 request.setRequestHeader('x-requested-with', 'xmlhttprequest');
 request.setRequestHeader('Accept', 'application/json');
 request.send(data);
});


