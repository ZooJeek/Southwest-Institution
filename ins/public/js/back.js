//jquery
article_type = 1;
work_face = '';
member_face = '';
teamData = null;
var typeWords= new Array('null','通知公告','工作动态','学术交流','科研成果','机构概况','联系我们','研究团队','文章管理');
var tok=$('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': tok
    }
});

$("#addFace").mouseenter(function() {
$("#faceBlock").show();
});
$("#addFace").mouseleave(function() {
$("#faceBlock").hide();
});
$("#addPhoto").mouseenter(function(){
    $('#memberPhoto').show();
});
$("#addPhoto").mouseleave(function(){
    $('#memberPhoto').hide();
});
//layui
var editIndex;
layui.use('element', function(){
  var element = layui.element;
});
layui.use(['layedit','layer','form'], function(){
    var layedit = layui.layedit;
    var layer = layui.layer;
    var layFrom = layui.form;
    layedit.set({
        uploadImage: {
            url: '/uploadImg' //接口url
            ,type: 'post' //默认post
        }
    });
    editIndex = layedit.build('content',{height:550});
    editMember = layedit.build('editMember',{height:550});
    editField = layedit.build('editField',{height:550});
    $("#sendArticle").click(function(){
        if(article_type==5 || article_type==6){
            var strT=new Array();
            strT[5]="机构概况";
            strT[6]="联系我们";
            var content = layedit.getContent(editIndex);
            $.post("/articleUp",
                {
                    article_content:content,
                    article_title:strT[article_type],
                    article_author:"admin",
                    article_photo:"none",
                    article_check:"none",
                    article_from:"none",
                    article_note:"none",
                    article_type:article_type,
                    article_face:"none"
                },
                function(data,status){
                    if(data == 'done'){
                        layer.msg('发布成功！');
                        work_face='';
                    }
                    else
                        alert("test");
                }
            );
            return 0;
        }

        var article_content = layedit.getContent(editIndex);
        var article_author = $('#article_author').val();
        var article_photo = $('#article_photo').val();
        var article_check = $('#article_check').val();
        var article_from = $('#article_from').val();
        var article_note = $('#article_note').val();
        var article_title = $('#article_title').val();
        $.post("/articleUp",
            {
                article_content:article_content,
                article_title:article_title,
                article_author:article_author,
                article_photo:article_photo,
                article_check:article_check,
                article_from:article_from,
                article_note:article_note,
                article_type:article_type,
                article_face:work_face
            },
            function(data,status){
                if(data == 'done'){
                    layer.msg('发布成功！');
                    work_face='';
                }
                else
                    alert("test");
            }
        );
    });

    $("#sendMember").click(function(){
        var memberName = $("#memberName").val();
        var memberText = layedit.getContent(editMember);
        var memberFace = member_face;
        var memberField = $("#memberField").val();
        $.post('/manage/createMember',{
            memberName:$("#memberName").val(),
            memberArticle:layedit.getContent(editMember),
            memberFace:member_face,
            memberField:$("#memberField").val()
        },function(data,status){
            if(data=='y'){
                layer.msg('成员创建成功！');
                teamBack();
                teamRefresh();
            }
            else{
                layer.msg('创建失败！');
            }
        });
    });

    $('#changePwd').click(function(){
        layer.open({
            type: 1,
            title:'更改密码', 
            content: $('#changePwdWindow') //这里content是一个普通的String
        });
    });

    $('#fieldButton').click(function(){
        $.post('/manage/createField',
            {
                fieldText:layedit.getContent(editField),
                fieldName:$('#fieldName').val()
            },
            function(data,status){
                if(data == 'y'){
                    layer.msg('创建成功！');
                }else{
                    layer.msg('创建失败！');
                }
                teamBack();
                teamRefresh();
            }
        );
    });
});

layui.use(['upload','layer'], function(){
  var upload = layui.upload;
  var layer = layui.layer;
  var uploadInst = upload.render({
    elem: '#addFace' //绑定元素
    ,url: '/addFace' //上传接口
    ,method: 'post'
    ,done: function(res){
        work_face = res.src;
        layer.msg('更改成功：'+work_face);
        $('#faceImg').attr('src',work_face);
    }
    ,error: function(index){
        layer.msg('上传失败'); 
    }
  });

  var uploadMember = upload.render({
    elem:'#addPhoto',
    url:"/addFace",
    method:'post',
    done:function(res){
        member_face=res.src;
        layer.msg('更改成功：' + res.src);
        $('#memberImg').attr('src',res.src);
    },
    error:function(index){
        layer.msg('上传失败'); 
    }
  });
});

function changeType(a){
    if(article_type == a)
        return ;
    article_type=a;

    $('#article_body').css('display','block');
    $('#team_body').css('display','none');
    $('#artiMana_body').css('display','none');
    $(".hid").show();
    $('#contentText').hide();
    $('#addFace').css('display','none');
    if(article_type == 2){
        $('#addFace').css('display','block');
    }
    if(article_type == 7){
        $('#article_body').css('display','none');
        $('#team_body').css('display','block');
    }
    if(article_type == 8){
        $('#article_body').css('display','none');
        $('#artiMana_body').css('display','block');
    }
    work_face = '';
    $('#typeName').html(typeWords[article_type]);
    if(article_type == 5 || article_type == 6){
        $(".hid").hide();
        $('#contentId').text(typeWords[article_type]);
        $('#contentText').show();
    }
}

function createWindow(a){
    if(a == 'member'){
        $('#team_mana').css('display','none');
        $('#createField').css('display','none');
        $('#createMember').css('display','block');
        $('#typeName').html('创建新成员');
        return ;
    }
    if(a == 'Filed'){
        $('#team_mana').css('display','none');
        $('#createMember').css('display','none');
        $('#createField').css('display','block');
        $('#typeName').html('创建研究方向');
    }
}

function teamBack(a){
    $('#team_mana').css('display','block');
    $('#createField').css('display','none');
    $('#createMember').css('display','none');
    $('#typeName').html('研究团队');
}

function teamRefresh(){
    var teamInfo;
    var fieldSelect;
    var i;
    var str,fieldListStr;
    fieldListStr = '<tr><td>{name}</td><td>{text}</td><td><button class="layui-btn layui-btn-danger" onclick="delField({field_key});">删除</button></td></tr>';
    memberListStr = '<tr><td>{name}</td><td>{fie}</td><td>{time}</td><td><button class="layui-btn layui-btn-danger" onclick="delMember({member_key})">删除</button></td></tr>'
    fieldSelect = document.getElementById('memberField');
    fieldList = document.getElementById('fieldList');
    memberList = document.getElementById('memberList');
    memberList.innerHTML='';//清空成员表
    fieldList.innerHTML = "";//清空列表
    fieldSelect.innerHTML = "";//清空下拉菜单
    $.ajax({url:"/manage/teamRefresh",success:function(result){
        teamInfo = JSON.parse(result);
        for(i=0;i<teamInfo.field.tot;i++){
            //保存研究方向信息
            f_key = teamInfo.field[i].field_key;
            f_name = teamInfo.field[i].field_name;
            f_text = teamInfo.field[i].field_article;
            f_text = f_text.substring(0,35);
            f_time = teamInfo.field[i].field_time;
            //渲染研究方向信息
            str = '<option value="' + f_key+'">' + f_name + '</option>';
            fieldSelect.innerHTML += str;
            str = fieldListStr;
            str = str.replace(/{name}/,f_name);
            str = str.replace(/{text}/,f_text);
            str = str.replace(/{time}/,f_time);
            str = str.replace(/{field_key}/,f_key);
            fieldList.innerHTML += str;
        }

        for(i=0;i<teamInfo.member.tot;i++){
            member_key=teamInfo.member[i].member_key;
            member_time=teamInfo.member[i].member_time;
            member_fie=teamInfo.member[i].member_fie;
            member_name=teamInfo.member[i].member_name;
            str=memberListStr;
            str = str.replace(/{name}/,member_name);
            str = str.replace(/{fie}/,member_fie);
            str = str.replace(/{time}/,member_time);
            str = str.replace(/{member_key}/,member_key);
            memberList.innerHTML+=str;
        }

        teamData = teamInfo;
        layui.use(['form'],function(){
            var varForm=layui.form;
            varForm.render();
        });
    }});
}
teamRefresh();

function delField(a){
    $.ajax({
        url:"/manage/delField/" + a,
        success:function(res){
            if(res > 0)
                alert('删除成功！');
            else
                alert('删除失败！');
            teamRefresh();
        }
    });
}

function delMember(a){
    $.ajax({
        url:"/manage/delMember/" + a,
        success:function(res){
            if(res > 0)
                alert('删除成功！');
            else
                alert('删除失败！');
            teamRefresh();
        }
    });
}

function delArticle(a){
    $.ajax({
        url:"/manage/delArticle/" + a,
        success:function(res){
            if(res > 0)
                alert('删除成功！');
            else
                alert('删除失败！');
            location.reload();
        }
    });
}

function changePwdSubmit(){
    var pwd = $('#newPwd').val();
    if(pwd.length < 6){
        alert("密码太短！");
        return;
    }
    $.ajax({
        url:"/changePwd/"+pwd,
        success:function(res){
            if(res=="y"){
                alert("修改成功！");
            }else{
                alert("出现错误！");
            }
        }
    });
}
