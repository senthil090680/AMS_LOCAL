(function($) {

$(document).ready(function() {
    $('.myTable01').fixedHeaderTable({ width: '915', height: '300', footer: false, cloneHeadToFoot: false, altClass: 'odd', themeClass: 'fancyTable', autoShow: true });
    
    $('.myTable01').fixedHeaderTable('show', 200);
    
    $('.myTable02').fixedHeaderTable({ width: '600', height: '250', footer: true, altClass: 'odd', themeClass: 'fancyDarkTable' });
    
    $('.myTable03').fixedHeaderTable({ width: '400', height: '400', altClass: 'odd', footer: true, themeClass: 'fancyDarkTable' });
    
	$('a.makeTable').bind('click', function() {
		

		$('.myTable01').fixedHeaderTable('destroy');
		
		$('.myTable01 th, .myTable01 td')
			.css('border', $('#border').val() + 'px solid ' + $('#color').val());
			
		$('.myTable01').fixedHeaderTable({ width: $('#width').val(), height: $('#height').val(), footer: true, themeClass: 'fancyTable' });
	});
});
})(jQuery)

