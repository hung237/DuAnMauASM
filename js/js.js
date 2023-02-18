let list = document.querySelectorAll('.slide-item');
console.log(list);
document.getElementById('slide-next').onclick = function(){
    let list = document.querySelectorAll('.slide-item');
    document.getElementById('slide').appendChild(list[0]);
    console.log(list);
}
document.getElementById('slide-prev').onclick = function(){
    let list = document.querySelectorAll('.slide-item');
    document.getElementById('slide').prepend(list[list.length - 1]);
}

function login(){
    document.getElementById('form-register').style.display = 'none';
    document.getElementById('login').style.display = 'block';
    document.getElementById('form-login').style.display = 'block';

    
}
function close_login(){
    document.getElementById('form-login').style.display = 'none';
    document.getElementById('login').style.display = 'none';
}
function register(){
    document.getElementById('form-login').style.display = 'none';
    document.getElementById('login').style.display = 'block';
    document.getElementById('form-register').style.display = 'block';
}
function logout(){
    window.location="index.php";
};


function chooseFile(){
    var fileSelected = document.getElementById('imageFile').files;
    if(fileSelected.length > 0){
        var fileToLoad = fileSelected[0];
        var fileReader = new FileReader();
        fileReader.onload = function(fileLoaderEvent){
            var srcData = fileLoaderEvent.target.result;
            var newImage = document.getElementById('newAvt');
            newImage.src = srcData;
        }
        fileReader.readAsDataURL(fileToLoad);
    }

}

// window.addEventListener("scroll", function(){
//     var header = document.getElementById('header');
//     header.style.backgroundColor = "red";
//     if(window.scrollY == 0){
//         header.style.backgroundColor = "black";
//     }
// })