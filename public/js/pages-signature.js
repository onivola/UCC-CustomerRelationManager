$( document ).ready(function() {

    let urlcourante = document.location.href;
    let url = new URL(urlcourante);
    let id = url.searchParams.get("id");
    let key = url.searchParams.get("key");

    if(key == null || key == ''){
        $('body').css({
            'color' : 'red',
            'text-align' : 'center',
            'margin-top' : '50px',
            'font-size' : '20px'
        })
        $('body').html('Lien expiré ou lien non valide');
    }else if(key != null && key != ''){
        $.ajax({
            data :{
                key : key,
                propal_id : id
            },
            async : false,
            type: 'POST',
            url: "../../LielComBack/public/index.php/check_link_signature",
            success: function(data) {
                if(data.success == 1){
                    $('#iframe_propal').attr('src',data.propal_path)
                    $('.wrapper').css('display','block');
                }else{
                    $('body').css({
                        'color' : 'red',
                        'text-align' : 'center',
                        'margin-top' : '50px',
                        'font-size' : '20px'
                    })
                    $('body').html('Lien expiré ou lien non valide');
                }

            }
        });
    }


    const canvas = document.querySelector("#pad_signature");

    const signaturePad = new SignaturePad(canvas)

    $(document).on('click','#clear_signature', function() {
        signaturePad.clear();
    })

    $(document).on('click','#valid_signature', function(){
        let check_if_emtpty = signaturePad.isEmpty();
        let value_approuvation = $('#approuvation').val()
        if(check_if_emtpty || value_approuvation == ''){
            $('#alert_empty').css('display', 'block');
        }else{
            let image_signature = signaturePad.toDataURL();
            $.ajax({
                data :{
                    propal_id : id,
                    signature : image_signature,
                    approuvation: value_approuvation
                },
                type: 'POST',
                url: "../../LielComBack/public/index.php/get_signature",
                beforeSend: function(){
                    $('.lds-ring').css('display', 'inline-block');
                },
                success: function(data) {
                    if(data.success == 1){
                        // $('#iframe_propal').attr('src',data.propal_path)
                        $('#modal_signature').modal('hide')
                        $('.content_page').html(`<div class="row" style="display: flex; justify-content: center; margin-top: 50px">
                                            <div class="col-md-4">
                                                <div class="card mb-md-0 mb-3">
                                                    <div class="card-body" style="text-align: center; font-size: 20px;">
                                                        <p>Votre mise aux normes a bien été enregistré.</p>
                                                        <p>Vous avez recu un mail avec la mise aux normes signée.</p>
                                                        <div style="display: flex; justify-content: center;">
                                                            <i style="font-size: 35px; color: green;" class="dripicons-checkmark"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`)

                    }
                },
                complete: function(){
                    $('.lds-ring').css('display', 'none');
                }
            });
        }

    })

})
