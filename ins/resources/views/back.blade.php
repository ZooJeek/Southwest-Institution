<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理</title>
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="layui/css/layui.css">
  <link rel="stylesheet" href="css/back.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">研究院后台管理系统</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
      <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          {{ $userName }}
        </a>
        <dl class="layui-nav-child">
          <dd><a id='changePwd'>更改密码</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/logout">退出</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item">
          <a href="javascript:;">首页内容</a>
          <dl class="layui-nav-child">
            <dd><a href="javascript:changeType(5);">机构概况</a></dd>
            <dd><a href="javascript:changeType(6);">联系我们</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item  layui-nav-itemed">
          <a class="" href="javascript:;">新建文章</a>
          <dl class="layui-nav-child">
            <dd class="layui-this"><a href="javascript:changeType(1);">通知公告</a></dd>
            <dd><a href="javascript:changeType(2);">工作动态</a></dd>
            <dd><a href="javascript:changeType(3);">学术交流</a></dd>
            <dd><a href="javascript:changeType(4);">科研成果</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item"><a href="javascript:changeType(7);">研究团队</a></li>
        <li class="layui-nav-item"><a href="javascript:changeType(8);">文章管理</a></li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <i class="layui-icon" style="float: left;font-size: 20px;margin:7px 0px 7px 20px;color: #3898db;">&#xe623;</i><p id="typeName" style="font-size: 20px;margin:7px 0px 7px 0px;float: left;color: #333;">通知公告</p>
    <div style="float: left;width: 100%;height: 1px;background: #3998db;"></div>
    
    <div style="width: 100%;height: 100%;overflow: hidden;margin-top: 10px;float: left;" id="article_body">
      <form action="" class="layui-form" style="margin-top: 5px;width: 97%;height: 16%;">
          <div class="layui-form-item hid">
            <div class="layui-form-label" style="width: 100px;">文章标题：</div>
            <div class="layui-input-block">
              <input type="text" class="layui-input" id="article_title" placeholder="请输入标题">
            </div>
          </div>
          
          <div class="layui-form-item" id="article_info">
            <div class="layui-form-label hid" style="width: 80px;margin-left: 10px;">作者：</div>
            <div class="layui-input-block hid">
                <input type="text" class="layui-input" id="article_author" >
            </div>
            <div class="layui-form-label hid" style="width: 80px;">摄影：</div>
            <div class="layui-input-block hid">
                <input type="text" class="layui-input" id="article_photo" >
            </div>
            <div class="layui-form-label hid" style="width: 80px;">审核：</div>
            <div class="layui-input-block hid">
                <input type="text" class="layui-input" id="article_check" >
            </div>
            <div class="layui-form-label hid" style="width: 80px;">来源：</div>
            <div class="layui-input-block hid">
                <input type="text" class="layui-input" id="article_from" >
            </div>
            <div class="layui-form-label hid" style="width: 80px;">备注：</div>
            <div class="layui-input-block hid">
                <input type="text" class="layui-input" id="article_note" >
            </div>
            
            <button id="addFace" type="button" class="layui-btn layui-btn-sm" style="float: left;margin-left:20px;display: none; ">
              <i class="layui-icon">&#xe654;</i>上传封面
            </button>
            <div id="faceBlock" style="float: left;z-index: 999;width: 200px;height: 200px;margin-left: -200px;margin-top: -200px;position: relative;top:240px;left: 0px;display: none;">
              <img src="" id="faceImg" style="width: 200px;">
            </div>
            <button id="sendArticle" type="button" class="layui-btn layui-btn-sm" style="float: left;margin-left:15px; "><i class="layui-icon">&#xe609;</i>发布</button>
            <div id="contentText" style="float: left;font-size: 20px;clear: left;margin-left: 12px;margin-top: 12px;display: none;">
              下面填写的内容,将在点击首页的［<span id="contentId">联系我们</span>］栏目后展示。
            </div>
          </div>

      </form>
      <div style="width: 98%;margin-left: 1%;height: 80%;float: left;">
        <div class="layui-form-label" style="width: 100px;">文章内容：</div>
        <textarea id="content" style="display: none;"></textarea>
      </div>
    </div>
    
    <div id="team_body" style="width: 100%;height: 100%;overflow-y:auto;display: none;float: left;">
      <div class="layui-tab layui-tab-card" style="height: 100%;width: 100%;" id="team_mana">
        <ul class="layui-tab-title">
          <li class="layui-this">研究成员</li>
          <li>研究方向</li>
        </ul>
        <div class="layui-tab-content">
          <div class="layui-tab-item layui-show" >
            <button class="layui-btn" onclick="createWindow('member');">创建新成员</button>
            <table class="layui-table" lay-skin="nob" lay-even>
              <colgroup>
                <col width="150">
                <col width="200">
                <col width="200">
                <col width="150">
              </colgroup>
              <thead>
                <tr>
                  <th>姓名</th>
                  <th>研究方向</th>
                  <th>创建时间</th>
                    <th>操作</th> 
                </tr> 
              </thead>
              <tbody  style="overflow-y:auto;" id="memberList">
              </tbody>
            </table>
          </div>
          <div class="layui-tab-item">
            <button class="layui-btn" onclick="createWindow('Filed')">创建研究方向</button>
            <table class="layui-table" lay-even lay-skin="nob">
              <colgroup>
                <col width="150">
                <col width="300">
                <col width="150">
              </colgroup>
              <thead>
                <tr>
                  <th>名称</th>
                  <th>介绍</th>
                  <th>操作</th>
                </tr> 
              </thead>
              <tbody style="overflow-y:auto;" id="fieldList">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div id="createMember" style="width: 100%;height: 100%;overflow-y:auto;float: left;display: none;">
        <div style="width: 98%;margin-left: 1%;height: 80%;float: left;">
          <button onclick="teamBack();" class="layui-btn layui-btn-normal" style="float: right;margin: 5px 0px 5px 0px;">
            返回<i class="layui-icon">&#xe65c;</i>
          </button>
          <div style="height: 50px;width: 100%;margin-top: 5px;">
            <div class="layui-form-label" style="float: left;">姓名:</div>
            <div class="layui-input-block"  style="float: left;margin-left: 2px;">
              <input type="text" class="layui-input" id="memberName">
            </div>
            <button class="layui-btn" style="float: left;" id="addPhoto">成员照片</button>

            <div id="memberPhoto" style="float: left;z-index: 999;width: 200px;height: 200px;margin-left: -200px;margin-top: -200px;position: relative;top:240px;left: 0px;display: none;">
              <img src="" id="memberImg" style="width: 200px;">
            </div>


            <p style="font-size: 15px;margin:8px 10px 0px 50px;float:left;text-align: right;">
              研究方向: 
            </p>
            <div class="layui-form" style="float:left;margin-left: 0px;width: 300px;padding: 0px;">
              <div class="layui-input-block" style="margin: 0px;">
                <select name="city" lay-verify="required" id="memberField">
                </select>
              </div>
            </div>
            <button class="layui-btn" style="margin-left: 20px;" id="sendMember">确认添加</button>
          </div>
          <div style="float: left;width: 100%;">
            <div class="layui-form-label" style="width: 100px;">资料介绍：</div>
            <textarea id="editMember" style="display: none;"></textarea>
          </div>
        </div>
      </div>

      <div id="createField" style="width: 100%;height: 100%;overflow-y:auto;float: left;display: none;">
        <div style="width: 98%;margin-left:1%;height: 80%;float: left;">
          <div style="height: 50px;width: 100%;margin-top: 15px;float: left;">
            <div class="layui-form-label" style="float: left;width: 130px;">研究方向名称:</div>
            <div class="layui-input-block"  style="float: left;margin-left: 2px;width: 700px;">
              <input type="text" class="layui-input" id="fieldName">
            </div>
            <button class="layui-btn" style="float: left;" id="fieldButton">确认创建</button>
            <button onclick="teamBack();" class="layui-btn layui-btn-normal" style="float: right;margin: 0px 30px 5px 0px;">
              返回<i class="layui-icon">&#xe65c;</i>
            </button>
          </div>

          <div class="layui-form-label" style="width: 100px;float: left;">资料介绍：</div>
          <textarea id="editField" style="display: none;float: left;"></textarea>
        </div>
      </div>

    </div>

    <div id="artiMana_body" style="width: 100%;height: 100%;overflow: hidden;display: none;float: left;">
      <div class="layui-tab layui-tab-card" style="height: 100%;width: 100%;">
        <ul class="layui-tab-title">
          <li class="layui-this">通知公告</li>
          <li>工作动态</li>
          <li>学术交流</li>
          <li>科研成果</li>
        </ul>
        <div class="layui-tab-content" style="height: 100px;">
          <div class="layui-tab-item layui-show">
            <table class="layui-table" lay-even lay-skin="nob">
              <colgroup>
                <col width="150">
                <col width="300">
              </colgroup>
              <thead>
                <tr>
                  <th>标题</th>
                  <th>操作</th>
                </tr> 
              </thead>
              <tbody style="overflow-y:auto;" id="noteList">
                @foreach($noteList as $note)
                <tr>
                  <td>{{ $note->article_title }}</td>
                  <td>
                    <button class="layui-btn layui-btn-danger" onclick="delArticle({{$note->article_key}});">
                      删除
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="layui-tab-item">
            <table class="layui-table" lay-even lay-skin="nob">
              <colgroup>
                <col width="150">
                <col width="300">
              </colgroup>
              <thead>
                <tr>
                  <th>标题</th>
                  <th>操作</th>
                </tr> 
              </thead>
              <tbody style="overflow-y:auto;" id="workList">
                @foreach($workList as $work)
                <tr>
                  <td>{{ $work->article_title }}</td>
                  <td>
                    <button class="layui-btn layui-btn-danger" onclick="delArticle({{$work->article_key}});">
                      删除
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="layui-tab-item">
            <table class="layui-table" lay-even lay-skin="nob">
              <colgroup>
                <col width="150">
                <col width="300">
              </colgroup>
              <thead>
                <tr>
                  <th>标题</th>
                  <th>操作</th>
                </tr> 
              </thead>
              <tbody style="overflow-y:auto;" id="studyList">
                @foreach($studyList as $study)
                <tr>
                  <td>{{ $study->article_title }}</td>
                  <td>
                    <button class="layui-btn layui-btn-danger" onclick="delArticle({{$study->article_key}});">
                      删除
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="layui-tab-item">
            <table class="layui-table" lay-even lay-skin="nob">
              <colgroup>
                <col width="150">
                <col width="300">
              </colgroup>
              <thead>
                <tr>
                  <th>标题</th>
                  <th>操作</th>
                </tr> 
              </thead>
              <tbody style="overflow-y:auto;" id="scienceList">
                @foreach($scienceList as $science)
                <tr>
                  <td>{{ $science->article_title }}</td>
                  <td>
                    <button class="layui-btn layui-btn-danger" onclick="delArticle({{$science->article_key}});">
                      删除
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    ———西南山地特色植物种质适应与利用研究所后台管理
  </div>
</div>

<div id="changePwdWindow" style="width: 300px;height: 60px;background: white;display: none;padding: 10px;">
  新密码： <input type="password" id="newPwd">
  <button onclick="changePwdSubmit();"> 确认 </button>
</div>

</body>

<script src="/js/global.js"></script>
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/layui/layui.js"></script>
<script src="/js/back.js"></script>
</html>