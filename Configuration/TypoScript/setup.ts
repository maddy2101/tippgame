plugin.tx_tippgame {
	persistence {
		storagePid = 10
	}
}

page.includeJS {
	jQuery = http://code.jquery.com/jquery-2.1.4.min.js
	jQuery.external = 1
	moment = https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js
	moment.external = 1
	bootstrap = https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js
	bootstrap.external = 1
	datetime-picker = EXT:tippgame/Resources/components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js
	tippgame = EXT:tippgame/Resources/Public/JavaScript/tippgame.js
}

page.includeCSS {
	bootstrap = https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
	bootstrap.external = 1
	fontawesome = https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css
	fontawesome.external = 1
	datetime-picker = EXT:tippgame/Resources/components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css
}
