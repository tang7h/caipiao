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
     if(($doc_height - $s_top - $now_height) < 100) jsonajax();
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
                 var content,$row,iheight,temp_h;
                 for(var i=0,l=json.length;i<l;i++){
                     content = json[i];    //��ǰ������
                     //���˸߶����ٵ���������������
                     iheight  =  -1;
                     $("#stage .item").each(function(){
                         //�õ���ǰli�ĸ߶�
                         temp_h = Number($(this).height());
                         if(iheight == -1 || iheight >temp_h){
                             iheight = temp_h;
                             $row = $(this); //��ʱ$row��li������
                         }
                     });
                     $item = $('<div><img src="../'+content.img+'" border="0" ><br/>'+content.title+'</div>').hide();
                     $row.append($item);
                     $item.fadeIn();
                 }
             }
         }
     });
 }
