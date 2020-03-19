(function($){
	
	'use strict';

	console.log('...loaded search.js');

	$(function(){
		console.log('jquery ready');

		var submitSearch=function(text){

			$('.search-container').empty();

			console.log('input=' + text);

			var str=$.trim(text);

			if(_.size(str)<2){
				toastr.warning('Please enter more than 2 characters');
				return;
			}

			$.ajax({
            	url: ns.base_url + 'search-movie.php?keywords=' + text, cache: false, type: 'GET', dataType: 'html'
            	,beforeSend: function(){
            		$('#searchtext').prop('disabled',true);
            		$('.btnSearch').prop('disabled',true);
	           		$('.btnSearch').find('i.fa-spinner').removeClass('hidden');
	           		$('body').waitMe({
						effect : 'bounce',// 'win8_linear',
						text : 'please wait',
						//bg : '#98ff68', //rgba(255,255,255,0.7),
						color : '#000',
						maxSize : '',
						textPos : 'vertical',
						fontSize : '',
						source : ''
					});
            	},error: function (xhr, status, error) {
            		toastr.error('Server error occured!');
            	},success: function (result) {
                	//console.log(result);
					$('.search-container').html(result);
            	}//success
        	}).always(function () {
            	$('#searchtext').prop('disabled',false);
            	$('.btnSearch').prop('disabled',false);
           		$('.btnSearch').find('i.fa-spinner').addClass('hidden');
        		$('body').waitMe("hide");
        	});
		};

		var options = {
		    callback: function (value) { 
		    	console.log('TypeWatch callback: (' + (this.type || this.nodeName) + ') ' + value); 
		    	submitSearch(value);
		    },
		    wait: 2000,
		    highlight: true,
		    allowSubmit: false,
		    captureLength: 2
		}

		$("#searchtext").typeWatch( options );

		$('.btnSearch').on('click',function(){
			var text=$.trim($('#searchtext').val());
			if(_.size(text)<2){
				toastr.warning('Please enter more than 2 characters');
				return;
			}
			submitSearch(text);
		});

	});

}(jQuery));