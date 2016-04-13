$(document).ready(function(){
  $('.cell').click(function(){
    $(this).toggleClass('mark');
    if(updateData()>8){
      $(this).removeClass('mark');
    }
    console.log(updateData()+' games selected');
    selectionCalc(oData.data);
  });

  var oData = new Object();
  oData.id = 123456;
  oData.time = new Date();
  oData.data = [];

  function updateData(){
    items = $('.range_match');
    var games = 0;
    for(i=0; i<items.length; i++){
      gameId = $(items[i]).find('.id').html();
      selection = [];
      cells = $(items[i]).find('.cell');
      for(j=0; j<cells.length; j++){
        selection[j]=$(cells[j]).hasClass('mark')?1:0;
      }
      for(j=0; j<cells.length; j++){
        if($(cells[j]).hasClass('mark')){
          games++;
          break;
        }
      }
      oData.data[i]={
        'gameId' : gameId,
        'selection' : selection
      }
    }
    return games;
    console.log(JSON.stringify(oData));
  }

  function selectionCalc(data){
    var lottery = 1;//初始化只有一种情况
    for(i=0; i<data.length; i++){
      var count=0;
      for(var j=0; j<6; j++){
        if(data[i].selection[j]==1)count++;//本场选中的数量
      }
      lottery *= count<1?1:count;//排列组合计算
    }
    return lottery;//返回注数
  }

  console.log(selectionCalc(oData.data));
})
