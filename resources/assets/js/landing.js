/*
 * Ir a la seccion de la página (scroll)
 */
document.querySelectorAll('.scrollDown').forEach(anchor =>
{
	anchor.addEventListener('click', function (e)
	{
    e.preventDefault();

    document.querySelector(this.getAttribute('href')).scrollIntoView({
      block: 'start',
      behavior: 'smooth',
    });
	});
});

/*
 * Métodos jQuery
 */
$(document).ready(function()
{
  /**
   * Mostrar modal de más información en eventos (landing page)
   * @param  array event
   */
	$('#eventoModal').on('show.bs.modal', function (event)
  {
    let button = $(event.relatedTarget);
    let card = $(event.relatedTarget.parentNode.parentNode);

    let img = (card.find('img').length > 0) ? card.find('img')[0].currentSrc : null;
    let title = (card.find('h5').length > 0) ? card.find('h5')[0].outerText : null;
    let quote = (card.find('.card-quote').length > 0) ? card.find('.card-quote')[0].outerHTML : null;
    let start = (card.find('.card-start').length > 0) ? card.find('.card-start')[0].outerHTML : null;
    let end = (card.find('.card-end').length > 0) ? card.find('.card-end')[0].outerHTML : null;
    let description = button.data('description');

    let modal = $(this);
    modal.find('.modal-img img').empty().prop('src', img);
    modal.find('.modal-body .modal-title').empty().html(title);
    modal.find('.modal-body .modal-quote').empty().html(quote);
    modal.find('.modal-body .modal-start').empty().html(start);
    modal.find('.modal-body .modal-end').empty().html(end);
    modal.find('.modal-body .modal-description').empty().html(description);
  });

});