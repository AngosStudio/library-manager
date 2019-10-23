function App ( params ) {
    $app = this;
}

App.prototype = {
    constructor: App,

    init:function() {
        $app.load('genres');
        $app.load('books');

        $app.events();
    },

    events:function() {
        $('body').on('click', '.btn-excluir', function() {
            var id = $(this).data('id');
            var type = $(this).data('type');
            if(confirm('This action is irreversible, do you want continue?')){
                $.get(
                    BASE_URL+'api/delete/'+id+'/'+type,
                    function(r) {
                        if(!r.success) alert(r.message);
                        alert('Book deleted with success!');
                        $app.load('books');
                    },
                    'json'
                );
            }
        });

        $('body').on('click', '.btn-editar', function() {
            var id   = $(this).data('id');
            var type = $(this).data('type');
            $.get(
                BASE_URL+'api/'+type+'/'+id,
                function(r) {
                    if(!r.success) alert( r.message );

                    $('#id_book').val( r.data.id );
                    $('#name').val( r.data.name );
                    $('#id_genre').val( r.data.id_genre );
                    $('#description').val( r.data.description );
                },
                'json'
            );
        });

        $('#lib-form').on('submit', function(e) {

            var id = $('#id_book').val();
            $.post(
                BASE_URL+'api/book/'+id,
                {
                    id_genre:    $('#id_genre').val(),
                    name:        $('#name').val(),
                    description: $('#description').val()
                },
                function(r) {
                    if(!r.success) alert(r.message);

                    $app.load('books');

                    $('#lib-form').trigger("reset");
                    if(id != ''){
                        alert('Book saved with success!');
                    }else{
                        alert('Book created with success!');
                    }

                },
                'json'
            );

            return false;
        });
    },

    load:function( type ) {
        switch(type) {
            case 'genres':
                $.get(
                    BASE_URL+'api/list/genres',
                    function(r) {
                        if(!r.success) alert(r.message);
                        var html = '';
                            html += '<option value="">Select Genre</option>';
                        $.each(r.data, function (i, e) {
                            html += '<option value="'+e.id+'">'+e.name+'</option>';
                        });
                        $('#id_genre').html(html).prop('disabled', false);
                    },
                    'json'
                );
            break;
            case 'books':
                $.get(
                    BASE_URL+'api/list/books',
                    function(r) {
                        if(!r.success) alert(r.message);
                        var html = '';
                        $.each(r.data, function (i, e) {
                            html += '<tr>'+"\n";
                            // html += '    <td>'+e.id+'</td>'+"\n";
                            html += '    <td class="text-center">'+e.name+'</td>'+"\n";
                            html += '    <td class="text-center">'+e.id_genre_label+'</td>'+"\n";
                            html += '    <td class="text-center">'+e.description+'</td>'+"\n";
                            html += '    <td class="text-center">'+"\n";
                            html += '        <button class="btn btn-sm btn-warning btn-editar" data-id="'+e.id+'" data-type="book">editar</button>'+"\n";
                            html += '        <button class="btn btn-sm btn-danger btn-excluir" data-id="'+e.id+'" data-type="book">excluir</button>'+"\n";
                            html += '    </td>'+"\n";
                            html += '</tr>'+"\n";
                        });
                        $('#lib-books').html(html);
                    },
                    'json'
                );
            break;
        }
    },

}

var app = new App();
app.init();
