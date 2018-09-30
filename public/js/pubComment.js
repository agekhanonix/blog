
    tabs = document.querySelectorAll('.tabs-content');
    for(var i=0; i<tabs.length; i++){
        tabs[i].style.display = (i>0) ? 'none' : 'block';
        elMt = document.getElementById('tab-container' + (i+1));
        elMt.addEventListener('click', function(e){
            var elMenu = e.target.id;
            for(var j=0; j<tabs.length; j++) {
                tabs[j].style.display = 'none';
            }
            elTab = document.getElementById('tab-content' + elMenu.substring(elMenu.length -1, elMenu.length));
            elTab.style.display = 'block';
        });
    }