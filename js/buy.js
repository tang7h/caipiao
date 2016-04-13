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

  var oLottery = new Object({
    id : 123456,
    time : new Date(),
    nLottery : 0,
    nGames : 0,
    data : [],
    update : function(){
      var items = $('.range_match');
      var games = 0;
      for(i=0; i<items.length; i++){
        gameId = $(items[i]).data('game-id');
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
      localStorage.oLottery = JSON.stringify(this);
      // console.log(JSON.stringify(this));
      // console.log(this.nLottery+'注');

    },
    fCount : function(){
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

  });


  // angular
  var buyApp = angular.module('buyApp',[]);
  buyApp.controller('buyCtrl',function($scope){
  })
})
