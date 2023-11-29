const header = document.querySelector('header');
const back_to_top = document.querySelector('.back-to-top');

function start(){
    scrollScreen();
    backToTop();
}

function scrollScreen(){
    window.addEventListener('scroll', (e)=>{
        if(window.scrollY > 120){
            back_to_top.style.bottom = '10px';
        }else{
            back_to_top.style.bottom = '-50px';
        }
    })
};

function backToTop(){
    back_to_top.onclick = ()=>{
        document.documentElement.scrollTop = 0;
    }
};

start();