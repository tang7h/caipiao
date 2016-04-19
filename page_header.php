<!-- 底部导航和 floating action button -->
  <div class="section-bottom">
    <!-- 底部导航 -->
    <div class="nav-bottom">
      <div class="nav-bottom-item {{i.show}} " ng-repeat="i in pages" ng-click="turn($index)" data-stage="{{i.name}}">
        <i class="material-icons">{{i.icon}}</i>
        <span class="nav-bottom-text">{{i.tag}}</span>
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
