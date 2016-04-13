$(document).ready(function(){
  $('.cell').click(function(){
    $(this).toggleClass('mark');
    oLottery.update();
    if(oLottery.nGames>8){
      console.log('已经超过8场')
      $(this).removeClass('mark');
    }
    $('#lotteries-count').html(oLottery.nLottery +'注 共'+oLottery.nLottery*2+'元');
    oLottery.update();

  });

  $('#btn-trolly-clean').click(function(){
    $('.cell.mark').removeClass('mark');
    oLottery.update();
    $('#lotteries-count').html(oLottery.nLottery +'注 共'+oLottery.nLottery*2+'元');
  })

  var oLottery = new Object();
  oLottery.id = 123456;
  oLottery.time = new Date();
  oLottery.nLottery = 0;
  oLottery.nGames = 0;
  oLottery.data = [];
  oLottery.update = function(){
    var items = $('.range_match');
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
      this.nGames = games;
      this.data[i]={
        'gameId' : gameId,
        'selection' : selection
      }
    }
    this.fCount();
    console.log(JSON.stringify(this));
    console.log(this.nLottery+'注');

  }
  oLottery.fCount = function(){
    var lottery = 0;//初始化只有一种情况
    if(this.nGames>0){
      lottery = 1;
    }
    for(i=0; i<this.data.length; i++){
      var count=0;
      for(var j=0; j<6; j++){
        if(this.data[i].selection[j]==1)count++;//本场选中的数量
      }
      if(count>0){
        lottery *= count;//排列组合计算
      }
    }
    this.nLottery = lottery;
  }

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
      oLottery.data[i]={
        'gameId' : gameId,
        'selection' : selection
      }
    }
    console.log(JSON.stringify(oLottery));
    return games;//返回数据：选中的场次数量
  }

  function selectionCount(data){
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

  // angular
  var buyApp = angular.module('buyApp',[]);
  buyApp.controller('buyCtrl',function($scope){
  })
})
