const batsukien = document.getElementById('algorithm');
const titleElement = document.getElementById('title');

titleElement.textContent = 'Công cụ mã hóa và giải mã';


batsukien.addEventListener('change', function(e){
    if(e.target.value === 'AES'){
        titleElement.textContent = 'Thuật toán mã hóa và giải mã bằng AES';
    }
    else if(e.target.value === 'RSA'){
        titleElement.textContent = 'Thuật toán mã hóa và giải mã bằng RSA';
    }
    else if(e.target.value === 'None'){
        titleElement.textContent = 'Công cụ mã hóa và giải mã';
    }
})

