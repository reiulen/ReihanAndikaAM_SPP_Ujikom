$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content'),
    }
});

var table = $('#table').DataTable({
    serverSide:true,
    ajax  :{
        url: `${url}/api/laporan`,
        method : "POST",
        data: function(data){
            data.dari = $('input[name="awal"]').val()
            data.sampai = $('input[name="akhir"]').val()
            data.id_spp = $('select[name="id_spp"]').val()
        },
    },
    columns : [
        {
            data: "tanggal",
            name: "tanggal",
        },
        {
            data: "id_pembayaran",
            name: "id_pembayaran",
        },
        {
            data: "nisn",
            name: "nisn",
        },
        {
            data: "nama",
            name: "nama",
        },
        {
            data: "bulan",
            name: "bulan",
        },
        {
            data: "id_spp",
            name: "id_spp",
        },
        {
            data: "nominal",
            name: "nominal",
        },
        {
            data: "petugas",
            name: "petugas",
        },
    ]
});


const kelas = $('.kelas');
kelas.change(function(){
    table.draw();
});

$('#bulan').submit(function(e){
    e.preventDefault();
    table.draw();
});
