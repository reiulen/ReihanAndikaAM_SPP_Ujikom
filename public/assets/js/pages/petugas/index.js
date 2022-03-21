$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'),
    }
});

const formKelas = $('#form-kelas');
formKelas.hide();
$('.form-tambah').click(function(){
   formKelas.show('slow');
});

$('.btn-cancel').click(function(e){
    formKelas.hide('slow');
});

var table = $('#table').DataTable({
    serverSide:true,
    ajax  :{
        url: `${url}/api/petugas/${log}`,
        method : "POST"
    },
    columns : [
        {
            data: "id_petugas",
            name: "id_petugas",
        },
        {
            data: "nama_petugas",
            name: "nama_petugas",
        },
        {
            data: "username",
            name: "username",
        },
        {
            data: "level",
            name: "level",
        },
        {
            data: "aksi",
            name: "aksi",
        },
    ]
});


table.on('click', '.btnhapus', function(){
    const urlhapus = $(this).data('id');
    const nama = $(this).data('nama');
    Swal.fire({
      title: "Apakah yakin?",
      text: `Data petugas ${nama} akan dihapus`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#6492b8da",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${url}/petugas/${urlhapus}`,
                success: function(res){
                    Swal.fire(
                        `Berhasil dihapus`,
                        `Data petugas ${nama} berhasil dihapus`,
                        'success'
                    );
                    table.draw();
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
