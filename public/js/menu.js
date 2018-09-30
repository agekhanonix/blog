// For the thumbnail demo! :]

var count = 1
setTimeout(menu, 500)
setTimeout(menu, 700)
setTimeout(menu, 900)
setTimeout(reset, 2000)

setTimeout(menu, 2500)
setTimeout(menu, 2750)
setTimeout(menu, 3050)


var mousein = false
function menu() {
   if(mousein) return
   document.getElementById('menu' + count++)
      .classList.toggle('hover')
   
}

function menu2() {
   if(mousein) return
   document.getElementById('menu2')
      .classList.toggle('hover')
}

function reset() {
   count = 1
   var hovers = document.querySelectorAll('.hover')
   for(var i = 0; i < hovers.length; i++ ) {
      hovers[i].classList.remove('hover')
   }
}

document.addEventListener('mouseover', function() {
   mousein = true
   reset()
})