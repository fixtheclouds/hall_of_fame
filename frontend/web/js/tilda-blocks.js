function t412_unifyHeights(recid){var el=$("#rec"+recid);el.find('.t412__descr').css('height',"auto");$('#rec'+recid+' .t412 .t-container').each(function(){var highestBox2=0;$('.t412__descr',this).each(function(){if($(this).height()>highestBox2)highestBox2=$(this).height()});if($(window).width()>=960&&$(this).is(':visible')){$('.t412__descr',this).css('height',highestBox2)}else{$('.t412__descr',this).css('height',"auto")}});el.find('.t412__title').css('height',"auto");$('#rec'+recid+' .t412 .t-container').each(function(){var highestBox3=0;$('.t412__title',this).each(function(){if($(this).height()>highestBox3)highestBox3=$(this).height()});if($(window).width()>=960&&$(this).is(':visible')){$('.t412__title',this).css('height',highestBox3)}else{$('.t412__title',this).css('height',"auto")}});el.find('.t412__wrapper').css('height',"auto");$('#rec'+recid+' .t412 .t-container').each(function(){var highestBox=0;$('.t412__wrapper',this).each(function(){if($(this).height()>highestBox)highestBox=$(this).height()});if($(window).width()>=960&&$(this).is(':visible')){$('.t412__wrapper',this).css('height',highestBox)}else{$('.t412__wrapper',this).css('height',"auto")}})}
function t569_init(recid){var el=$('#rec'+recid),line=el.find('.t569__line'),blocksnumber=el.find('.t569').attr('data-blocks-count'),t569_resize;if(blocksnumber=='4'){var cirqlenumber=4}else{var cirqlenumber=8}
line.each(function(){var e=$(this).find('.t569__cirqle');for(i=0;i<cirqlenumber;i++){e.clone().insertAfter(e)}});line.css('max-width',$('.t569__col').width()-$('.t569__bgimg').outerWidth());$(window).resize(function(){if(t569_resize)clearTimeout(t569_resize);t569_resize=setTimeout(function(){line.css('max-width',$('.t569__col').width()-$('.t569__bgimg').outerWidth())},200)})}

$(document).ready(function() { t412_unifyHeights('25086334'); setTimeout(function(){ t412_unifyHeights('25086334'); }, 500);
});
$('.t412').bind('displayChanged',function(){ t412_unifyHeights('25086334');
});
$(window).resize(function() { t412_unifyHeights('25086334');
});
$(window).load(function() { t412_unifyHeights('25086334');
});
