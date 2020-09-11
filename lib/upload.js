window.onload = function(){
    $('#attachment').trigger('click')
}
$('a').on('click', function(){
    $('#attachment').trigger('click')
})
$('#attachment').on('input', function(){
    $('form').submit()
})