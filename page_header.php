<!-- 底部导航和 floating action button -->
  <div class="section-bottom">
    <div class="nav-bottom" id="nav-item-1">

      <input type="radio" name="name" class="nav-toggle" id="item-1" checked>
      <label class="nav-bottom-item" for="item-1" onclick="goto('index.php')">
        <i class="material-icons">free_breakfast</i>
        <span class="nav-bottom-text">首页</span>
      </label>

      <input type="radio" name="name" class="nav-toggle" id="item-2" >
      <label class="nav-bottom-item" for="item-2" onclick="goto('hunhe_spf.php')">
        <i class="material-icons">trending_up</i>
        <span class="nav-bottom-text">走势</span>
      </label>

      <input type="radio" name="name" class="nav-toggle" id="item-3">
      <label class="nav-bottom-item" for="item-3" onclick="">
        <i class="material-icons">message</i>
        <span class="nav-bottom-text">说说</span>
      </label>

      <input type="radio" name="name" class="nav-toggle" id="item-4">
      <label class="nav-bottom-item" for="item-4" onclick="">
        <i class="material-icons">account_balance_wallet</i>
        <span class="nav-bottom-text">米米</span>
      </label>

      <input type="radio" name="name" class="nav-toggle" id="item-5">
      <label class="nav-bottom-item" for="item-5" onclick="goto('user.php')">
        <i class="material-icons">account_circle</i>
        <span class="nav-bottom-text">我的</span>
      </label>
    </div>
    <script>
      function goto(url) {
        if (url) {
          window.location.href=url;
        }
      }

      $('.nav-bottom-item').removeAttr('checked');

      switch (window.location) {
        case 'index.php': document.getElementById('item-1').checked='checked';
          break;
        case 'hunhe_spf.php': document.getElementById('item-2').checked='checked';
          break;
        case 'index-3.php': document.getElementById('item-3').checked='checked';
          break;
        case 'index-4.php': document.getElementById('item-4').checked='checked';
          break;
        case 'user.php': document.getElementById('item-5').checked='checked';
          break;
        default:
        break;
      }
    </script>

  </div>
