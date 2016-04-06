/*
*  Javascript�ļ���waterfall.js
*/
$(function(){
  jsonajax();
});

//������Ҫ���м�����������ǰ���ڵ�λ���ˡ����������������ײ�����100px��ʱ����Ҫ���е���ajax��������
$(window).scroll(function(){
  //�˷������ڹ���������ʱ�����ĺ���
  // �����������ײ�����100����ʱ������������
  var $doc_height,$s_top,$now_height;
  $doc_height = $(document).height();        //������document�������߶�
  $s_top = $(this).scrollTop();            //��ǰ����������϶��ٸ߶�
  $now_height = $(this).height();            //������this Ҳ�Ǿ���window����
  if(($doc_height - $s_top - $now_height) < 20) jsonajax();
});


//��һ��ajax����������data.php���ϵĻ�ȡ����
var $num = 0;
function jsonajax(){

  $.ajax({
    url:'data.php',
    type:'POST',
    data:"num="+$num++,
    dataType:'json',
    success:function(json){
      if(typeof json == 'object'){
        var $content,$row,iheight,temp_h;
        for(var i=0,l=json.length;i<l;i++){
          $content = json[i];    //��ǰ������
          //���˸߶����ٵ���������������
          iheight  =  -1;
          $("#stage").each(function(){
            //�õ���ǰli�ĸ߶�
            temp_h = Number($(this).height());
            if(iheight == -1 || iheight >temp_h){
              iheight = temp_h;
              $row = $(this); //��ʱ$row��li������
            }
          });
          $item = $($('#item-template').html());
          $item.find('.content-img').attr('src','../'+$content.img);
          $item.find('.content-title').html($content.title);
          $row.append($item);
        }
      }
    }
  });
}
