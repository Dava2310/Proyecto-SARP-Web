var btn = document.querySelector('.btn');
var box = document.querySelector('.box')
btn.addEventListener('click', function(){
  box.style.width = ( 100 + Math.round(Math.random()*300) ) + 'px';
  box.style.height = ( 100 + Math.round(Math.random()*300) ) + 'px';
});