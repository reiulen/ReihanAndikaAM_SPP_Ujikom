$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'),
    }
});

var table = $('#table').DataTable({
    serverSide:true,
    ajax  :{
        url: `${url}/api/spp`,
        method : "POST"
    },
    columns : [
        {
            data: "id_spp",
            name: "id_spp",
        },
        {
            data: "tahun",
            name: "tahun",
        },
        {
            data: "nominal",
            name: "nominal",
        },
        {
            data: "aksi",
            name: "aksi",
        },
    ]
});

const form = $('form');
const formKelas = $('#form-kelas');

$('.btn-cancel').click(function(e){
    form.trigger('reset');
    e.preventDefault();
    formKelas.slideUp();
});


$('.form-tambah').click(function(e){
    e.preventDefault();
    form.trigger('reset');
    formKelas.slideDown();
});

table.on('click', '.btn-edit', function(e){
    e.preventDefault();
    const idedit = $(this).data('id');
    $('input[name="id"]').val(idedit);
    $.getJSON(`${url}/spp/${idedit}/edit`, function(res){
        $("input[name='id_spp']").val(res.id_spp);
        $("input[name='tahun']").val(res.tahun);
        $("input[name='nominal']").val(res.nominal);
    });
    formKelas.slideDown();
});

form.submit(function(e){
    e.preventDefault();
    $.ajax({
        url: `${url}/spp/tambah`,
        method: $(this).attr('method'),
        data : $(this).serialize(),
        success: function(res){
            if(res.error){
                $('#alert').
                html("<div class='alert alert-primary alert-dismissible fade show' role='alert'>"+
                    res.error.kelas +"</br>"+
                    res.error.kompetensi_keahlian +"</br>"
                    +"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
                    "<span aria-hidden='true'>&times;</span>"+
                    "</button></div>"
                )
            }else{
                form.trigger('reset');
                table.draw();
                formKelas.slideUp();
                Swal.fire(
                    'Berhasil disimpan',
                    res,
                    'success'
                );
            }

        },
        error: function(res){
            Swal.fire(
                'Gagal',
                res.responseJSON.message,
                'error'
            );
        }
    });
});


table.on('click', '.btnhapus', function(e){
    e.preventDefault();
    const urlhapus = $(this).data('id');
    const nama = $(this).attr('data-nama');
    Swal.fire({
      title: "Apakah yakin?",
      text: `SPP ${nama} akan dihapus`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#6492b8da",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${url}/spp/${urlhapus}`,
                method: "post",
                success: function(res){
                    table.draw();
                    Swal.fire(
                        `Berhasil dihapus`,
                        res.pesan,
                        'success'
                    );
                },
                error: function(res){
                    console.log(res)
                    Swal.fire(
                        `Gagal`,
                        `${res.responseJSON.message}`,
                        'error'
                    );
                }
            })
        }
    });
});

const DOMstrings = {
    inputTahun: document.querySelector("input[name='tahun']"),
    inputUang : document.querySelector("input[name='nominal']")
};
Inputmask({ alias: "datetime", inputFormat: "yyyy" }).mask(
    DOMstrings.inputTahun
);
var rupiah = DOMstrings.inputUang;
    rupiah.addEventListener("keyup", function (e) {
    rupiah.value = formatRupiah(this.value, "Rp. ");
});
/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
// tambahkan titik jika yang di input sudah menjadi angka ribuan
if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
}
rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}


