$(document).ready(function(){
    
    $('#helpmeddiv').hide();
    $('#helppoldiv').hide();
    $('#helpfirediv').hide();

    $('.helpchoosemed').click(function() {
        $('#helpmeddiv').slideDown("slow");
        $('#helppoldiv').hide();
        $('#helpfirediv').hide();
    });
    $('.helpchoosepol').click(function() {
        $('#helpmeddiv').hide();
        $('#helppoldiv').slideDown("slow");
        $('#helpfirediv').hide();
    });
    $('.helpchoosefire').click(function() {
        $('#helpmeddiv').hide();
        $('#helppoldiv').hide();
        $('#helpfirediv').slideDown("slow");
    });
    $('#helpclose').click(function() {
        $('#helpmeddiv').hide();
        $('#helppoldiv').hide();
        $('#helpfirediv').hide();
    });

}); 