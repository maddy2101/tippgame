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

$('body').on('show.bs.modal', '.tx_tippgame', function (e) {
	var $me = $(this),
		$trigger = $(e.relatedTarget);
	$.ajax({
			   url: $trigger.data('url'),
			   success: function (data) {
				   $me.find('.modal-body').html(data);
				   initializeDateTimePicker();
			   }
		   });
});

$("body").on("click", '.js-ajaxform-submit', function (e) {
	e.preventDefault();

	$(this).attr('disabled', 'disabled');
	var form = $(this).closest('form'),
		serializedData = form.serialize(),
		action = form.attr('action'),
		target_element = $('.js-ajaxform-target').attr('data-target');
	$.ajax(
		{
			type: "POST",
			url: action,
			data: serializedData

		})
		.done(function (res) {
			var validationError = $(res).find('#ajaxForm');
			if (validationError.length) {
				$('#ajaxForm').html(validationError.html());
				setTimeout(function () {
					initializeDateTimePicker();
				}, 500);
			} else {
				switch (target_element) {
					case 'tx-tippgame':

						var result = $(res).find('.tx_tippgame');
						$('.modal').on('hidden.bs.modal', function (e) {
							$('.tx_tippgame').html(result.html());
							$('.modal').off('hidden.bs.modal');

						});
						break;
					default:
						console.log('hier stimmt was nicht: ' + target_element);
				}
				$('.modal').modal('hide');
			}
		})
		.fail(function () {
			throw new Error("AJAX Form submission error");
		});

});
