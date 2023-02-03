var viewModel = null;
var indexPage = 0;
var __query;
var __GsaitemperPage;
var __Gsaclient;
var __Gsasite;

function cutText(text, size) {
    if (text.length > size) {
        text = text.substring(0, size - 1);
        text = text + '...';
    }
    return text;
}

viewModel = {
  searchResults: ko.observableArray(),
  pageSize: ko.observable(5),
  pageIndex: ko.observable(0),
  maxPageIndex: ko.observable(0),
  previousPage: function () {
    indexPage = indexPage - 1;
    ShellSearchResults(__query, 1);

  },
  nextPage: function () {
    indexPage = indexPage + 1;
    ShellSearchResults(__query, 1);
  }
};

function ShellSearchResults(queryString, Page) {
 var __data = "";
 $.ajax({
   url: "/_handlers/searchresults.ashx?q=" + encodeURIComponent(queryString) + "&index=" + indexPage + "&itemperpage=" + __GsaitemperPage + "&client=" + __Gsaclient + "&site=" + __Gsasite,
   type: "POST",
   dataType: "json",
   contentType: "application/json; charset=utf-8",
   data: __data,
   success: function (msg) {
     __data = msg;
     if (__data.GSP.RES != null) {
       $("#start").text((indexPage * __GsaitemperPage) + 1);
       var indexitemsperpage = (indexPage + 1) * __GsaitemperPage;
       if (indexitemsperpage > __data.GSP.RES.M) {
         $("#to").text(__data.GSP.RES.M);
       }
       else {
         $("#to").text(indexitemsperpage);
       }

       $("#numberItem").text(__data.GSP.RES.M);

       if ((__data.GSP.RES.M - (indexPage * __GsaitemperPage) == 1) || (__GsaitemperPage == 1)) {
           var __arrayTmp = new Array();
           __arrayTmp.push(__data.GSP.RES.R);
           viewModel.searchResults(__arrayTmp);
       } else {
           viewModel.searchResults(__data.GSP.RES.R);
       }

       viewModel.maxPageIndex(Math.ceil(__data.GSP.RES.M / __GsaitemperPage) - 1);
       viewModel.pageIndex(indexPage);
       $(".indexPage").text(indexPage + 1);
       $(".maxPage").text(viewModel.maxPageIndex() + 1);
     }
     else {
         viewModel.searchResults.removeAll();
         $("#noresult").text(__noresultLabel + " " + queryString);
         
     }

     $("#nse-search-results .results li:even").addClass('alternate');

   },
   error: function (msg) {

     //default behavior for the search (empty knockout model)
     viewModel = {
       searchResults: ko.observableArray()
     };

     $("#noresult").text(__noresultLabel);

     //ko.applyBindings(viewModel, document.getElementById("nse-search-results"));

   }
 });
    
  

}

function getParameterByName(name) {
  var match = RegExp('[?&]' + name + '=([^&]*)')
                    .exec(window.location.search);

  return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

$(".nwe-advanced-search span.search").on("click", function () {
  var input = $(".nwe-advanced-search #searchInput").val();
  indexPage = 0;
  __query = input;
  $("#querysearch").text($(".nwe-advanced-search #searchInput").val());
  ShellSearchResults(input, 1);
});

$(".nwe-advanced-search #searchInput").keyup(function (e) { if (e.keyCode == 13) { $(".nwe-advanced-search span.search").click(); } });
$(".nwe-advanced-search #searchInput").click(function () {
  if (this.value == this.defaultValue) {
    $(this).val('');
  }
});


$(document).ready(function () {
  __query = getParameterByName("q");
  __GsaitemperPage = $("#itemPerPage").text();
  __Gsaclient = $("#client").text();
  __Gsasite = $("#site").text();
  __noresultLabel = $("#noresultlabel").text();
  
  ko.applyBindings(viewModel, document.getElementById("nse-search-results"));
  if (__query != null && __query != "") {
    $(".nwe-advanced-search #searchInput").val(__query);
    ShellSearchResults(__query, 1);
    $("#querysearch").text(__query);
  }

}
);