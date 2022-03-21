const pengelola = $('#pengelola');
const siswa = $('#siswa');
const btnsiswa = $('.btn-siswa');
const btnpengelola = $('.btn-pengelola')

pengelola.hide();

btnpengelola.click(function(){
    pengelola.show('slow');
    siswa.hide();
    btnsiswa.removeClass('active');
    btnpengelola.addClass('active');
});

btnsiswa.click(function(){
    siswa.show('slow');
    pengelola.hide();
    btnpengelola.removeClass('active');
    btnsiswa.addClass('active');
});
