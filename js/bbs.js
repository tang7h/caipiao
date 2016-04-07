//先创建一个空的bbs.js文件，并修改其属性为utf-8，才能保存中文。
var xmlHttp;                        //用于保存XMLHttpRequest对象的全局变量
var username;                       //用于保存姓名
var pid;                          //用于保存标题
var content;                        //用于保存内容
var threadid;                       //用于保存主题编号

//用于创建XMLHttpRequest对象
function createXmlHttp() {
    //根据window.XMLHttpRequest对象是否存在使用不同的创建方式
    if (window.XMLHttpRequest) {
       xmlHttp = new XMLHttpRequest();                  //FireFox、Opera等浏览器支持的创建方式
    } else {
       xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");//IE浏览器支持的创建方式
    }
}

//提交回帖到服务器
function submitPost() {
    //获取帖子中姓名、标题、内容、主题编号四部分信息
    username = document.getElementById("username").value;
    pid = document.getElementById("post_pid").value;
    content = document.getElementById("post_content").value;
    threadid = document.getElementById("threadid").value;
    if (checkForm()) {
        createXmlHttp();                                    //创建XMLHttpRequest对象
        xmlHttp.onreadystatechange = submitPostCallBack;    //设置回调函数
        xmlHttp.open("POST", "bbspost.php", true);         //发送POST请求
        //设置POST请求体类型
        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlHttp.send("username=" + encodeURI(username) +
                     "&pid=" + encodeURI(pid) +
                     "&content=" + encodeURI(content) +
                     "&threadid=" + threadid);              //发送包含四个参数的请求体
    }
}

//检查表单是否内容已填写完毕
function checkForm() {
    if (username == "") {

        alert("检测到未登录，请您登陆之后再发表评论！");

        return false;
    } else if (pid == "") {
        alert("服务器错误，未获取到文章ID");
        return false;
    } else if (content == "") {
        alert("请填写评论内容！");
        return false;
    }
    return true;
}

//获取查询选项的回调函数
function submitPostCallBack() {
    if (xmlHttp.readyState == 4) {
        createNewPost(xmlHttp.responseText);
    }
}

//创建新的回帖
function createNewPost(postId) {
    //清空当前表单中各部分信息
    document.getElementById("post_pid").value = "";
    document.getElementById("post_content").value = "";
    document.getElementById("username").value = "";

    var postDiv = createDiv("post", "");    //创建回帖的外层div
    postDiv.id = "post" + postId;           //给新div赋id值

    var postpidDiv = createDiv("post_pid", username);  //创建标题div
    var postContentDiv = createDiv("post_content", content);    //创建内容div 
    postDiv.appendChild(postpidDiv);                          //在外层div追加标题
    postDiv.appendChild(postContentDiv);                        //在外层div追加内容

    document.getElementById("thread").appendChild(postDiv);     //将外层div追加到主题div中
}

//根据className和text创建新的div
function createDiv(className, text) {
    var newDiv = document.createElement("div");
    newDiv.className = className;
    newDiv.innerHTML = text;
    return newDiv;
}
