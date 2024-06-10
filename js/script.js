$(document).ready(function() {
    // hilangin tombol cari
    $('#tombol-cari').hide();

    // event ketikan keyword ditulis
    $('#keyword').on('keyup', function() {
        // munculkan icon loading
        $('.loader').show();

        // ajax menggunakan load
        // $('#container').load('ajax/teknologi.php?keyword=' + $('#keyword').val());

        //$.get()
        $.get('ajax/teknologi.php?keyword' + $('keyword').val(), function(data) {

            $('#container').html(data);
            $('.loader').hide();
        });

    });
});