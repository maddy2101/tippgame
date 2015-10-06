/**
 * Created by maddy on 29.09.15.
 */
$(document).ready(function () {
	initializeDateTimePicker();
});

function initializeDateTimePicker() {
	$('#datepicker_start').datetimepicker({
											  format: 'DD.MM.YYYY'
										  });
	$('#datepicker_stop').datetimepicker({
											 useCurrent: false, //Important! See issue #1075
											 format: 'DD.MM.YYYY'
										 });
	$("#datepicker_start").on("dp.change", function (e) {
		$('#datepicker_stop').data("DateTimePicker").minDate(e.date);
	});
	$("#datepicker_stop").on("dp.change", function (e) {
		$('#datepicker_start').data("DateTimePicker").maxDate(e.date);
	});
}

$("body").on("click", '#newTournament', function (e) {
	url = $(this).attr('data-url');
	$('#newTournamentModal .modal-body').load(url);
	setTimeout(function () {
		initializeDateTimePicker();
	}, 500);
});

$("body").on("click", '#createTournament', function (e) {
	e.preventDefault();

	$(this).attr('disabled', 'disabled');
	var form = $(this).closest('form'),
		serializedData = form.serialize(),
		action = form.attr('action');
	$.ajax(
		{
			type: "POST",
			url: action,
			data: serializedData

		})
		.done(function (res) {
			var validationError = $(res).find('#editForm');
			if (validationError.length) {
				$('#editForm').html(validationError.html());
				setTimeout(function () {
					initializeDateTimePicker();
				}, 500);
			} else {
				var result = $(res).find('.tx_tippgame');
				$('.modal').on('hidden.bs.modal', function (e) {
					$('.tx_tippgame').html(result.html());
					$('.modal').off('hidden.bs.modal');
				});
				$('.modal').modal('hide');
			}
		})
		.fail(function () {
			throw new Error("AJAX Form submission error");
		});

});
