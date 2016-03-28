<!-- 底部导航和 floating action button -->
  <div class="section-bottom">
    <div class="nav-bottom" id="nav-item-1">

      <label class="nav-bottom-item active" for="item-1" data-url="index.php">
        <i class="material-icons">free_breakfast</i>
        <span class="nav-bottom-text">首页</span>
      </label>

      <label class="nav-bottom-item" for="item-2" data-url="hunhe_spf.php">
        <i class="material-icons">trending_up</i>
        <span class="nav-bottom-text">走势</span>
      </label>

      <label class="nav-bottom-item" for="item-3">
        <i class="material-icons">message</i>
        <span class="nav-bottom-text">说说</span>
      </label>

      <label class="nav-bottom-item" for="item-4">
        <i class="material-icons">account_balance_wallet</i>
        <span class="nav-bottom-text">米米</span>
      </label>

      <label class="nav-bottom-item" for="item-5" data-url="user.php">
        <i class="material-icons">account_circle</i>
        <span class="nav-bottom-text">我的</span>
      </label>
    </div>
    <script>

      $('.nav-bottom-item').on('click',function(){
        $('.nav-bottom-item').removeClass('active');
        $(this).addClass('active');
        if($(this).data('url')){window.location=$(this).data('url');}
      })

      switch (window.location) {
        case 'index.php': $('.nav-bottom-item:nth-of-type(1)').addClass('active');
          break;
        case 'hunhe_spf.php': $('.nav-bottom-item:nth-of-type(2)').addClass('active');
          break;
        case 'index-3.php': $('.nav-bottom-item:nth-of-type(3)').addClass('active');
          break;
        case 'index-4.php': $('.nav-bottom-item:nth-of-type(4)').addClass('active');
          break;
        case 'user.php': $('.nav-bottom-item:nth-of-type(5)').addClass('active');
          break;
        default:
        break;
      }
    </script>

  </div>
