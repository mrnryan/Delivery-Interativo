$(document).ready(function() { 
    $('#listar').text("Carregando Dados...");   
    listar();    
} );

function listar(p1, p2, p3, p4, p5, p6){
    $.ajax({
        url: 'paginas/' + pag + "/listar.php",
        method: 'POST',
        data: {p1, p2, p3, p4, p5, p6},
        dataType: "html",

        success:function(result){
            $("#listar").html(result);
            $('#mensagem-excluir').text('');
        }
    });
}

function inserir(){    
    $('#mensagem').text('');
    $('#titulo_inserir').text('Inserir Registro');
    $('#modalForm').modal('show');
    limparCampos();
}




$("#form").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $('#mensagem').text('Salvando...')
    $('#btn_salvar').hide();
    $('#btn_carregando').show();

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar').click();
                sucesso();
                listar();

                $('#mensagem').text('')          

            } else {

                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
            }

            $('#btn_salvar').show();
            $('#btn_carregando').hide();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});




function excluir(id) {
    //$('#mensagem-excluir').text('Excluindo...')

    $('body').removeClass('timer-alert');
    Swal.fire({
        title: "Deseja Excluir?",
        text: "Você não conseguirá recuperá-lo novamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33', // Cor do botão de confirmação (vermelho)
        cancelButtonColor: '#3085d6', // Cor do botão de cancelamento (azul)
        confirmButtonText: "Sim, Excluir!",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {


            $.ajax({
                url: 'paginas/' + pag + "/excluir.php",
                method: 'POST',
                data: { id },
                dataType: "html",

                success: function (mensagem) {
                    if (mensagem.trim() == "Excluído com Sucesso") {

                        // Ação de exclusão aqui
                        Swal.fire({
                            title: 'Excluido com Sucesso!',
                            text: 'Fecharei em 1 segundo.',
                            icon: "success",
                            timer: 1000
                        })
                        //excluido();
                        listar();
                        limparCampos();


                    } else {
                        $('#mensagem-excluir').addClass('text-danger')
                        $('#mensagem-excluir').text(mensagem)
                    }
                }
            });

        }
    });


};




function excluirBusca(id) {
    //$('#mensagem-excluir').text('Excluindo...')

    $('body').removeClass('timer-alert');
    Swal.fire({
        title: "Deseja Excluir?",
        text: "Você não conseguirá recuperá-lo novamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33', // Cor do botão de confirmação (vermelho)
        cancelButtonColor: '#3085d6', // Cor do botão de cancelamento (azul)
        confirmButtonText: "Sim, Excluir!",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {


            $.ajax({
                url: 'paginas/' + pag + "/excluir.php",
                method: 'POST',
                data: { id },
                dataType: "html",

                success: function (mensagem) {
                    if (mensagem.trim() == "Excluído com Sucesso") {

                        // Ação de exclusão aqui
                        Swal.fire({
                            title: 'Excluido com Sucesso!',
                            text: 'Fecharei em 1 segundo.',
                            icon: "success",
                            timer: 1000
                        })
                        //excluido();
                        buscar();
                        limparCampos();


                    } else {
                        $('#mensagem-excluir').addClass('text-danger')
                        $('#mensagem-excluir').text(mensagem)
                    }
                }
            });

        }
    });


};



function excluirMultiplos(id) {
    //$('#mensagem-excluir').text('Excluindo...')

    $.ajax({
        url: 'paginas/' + pag + "/excluir.php",
        method: 'POST',
        data: { id },
        dataType: "html",

        success: function (mensagem) {
            if (mensagem.trim() == "Excluído com Sucesso") {
                //listar();
                limparCampos()
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
}



function ativar(id, acao){  
    $.ajax({
        url: 'paginas/' + pag + "/mudar-status.php",
        method: 'POST',
        data: {id, acao},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Alterado com Sucesso") {
                listar();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
}




function baixarConta(id) {
    //$('#mensagem-excluir').text('Excluindo...')


    $('body').removeClass('timer-alert');
    swal({
        title: "Deseja Baixar esta Conta?",
        text: "",
        type: "success",
        showCancelButton: true,
        confirmButtonClass: "btn btn-danger",
        confirmButtonText: "Sim, Baixar!",
        closeOnConfirm: true

    },
        function () {

            //swal("Excluído(a)!", "Seu arquivo imaginário foi excluído.", "success");

            $.ajax({
                url: 'paginas/' + pag + "/baixar.php",
                method: 'POST',
                data: { id },
                dataType: "html",

                success: function (mensagem) {
                    if (mensagem.trim() == "Baixado com Sucesso") {
                        listar();
                        baixado();
                    } else {
                        $('#mensagem-excluir').addClass('text-danger')
                        $('#mensagem-excluir').text(mensagem)
                    }

                }
            });
        });

}



function selecionar(id) {

    var ids = $('#ids').val();

    if ($('#seletor-' + id).is(":checked") == true) {
        var novo_id = ids + id + '-';
        $('#ids').val(novo_id);
    } else {
        var retirar = ids.replace(id + '-', '');
        $('#ids').val(retirar);
    }

    var ids_final = $('#ids').val();
    if (ids_final == "") {
        $('#btn-deletar').hide();
    } else {
        $('#btn-deletar').show();
    }
}


function deletarSel(id) {
    //$('#mensagem-excluir').text('Excluindo...')

    $('body').removeClass('timer-alert');
    Swal.fire({
        title: "Deseja Excluir?",
        text: "Você não conseguirá recuperá-lo novamente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33', // Cor do botão de confirmação (vermelho)
        cancelButtonColor: '#3085d6', // Cor do botão de cancelamento (azul)
        confirmButtonText: "Sim, Excluir!",
        cancelButtonText: "Cancel",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var ids = $('#ids').val();
            var id = ids.split("-");

            for (i = 0; i < id.length - 1; i++) {
                excluirMultiplos(id[i]);
            }

            setTimeout(() => {
                // Ação de exclusão aqui
                Swal.fire({
                    title: 'Excluido com Sucesso!',
                    text: 'Fecharei em 1 segundo.',
                    icon: "success",
                    timer: 1000
                })

                listar();
            }, 1000);

            limparCampos();


        }
    });


};


