$('article').click(function() {
    $('#detail-titre').text($(this).data('titre'));
    $('#detail-date').text($(this).data('date'));
    $('#detail-lieu').text($(this).data('lieu'));
    $('#detail-capacite').text($(this).data('capacite') + ' places');
    $('#detail-description').text($(this).data('description'));
    $('#detail').show();
});

$('#btn-fermer').click(function() {
    $('#detail').hide();
});

