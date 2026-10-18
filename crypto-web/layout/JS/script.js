const batsukien = document.getElementById('algorithm');
const titleElement = document.getElementById('title');
const khungNhapKhoa = document.getElementById('keyInput');
const nhapKhoaLabel = document.getElementById('keyLabel');
function capNhatGiaoDien() {
    const giaTriChon = batsukien.value;

    if (giaTriChon === 'RSA') {
        titleElement.textContent = 'Thuật toán mã hóa và giải mã bằng RSA';
        khungNhapKhoa.style.display = 'none'; 
        nhapKhoaLabel.style.display = 'none'; 
    } 
    else if (giaTriChon === 'AES') {
        titleElement.textContent = 'Thuật toán mã hóa và giải mã bằng AES';
        khungNhapKhoa.style.display = 'block'; 
        nhapKhoaLabel.style.display = 'block'; 
    } 
    else {
        titleElement.textContent = 'Công cụ mã hóa và giải mã';
        khungNhapKhoa.style.display = 'block'; 
        nhapKhoaLabel.style.display = 'block';
    }
}
batsukien.addEventListener('change', capNhatGiaoDien);
capNhatGiaoDien();
