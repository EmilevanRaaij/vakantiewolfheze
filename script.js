var up = false;
function res_popup(i){
    card = document.getElementById('res-card');
    if(i == 1){//toggle
        if(picker1.getStartDate() !== null){
            picker2.setDateRange(picker1.getStartDate(), picker1.getEndDate());
        }
        picker1.clearSelection();
        if(up == false){
            card.style.transition = "all 0.5s";
            card.style.transform = "translate(0px, 0px)";
            up = true; 
        }else{
            card.style.transition = "all 0.5s";
            card.style.transform = "translate(0px, 85%)";
            up = false;
        }
    }else if(i == 2){//hover up
        if(up == false){
            card.style.transition = "all 0.2s";
            card.style.transform = "translate(0px, 83%)";
            up = false;
        }
    }else if(i == 3){//hover down
        if(up == false){
            card.style.transition = "all 0.2s";
            card.style.transform = "translate(0px, 85%)";
            up = false;
        }
    }
}

function reviewToggle(){
    list = document.getElementsByClassName('hidrev');
    btn = document.getElementById('reviewbtn');
    for (var i = 0; i < list.length; i++) {
        list[i].classList.toggle('hidden-review');
    }
    if(window.location.pathname.substring(window.location.pathname.lastIndexOf('/')+1) === 'en.php'){
        if(reviewbtn.innerHTML == 'Read more'){
            reviewbtn.innerHTML = 'Read less';
        }else{
            reviewbtn.innerHTML = 'Read more';
        }
    }else{
        if(reviewbtn.innerHTML == 'Lees meer'){
            reviewbtn.innerHTML = 'Lees minder';
        }else{
            reviewbtn.innerHTML = 'Lees meer';
        }
    }
}

const res_up_btn = document.getElementById('reservation-up-button');
res_up_btn.addEventListener("mouseenter", function(){
    res_popup(2);
});
res_up_btn.addEventListener("mouseleave", function(){
    res_popup(3);
});

function bookingModalToggle(n){
    modal = document.getElementById('bookingmodal');
    if(n == 0){//close modal
        modal.style.visibility = "hidden";
    }else if(n == 1){//open modal
        if(picker2.getStartDate() != null){
            picker3.setDateRange(picker2.getStartDate(), picker2.getEndDate());
            modal.style.visibility = "initial";
            res_popup(1);
        }
    }
}

function toggleActivity(index){
    if(index == 0){
        toggleButton = document.getElementById('restaurants-btn');
        activityList = document.getElementById('restaurants-list');
    }else if(index == 1){
        toggleButton = document.getElementById('steden-btn');
        activityList = document.getElementById('steden-list');
    }else if(index == 2){
        toggleButton = document.getElementById('musea-btn');
        activityList = document.getElementById('musea-list');
    }else if(index == 3){
        toggleButton = document.getElementById('natuur-btn');
        activityList = document.getElementById('natuur-list');
    }
    
    if(window.getComputedStyle(activityList).display === "none"){
        activityList.style.display = 'block';
        if(window.location.pathname.substring(window.location.pathname.lastIndexOf('/')+1) === 'en.php'){
            toggleButton.innerHTML = 'Read less';
        }else{
            toggleButton.innerHTML = 'Lees minder';
        }
        activityList.style.backgroundColor = "#c7c7c7";
    }else{
        activityList.style.display = 'none';
        if(window.location.pathname.substring(window.location.pathname.lastIndexOf('/')+1) === 'en.php'){
            toggleButton.innerHTML = 'Read more';
        }else{
            toggleButton.innerHTML = 'Lees meer';
        }
    }
}

var index = 0;
const amount = galleryarray.length;
function galleryToggle(imageid){
    modal = document.getElementById('gallerymodal');
    img = document.getElementById('galleryimg');
    if(imageid == -3){//close modal
        modal.style.visibility = "hidden";
    }else if(imageid == -1 || imageid == -2){
        if(imageid == -1){//left
            index = index - 1;
            if(index < 0){//loop to last image
                img.src = galleryarray[amount - 1];
                index = amount
            }else{
                img.src = galleryarray[index];
            }
        }else{//right
            index = index + 1;
            if(index >= amount){//loop to first image
                img.src = galleryarray[0];
                index = 1; 
            }else{
                img.src = galleryarray[index];
            }
        }
    }else{//open modal
        modal.style.visibility = "initial";
        img.src = galleryarray[imageid];
        index = imageid;
    }
}

window.onscroll = function() {myFunction()};
var nav = document.getElementById('Nav');
function myFunction() {
    nav.style.transition = "all 0.25s";
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        nav.classList.add('navigation_black');
        nav.classList.remove('navigation_clear');
    } else {
        nav.classList.add('navigation_clear');
        nav.classList.remove('navigation_black');
  }
}

window.onkeyup = function(e){
    if(e.which == 27){
        galleryToggle(-3);
        bookingModalToggle(0);
    }else if(e.which == 37){
        galleryToggle(-1);
    }else if(e.which == 39){
        galleryToggle(-2)
    }
}