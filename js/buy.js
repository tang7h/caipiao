$(document).ready(function(){
  $('.cell').click(function(){
    $(this).toggleClass('mark');
    console.log(selectionCalc(oData.data));
  });

  var oData = new Object();
  oData.id = 123456;
  oData.time = new Date();
  oData.data = [];

  function updateData(){
    items = $('.range_match');
    for(i=0; i<items.length; i++){
      gameId = $(items[i]).find('.id').html();
      selection = [];
      cells = $(items[i]).find('.cell');
      for(j=0; j<cells.length; j++){
        selection[j]=$(cells[j]).hasClass('mark')?1:0;
      }
      oData.data[i]={
        'gameId' : gameId,
        'selection' : selection
      }
    }
    console.log(JSON.stringify(oData));
  }

  function selectionCalc(data){
    updateData();
    var marked = 1;
    for(i=0; i<data.length; i++){
      var count=0;
      for(var j=0; j<6; j++){
        if(data[i].selection[j]==1)count++;
      }
      marked *= count<1?1:count;
    }
    return marked;
  }
  console.log(selectionCalc(oData.data));
})
