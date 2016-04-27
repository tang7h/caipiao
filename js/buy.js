$(document).ready(function(){
  var oSnackbar = new Object(
    {
      dom: $('.snackbar'),
      show: function(message){
        this.dom.html(message).addClass('show');
        if(window.snackbarTimer){
          clearTimeout(snackbarTimer);
        }
        snackbarTimer = setTimeout("$('.snackbar').removeClass('show');",2000);
      }
    }
  );
  var oToast = new Object(
    {
      dom: $('.toast'),
      show: function(message){
        this.dom.find('.toast-message').html(message).addClass('show');
        this.dom.addClass('show');
        if(window.toastTimer){
          clearTimeout(toastTimer);
        }
        toastTimer = setTimeout("$('.toast').removeClass('show');",7000);
      },
      end: function(){
        $('.toast').removeClass('show');
      }
    }
  );

  var oCount = new Object(
    {
      dom: $('#lotteries-count'),
      update: function(){
        this.dom.html(oLottery.nLottery * oLottery.mxnN +'注');
      }
    }
  )
  var oBtnBuy = new Object(
    {
      dom: $('#btn-buy'),
      update: function(){
        if(oLottery.nGames>=1){
          this.dom.removeAttr('disabled');
        }else{
          this.dom.attr('disabled','');
        }
      }
    }
  )
  var mxn = [
    [],
    [
      { name : '2串1', m : '2', n : '1' },
    ],
    [
      { name : '3串1', m : '3', n : '1' },
      { name : '3串3', m : '3', n : '3' },
      { name : '3串4', m : '3', n : '4' }
    ],
    [
      { name : '4串1', m : '4', n : '1' },
      { name : '4串4', m : '4', n : '4' },
      { name : '4串5', m : '4', n : '5' },
      { name : '4串6', m : '4', n : '6' },
      { name : '4串11', m : '4', n : '11' }
    ],
    [
      { name : '5串1', m : '5', n : '1' },
      { name : '5串5', m : '5', n : '5' },
      { name : '5串6', m : '5', n : '6' },
      { name : '5串10', m : '5', n : '10' },
      { name : '5串16', m : '5', n : '16' },
      { name : '5串20', m : '5', n : '20' },
      { name : '5串26', m : '5', n : '26' }
    ],
    [
      { name : '6串1', m : '6', n : '1' },
      { name : '6串6', m : '6', n : '6' },
      { name : '6串7', m : '6', n : '7' },
      { name : '6串15', m : '6', n : '15' },
      { name : '6串20', m : '6', n : '20' },
      { name : '6串22', m : '6', n : '22' },
      { name : '6串35', m : '6', n : '35' },
      { name : '6串42', m : '6', n : '42' },
      { name : '6串50', m : '6', n : '50' },
      { name : '6串57', m : '6', n : '57' }
    ],
    [
      { name : '7串1', m : '7', n : '1' },
      { name : '7串7', m : '7', n : '7' },
      { name : '7串8', m : '7', n : '8' },
      { name : '7串21', m : '7', n : '21' },
      { name : '7串35', m : '7', n : '35' },
      { name : '7串120', m : '6', n : '120' }
    ],
    [
      { name : '8串1', m : '8', n : '1' },
      { name : '8串8', m : '8', n : '8' },
      { name : '8串9', m : '8', n : '9' },
      { name : '8串28', m : '8', n : '28' },
      { name : '8串56', m : '8', n : '56' },
      { name : '8串70', m : '8', n : '70' },
      { name : '8串247', m : '8', n : '247' }
    ]
  ]
  var oSelectRule = {
    dom: $('#select-rule'),
    update: function(){
      // 取串法数据
      var rules = mxn[oLottery.nGames-1];
      //查询localstorage
      var val = localStorage.oLotteryMXN || null;
      // 清空选项
      $('#select-rule').html('')
      // 生成选项
      if(rules){
        for(var i=0; i<rules.length; i++){
          var optionItem = $('<option value='+JSON.stringify(rules[i])+'>'+rules[i].name+'</option>');
          $('#select-rule').append(optionItem);
        }
        for(var i=0; i<rules.length; i++){
          if(JSON.stringify(rules[i])==val){
            $('#select-rule').val(val);
          }
        }
        mxnT = JSON.parse($('#select-rule').val());
        if(mxnT){
          if('name' in mxnT){
            oLottery.mxn = mxnT.name;
          }
          if('n' in mxnT){
            oLottery.mxnN = mxnT.n;
          }
        }
      }
    }
  }
  var oLottery = new Object({
    id : 123456,
    time : new Date(),
    nLottery : 0,
    nGames : 0,
    mxn : '',
    mxnN : 1,
    nMultiple: 1,
    price : 0,
    data : [],
    update : function(){
      var items = $('.range_match');
      var games = 0;
      // 遍历dom
      for(i=0; i<items.length; i++){
        gameId = $(items[i]).data('game-id');
        selection = [];
        // 遍历选中
        cells = $(items[i]).find('.cell');
        for(j=0; j<cells.length; j++){
          selection[j]=$(cells[j]).hasClass('mark')?1:0;
        }
        // 统计选中场数
        for(j=0; j<cells.length; j++){
          if($(cells[j]).hasClass('mark')){
            games++;
            break;
          }
        }
        this.nGames = games;
        $('.nGames').val(games);
        this.data[i]={
          'gameId' : gameId,
          'selection' : selection
        }
        this.nMultiple = $('#input-multiple').val();
      }
      // 清理空数据
      this.clean();
      // 计算场次
      this.fCount();
      // 获取串法
        // this.mxn = $('#select-rule').val();
        // this.mxnN = $('#select-rule').val();
      // 更新串法
      oSelectRule.update();
      //计算价格
      this.price = this.mxnN * this.nLottery * this.nMultiple * 2;
      // 更新提示文本
      oCount.update();
      // 更新按钮状态
      oBtnBuy.update();
      // 写入localstorage
      localStorage.oLotteryData = JSON.stringify(this.data);
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
    },
    render : function(stage){
      var data = this.data;
      for(var i=0; i<data.length; i++){
        var cells = $('div.range_match[data-game-id="'+data[i].gameId+'"]').find('.cell');
        for(var j=0; j<6; j++){
          if(data[i].selection[j]==1){
            $(cells[j]).addClass('mark');
          }
        }
      }
      oLottery.update();
    },
    clean : function(){
      var data = this.data;
      var dataC = [];
      for(var i=0; i<data.length; i++){
        if(data[i].selection.toString()!='0,0,0,0,0,0'){
          dataC.push(data[i]);
        }
      }
      this.data = dataC;
    }

  });
  if(localStorage.oLotteryMXN){//如果有本地存储
    oLottery.mxn = localStorage.oLotteryMXN;//取值
  }
  if(localStorage.oLotteryData){//如果有本地存储
    oLottery.data = JSON.parse(localStorage.oLotteryData);//取值
    oLottery.render();//渲染
  }
  $('#select-rule').change(function(){
    // oLottery.mxn = $('#select-rule').val();
    localStorage.oLotteryMXN = $('#select-rule').val();
    oLottery.update();
  })

  // 选择
  if(!isSupportTouch){
    $('.cell').on('click',function(){
      $(this).toggleClass('mark');
      oLottery.update();
      if(oLottery.nGames>8){
        console.log('已经超过8场');
        oSnackbar.show('最多选择8场比赛');
        $(this).removeClass('mark');
      }
      oLottery.update();
    });
  }
  $('.cell').on('touchstart',function(){
    touchFlag = 1;
  });
  $('.cell').on('touchmove',function(){
    touchFlag = 0;
  });
  $('.cell').on('touchend',function(){
    if(touchFlag){
      $(this).toggleClass('mark');
      oLottery.update();
      if(oLottery.nGames>8){
        console.log('已经超过8场');
        oSnackbar.show('最多选择8场比赛');
        $(this).removeClass('mark');
      }
      oLottery.update();
    }
  });
  // 倍数
  $('#input-multiple').on('change',function(){
    oLottery.update();
  });
  // 清空
  $('#btn-trolly-clean').on('click',function(){
    dataT = JSON.stringify(oLottery.data);
    $('.cell.mark').removeClass('mark');
    oLottery.update();
    oToast.show('已经清空');
  })
  $('#toast-recall').on('click',function(){
    oLottery.data = JSON.parse(dataT);
    oLottery.render();
    oToast.end();
  })
  // 确认
  $('#btn-buy').on('click',function(){
      var postData = {'ball':JSON.stringify(oLottery)};
      console.log(postData);
      $.post('plan_data.php',postData).success(function(data){
      $('#stage-dialog').load('see_plan.php').addClass('show');
      })
  })

  // angular
  universe.controller('buyCtrl',function($scope){
  })
})
