$('input#facilityarray-submit').on('click', function(){
    var newfacility = $('input$facilityarray').val();
    $.post('ajax/addfacility.php', {newfacility:newfacility}, function(updatedarray){
        $('#facili-updatedarray').text(updatedarray);
    })
});