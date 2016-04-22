<!-- 底部导航和 floating action button -->
  <div class="section-bottom">
    <!-- 底部导航 -->
    <div class="nav-bottom">
      <!-- <div class="nav-bottom-item {{i.show}}" ng-repeat="i in pages" ng-click="turn($index)" data-stage="{{i.name}}"> -->
      <div class="nav-bottom-item {{i.show}}" ng-repeat="i in pages" ng-click="goto('http://positemall.cn/'+i.address)" data-stage="{{i.name}}">
        <i class="material-icons">{{i.icon}}</i>
        <span class="nav-bottom-text">{{i.tag}}</span>
      </div>
    </div>
    <!-- 底部工具栏 -->
  	<section id="toolbar-buy" ng-show="tools.show">
  		<i class="material-icons" id="btn-trolly-clean">delete</i>
      <select id="select-rule" ng-model="rules.value" ng-options="i for i in rules.values">
      </select>
      <div class="">
        <input type="number" id="input-multiple" name="" value="1" min="1" max="1000" step="1">倍
      </div>
  		<div class="desc">
  			<span id="lotteries-count"></span>
  		</div>
  		<button type="button" name="button" class="md-btn md-btn-primary" id="btn-buy">选好了</button>
  	</section>
    <div class="snackbar" ng-show="tools.show">
      <p>最多选择8场比赛</p>
    </div>
    <div class="toast" ng-show="tools.show">
      <p class="toast-message"></p>
      <span class="md-btn" id="toast-recall">恢复</span>
    </div>

  </div>

  <script>
  oBottom = new Object({
    scrollBefore: 0,
    scrollAfter: 0,
    sSelector: '.section-bottom',
    init: function(scrollBefore,scrollAfter,sSelector){
      $(window).scroll(function(){
        this.scrollAfter = $(window).scrollTop();
        if(this.scrollBefore > this.scrollAfter){
          $('.section-bottom').removeClass('hide');
        }else{
          $('.section-bottom').addClass('hide');
        }
        this.scrollBefore = this.scrollAfter;
      })
      return this;
    }
  });
  // oBottom.init();

  </script>
