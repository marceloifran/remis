@if(session('checkout_url'))
    <script>
        window.open('{{ session()->get('checkout_url', '_blank') }}').focus();
    </script>
@endif

@if(session('success'))
    <script defer>
        Swal.fire(
            '¡Listo!',
            @json(session('success')),
            'success'
        );
    </script>
@endif

@if(session('error'))
    <script defer>
        Swal.fire(
            'Error',
            @json(session('error')),
            'error'
        );
    </script>
@endif

<script defer>
    $('[confirm]').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estas seguro?',
            text: $(this).attr('confirm-text'),
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si',
        }).then(result => {
            if(result.isConfirmed){
                let waitText = $(this).attr('wait-text');
                if(typeof waitText == 'undefined' || waitText == false)
                {
                    waitText = 'Procesando pedido...';
                }

                $('button').attr('disabled', true);
                $('a').addClass('disabled');
                $(this).find('span').text(waitText);

                if($(this).is('a')){
                    window.location = $(this).attr('href');
                }

                if($(this).is('button')){
                    $(this.form).submit();
                }

                Swal.close();
                callback(result.isConfirmed);
            }
        });
    });
</script>
