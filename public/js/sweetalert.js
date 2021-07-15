function deleteActione(e,type){
   e.preventDefault();
    let url = '';
    switch(type){
        case 'deleteUser':
            url = $('#'+type).attr('data-val');
            console.log(url);
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
            break;
        case 'deleteCat':
                url = $('#'+type).attr('data-val');
                console.log(url);
                swal({
                    title: 'Are you sure?',
                    text: ' all the products related to that category will be deleted!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = url;
                    }
                });
                break;
                case 'deleteProduct':
                    url = $('#'+type).attr('data-val');
                    console.log(url);
                    swal({
                        title: 'Are you sure?',
                        text: 'if you are doing so then product will be deleted!',
                        icon: 'warning',
                        buttons: ["Cancel", "Yes!"],
                    }).then(function(value) {
                        if (value) {
                            window.location.href = url;
                        }
                    });
                    break;
        default:
            break;

    }
}