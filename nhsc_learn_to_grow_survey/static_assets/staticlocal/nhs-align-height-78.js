$(document).ready(function(){setTimeout(function(){NHSAlignElmHeight();},200);});function NHSAlignElmHeight(){var maxHeight=0;var _elms=document.getElementsByClassName("NHSAlignHeight");for(var i=0;i<_elms.length;i++){var th=$(".NHSAlignHeight:eq("+i+")").children().eq(0).children().eq(0).innerHeight();if(th>maxHeight){maxHeight=th;}}
for(var i=0;i<_elms.length;i++){$(".NHSAlignHeight:eq("+i+")").children().eq(0).children().eq(0).innerHeight(maxHeight);}}