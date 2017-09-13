(function($) {
    "use strict";
/*===================================================================================*/
/*  MY SCRIPTS
/*===================================================================================*/

(function(){
    var htmlCategoryId = $('div.field-discountproduct-category_id').html();
    var htmlProductUnitId = $('div.field-discountproduct-product_unit_id').html();
    
    //console.log(htmlCategoryId);
    //console.log(htmlProductUnitId);
    
    $('#discountproduct-product_id').on('change', function(event){
        event.preventDefault();
        var productId = $(this).val();
        console.log(productId);
        //console.log(htmlCategoryId);
        //console.log(htmlProductUnitId);
        if (productId === '0'){
            $('div.field-discountproduct-category_id').html(htmlCategoryId);
            $('div.field-discountproduct-product_unit_id').html(htmlProductUnitId);
        }
        
        if (productId){
            $('div.field-discountproduct-product_unit_id').html(htmlProductUnitId);
            $.ajax({
                //async: false,
                url: '/admin/ajax/get-field-category',
                data: {productId: productId},
                type: 'GET',
                success: function(res){
                    if (res){
                        //console.log(res);
                        //showCart(res);
                        $('div.field-discountproduct-category_id').html(res);
                        //$(res).insertAfter('.field-discountproduct-product_id');

                        $('#discountproduct-category_id').on('change', function(event){
                            event.preventDefault();
                            //console.log('dfdf');
                            var productId = $('#discountproduct-product_id').val();
                            var parentId = $(this).val();
                            if (parentId === '0'){
                                $('div.field-discountproduct-product_unit_id').html(htmlProductUnitId);
                            }
                            if (parentId){
                                $.ajax({
                                    url: '/admin/ajax/get-field-product-unit',
                                    data: {productId: productId, parentId: parentId},
                                    type: 'GET',
                                    success: function(res){
                                        if (res){
                                            //console.log(res);
                                            //showCart(res);
                                            $('div.field-discountproduct-product_unit_id').html(res);
                                           // console.log(res);
                                        }
                                    },
                                    error: function(){
                                        console.log('error');
                                    }
                                });
                            } 
                        });
                    }
                },
                error: function(){
                    console.log('error');
                }
            });
        } 
    });
})();


$('#productunitproperty-type_id').on('change', function(event){
    event.preventDefault();
    var value = $(this).val();
    var productId = parseInt($('#productunitproperty-productid').val());
    //alert(value);
    if (value){
        $.ajax({
            url: '/admin/property/get-form-field',
            data: {type: value, productId: productId},
            type: 'GET',
            success: function(res){
                if (res){
                    //console.log(res);
                    //showCart(res);
                    $('.field-productunitproperty-value').html(res);
                    console.log(res);
                }
            },
            error: function(){
                alert('error');
            }
        });
    } 
});

function translit(name){
    // Символ, на который будут заменяться все спецсимволы
    //var space = '-'; 
    var space = '_'; 
    // Берем значение из нужного поля и переводим в нижний регистр
    var text = name.toLowerCase();

    // Массив для транслитерации
    var transl = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 
        'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
        'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
        'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
        ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
        '#': space, '$': space, '%': space, '^': space, '&': space, '*': space, 
        '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space, 
        ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
        '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
        '?': space, '<': space, '>': space, '№':space
    };

    var result = '';
    var curent_sim = '';

    for(var i=0; i < text.length; i++) {
        // Если символ найден в массиве то меняем его
        if(transl[text[i]] !== undefined) {
             if(curent_sim !== transl[text[i]] || curent_sim !== space){
                 result += transl[text[i]];
                 curent_sim = transl[text[i]];
                                                            }                                                                             
        }
        // Если нет, то оставляем так как есть
        else {
            result += text[i];
            curent_sim = text[i];
        }                              
    }          

    result = TrimStr(result);               
    //console.log(result);
    // Выводим результат 
    //document.getElementById('alias').value = result;
    return result;
    }

    function TrimStr(s) {
        s = s.replace(/^-/, '');
        return s.replace(/-$/, '');
    }

/*$('[id *= "name"]').on('keyup', function(event){
    event.preventDefault();
    var name = $(this).val();
    var alias = translit(name);
    $('[id *= "alias"]').val(alias);
});*/

$('[id *= "title"]').on('keyup', function(event){
    event.preventDefault();
    var name = $(this).val();
    var alias = translit(name);
    $('[id *= "alias"]').val(alias);
});

//Устанавливаем обработчик на radiobutton
$('input[name="translateMethod"]').on('change', function(event){
    event.preventDefault();
    //var method = $(this).data('method');
    var method = $(this).val();
    //console.log(method);
    if (method === 'translit'){
        
        var name = $('[id *= "name"]').val();
        if (name !== ''){
            var alias = translit(name);
            $('[id *= "alias"]').val(alias);
        }
        
        //$('[id *= "name"]').unbind();
        $('[id *= "name"]').off();
        
        $('[id *= "name"]').on('keyup', function(event){
            event.preventDefault();
            var name = $(this).val();
            var alias = translit(name);
            $('[id *= "alias"]').val(alias);
        });
        
    }else{
        
        var name = $('[id *= "name"]').val();
        //console.log(name);
        if (name){
            $.ajax({
                url: '/admin/ajax/translate',
                data: {name: name},
                type: 'GET',
                success: function(res){
                    if (res){
                        var alias = translit(res);
                        $('[id *= "alias"]').val(alias);
                        //console.log(res);
                    }
                },
                error: function(){
                    //alert('error');
                    console.log('error');
                }
            });
        }
        
        //$('[id *= "name"]').unbind();
        $('[id *= "name"]').off();
        
        $('[id *= "name"]').on('keyup', function(event){
            event.preventDefault();
            var name = $(this).val();
            //var alias = translit(name);

            if (name){
                $.ajax({
                    url: '/admin/ajax/translate',
                    data: {name: name},
                    type: 'GET',
                    success: function(res){
                        if (res){
                            $('[id *= "alias"]').val(res);
                            //console.log(res);
                        }
                    },
                    error: function(){
                        //alert('error');
                        console.log('error');
                    }
                });
            }
        });
    }
});

//Удаление картинок из админки
(function (){
    $('.delete-image').on('click', function(event){
        event.preventDefault();
            //var name = $(this).val();
            //var alias = translit(name);
        var productId = $(this).data('product-id');
        var productUnitId = $(this).data('product-unit-id');
        var imageId = $(this).data('image-id');
        var parent = $(this).parent();
        //console.log(productId);
        //console.log(productUnitId);
        //console.log(imageId);
            if (productId && productUnitId && imageId){
                $.ajax({
                    url: '/admin/ajax/delete-image',
                    data: {productId: productId, productUnitId: productUnitId, imageId: imageId},
                    type: 'POST',
                    success: function(res){
                        if (res){
                            //$('[id *= "alias"]').val(res);
                            parent.css('display', 'none');
                            console.log(res);
                        }
                    },
                    error: function(){
                        //alert('error');
                        console.log('error');
                    }
                });
            }
    })
})();

})(jQuery);