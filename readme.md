# Project2说明文档

* ### 1、姓名与学号

  姓名：张斐然  学号：18307110244
*********
* ### 2、Github 地址
   
  Github地址：https://github.com/a3377125a 

*********
* ### 3、你的项目完成情况

  #### ***总体情况:***
  
  必做内容全部完成。各个界面的样式与PJ1大体相同，功能上满足了各个基本需求，逻辑完备，
  大致上完成了一个可以发布的网站。
  
  project2.sql为最终使用的数据库文件。
   
  #### ***过程中遇到的一些问题：***
  1、将html文件改成php格式后，在chrome浏览器打开时，某些元素的样式会莫名消失。
  
  2、index页面显示随机图片时，偶尔有图片无法显示。

  3、刚开始做PJ时无从下手，不知道后端的PHP怎样与前端的JS进行数据传输。
  
  4、使用jQuery处理browse页中左端筛选栏时，$选择器直接选中所有标签再向后端传参的效果不能如我所愿。
  
  5、重写导航栏代码后，details和my-photo内容页面排版出现问题。
  
  6、上传图片时，偶尔会出现选择了城市，但数据库中城市ID为0的bug。
  #### ***解决方法：***
  1、用CTRL+F5刷新页面后样式恢复正常。
  
  2、最初以为是脚本加载的问题，后来发现是生成随机图片算法的问题，修改算法后bug消失。
  
  3、在网上查阅资料后，发现可以利用jQuery中的ajax方法较为方便的进行前后端之间传参。
  
  4、发现bug出现的原因是$选择器会选中所有同类标签，向后端传递的值也是一个数组。
  解决方案是利用e.target获取鼠标点击的标签元素，只将其内容传入后端即可。
  
  5、发现bug出现的原因是导航栏中右侧下拉菜单的元素莫名其妙的凸出来挡到了下方的元素。
  解决方案是修改了下方元素的margin-top值。
  
  6、有的城市名称包含单引号，需要用addslashes()函数进行转义。
  #### ***项目中存在的不足之处：***
  1、有时候没有把代码函数化，存在一些重复、冗余的代码。
  
  2、代码中url采用的大部分是绝对路径（如http://localhost:1234/Project2/src/upload/upload.php），在其他主机上可能不能很好的运行。
  
* ### 4、Bonus的完成情况和解决?法

  #### ***完成情况:***
  
  大体上完成了bonus1：密码哈希加盐、bonus2：使用前端工具、bonus3：部署服务器。
  
  #### ***解决方法:***
  
  bonus1：哈希加盐。
  
  将用户注册时输入的明文密码，通过`password_hash($password, PASSWORD_DEFAULT)`进行加密，
  再存入数据库中的pass字段中。用户登录时，调用函数`password_verify($submit_password, $pass)`
  将用户提交的密码与数据库中的字段进行验证，若结果为`true`则判断登陆成功。
  
  bonus2：使用前端工具。
  
  本次PJ中主要使用了jQuery这个JavaScript库。jQuery是一个轻量级的JS框架，提供了许多有用的函数。
  
  使用jQuery为进行事件处理、操纵DOM和进行ajax交互提供了方便。
  
  jQuery通过$.ajax函数大大简化了前后端之间的传参操作。如browse页面中的该函数，实现了
  用户点击搜索按钮后，将搜索框内的文本数据通过POST方法提交到searchpic.php，再用
  success内定义的函数对返回值进行处理。
  ````
  $("#search-btn").click(function() {
              let x = $("#search-input").val();
              $.ajax({
                  type: "post",
                  url: "searchpic.php",
                  async:false,
                  data: {
                      "title":x
                  },
                  dataType: "json",
                  cache:true,
                  success: function (data) {
                      window.location.href = "browse.php";
                  },
                  error: function (msg) {
                      alert("shibai!");
                  }
              });
          });
  ````
  
  bonus3：部署服务器。
  
  本次PJ中采用了阿里云服务器ECS，通过宝塔linux面板搭建了网站服务器。但因时间原因，购置的域名
  在PJ提交当天还没有通过备案，暂时无法通过域名展示网站TUT
  
* ### 5、你对PJ2和本次课程的意见和建议

  通过本次PJ搭建一个可以发布的网站，增进了我对前端、后端知识的了解，在实践中巩固了
  课堂中学到的知识，并且提高了我通过搜索引擎获取想要信息的能力，我学到了很多。
