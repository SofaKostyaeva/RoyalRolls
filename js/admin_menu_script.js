$(document).ready(function(){
    $('.rolls').click(function(){
        $.ajax({
            url: '/php/rolls2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.zha_rolls').click(function(){
        $.ajax({
            url: '/php/zha_rolls2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.za_rolls').click(function(){
        $.ajax({
            url: '/php/za_rolls2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.hol_rolls').click(function(){
        $.ajax({
            url: '/php/hol_rolls2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.pizza').click(function(){
        $.ajax({
            url: '/php/pizza2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.hot').click(function(){
        $.ajax({
            url: '/php/hot2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.vok').click(function(){
        $.ajax({
            url: '/php/vok2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.pasta').click(function(){
        $.ajax({
            url: '/php/pasta2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.plov').click(function(){
        $.ajax({
            url: '/php/plov2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.sup').click(function(){
        $.ajax({
            url: '/php/sup2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.drink').click(function(){
        $.ajax({
            url: '/php/drink2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.sets').click(function(){
        $.ajax({
            url: '/php/sets2.php',
            type: 'GET',
            beforeSend: function(){
                $('body').empty();
            },
            success: function(responce){        
                $('body').append(responce);
            },
            error: function(){
                alert('Error!');            
            }   
        });
    });
    $('.delete').click(function(){
        var thisId = $(this).attr('id');
        var name =  $(`#${thisId} + .name_hid`).text();
        $.ajax({
            type: 'POST',
            typeData: 'json',
            url: '/php/delete_item_menu.php',
            data: {postData: name},
            success: function(data){
                if(!data['success'])
                {
                    location.reload();
                }
            }
        });
    });
});