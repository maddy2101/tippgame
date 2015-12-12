/**
 * Created by maddy on 29.09.15.
 */
$(document).ready(function () {
	initializeDateTimePicker();

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
});
