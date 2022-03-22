$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'),
    }
});

var table = $('#table').DataTable({
    serverSide:true,
    ajax  :{
        url: `${url}/api/kelas`,
        method : "POST"
    },
    columns : [
        {
            data: "nama_kelas",
            name: "nama_kelas",
        },
        {
            data: "kompetensi_keahlian",
            name: "kompetensi_keahlian",
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
    $.getJSON(`${url}/kelas/${idedit}/edit`, function(res){
        $('select[name="kelas"').val(res.nama_kelas);
        $('input[name="kompetensi_keahlian"]').val(res.kompetensi_keahlian);
    });
    formKelas.slideDown();
});

form.submit(function(e){
    e.preventDefault();
    $.ajax({
        url: `${url}/kelas/tambah`,
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
      text: `Kelas ${nama} akan dihapus`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#6492b8da",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${url}/kelas/${urlhapus}`,
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


