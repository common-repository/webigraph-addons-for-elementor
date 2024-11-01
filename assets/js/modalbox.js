/*
* webigraph modal box code 1.0
*/
function wgeModalBoxOpenFunction(elementid) {
var modalid = $(elementid).attr('data-modal-id');
$("#modalwp-"+modalid).addClass("visible");
$("#modal-"+modalid).addClass("visible");
}(jQuery);

function wgeModalBoxCloseFunction() {
$(".wge-modal-wrapper").removeClass("visible");
$(".wge-modal-window").removeClass("visible");
}(jQuery);

