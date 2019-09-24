layui.define(['layer', 'table', 'upload', 'element'], function (exports) {
    var $ = layui.jquery;
    var layer = layui.layer;
    var table = layui.table;
    var upload = layui.upload;
    var element = layui.element;

    var imgExt = new Array(".png", ".jpg", ".jpeg", ".bmp", ".gif");//图片文件的后缀名
    // var docExt = new Array(".doc", ".docx");//word文件的后缀名
    // var xlsExt = new Array(".xls", ".xlsx");//excel文件的后缀名
    // var cssExt = new Array(".css");//css文件的后缀名
    // var jsExt = new Array(".js");//js文件的后缀名
    var setParam = '';
    var setdata = '';
    var setDom = '';
    var fileManager = {
        // 渲染树形表格
        render: function (param) {
            setParam = param;
            // 检查参数
            // if (!treetable.checkParam(param)) {
            //     return;
            // }
            // 获取数据
            if (param.data) {
                fileManager.init(param, param.data);
            } else {
                $.getJSON(param.url, param.where, function (res) {
                    fileManager.init(param, res.data);
                });
            }
        },
        // 渲染表格
        init: function (param, data) {
            var doneCallback = param.done;

            var type = fileManager.isEmptyObj(param.type) ? 1 : param.type;
            var title = fileManager.isEmptyObj(param.title) ? '选择图片' : param.title;
            var closeBtn = fileManager.isEmptyObj(param.closeBtn) ? 1 : param.closeBtn;
            var shadeClose = fileManager.isEmptyObj(param.shadeClose) ? false : param.shadeClose;
            var skin = fileManager.isEmptyObj(param.skin) ? '' : param.skin;
            var multiple = fileManager.isEmptyObj(param.multiple) ? false : param.multiple;
            var refresh = param.refresh ? true : false;

            var fileDom = '';
            if (data) {
                for (const i of Object.keys(data)) {
                    if (fileManager.typeMatch(imgExt, data[i])) {
                        fileDom +=
                            '<div class="layui-col-xs12 layui-col-sm6 layui-col-md2 fm-div">' +
                            '<span >' +
                            '<img class="fm-image"' +
                            'src="/static/images/' + data[i] + '">' +
                            '<div style="width: 100px;text-align: center;" class="layui-row">' + data[i] + '</div>' +
                            '</span>' +
                            '</div>';
                    }
                    else {
                        fileDom +=
                            '<div class="layui-col-xs12 layui-col-sm6 layui-col-md2 fm-div">' +
                            '<span >' +
                            '<img class="fm-image"' +
                            'src="/static/admin/images/filemanager/folder.png">' +
                            '<div style="width: 100px;text-align: center;" class="layui-row">' + data[i] + '</div>' +
                            '</span>' +
                            '</div>';
                    }
                }
            }
            var FILE_DOM =
                '<div style="padding: 50px;background-color: white;">' +
                '<div class="layui-row k">' +
                '<div class="layui-col-xs6 layui-col-md12">' +
                '<div class="layui-btn-container">' +
                '<button type="button" class="layui-btn layui-btn-primary refresh"><i ' +
                'class="layui-icon layui-icon-refresh-3"></i>刷新</button>' +
                '<button type="button" class="layui-btn layui-btn-primary"><i ' +
                'class="layui-icon layui-icon-add-1"></i>新建文件夹</button>' +
                '<button type="button" class="layui-btn layui-btn-blue" id="test7"><i ' +
                'class="layui-icon layui-icon-upload"></i>上传图片</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr class="k" style="border-top: 4px solid #eee;">' +
                '<div class="layui-row k">' +
                '<div class="layui-col-xs6 layui-col-md12">' +
                '<div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">' +
                '<a lay-href="">首页</a><span lay-separator="">/</span>' +
                '<a>演示</a><span lay-separator="">/</span>' +
                '<a><cite>元素</cite></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr class="k" style="border-top: 4px solid #eee;">' +
                '<div class="layui-row k">' +
                '<div class="layui-col-xs6 layui-col-md12">' +
                '<div class="layui-row layui-col-space20">' +
                fileDom +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';


            if (refresh) {
                return FILE_DOM;
            }
            else {
                var w, h;
                if (w == null || w == '') {
                    w = ($(window).width() * 0.65);
                };
                if (h == null || h == '') {
                    h = ($(window).height() - 200);
                };

                layer.open({
                    area: [w + 'px', h + 'px'],
                    type: type,
                    title: title,
                    closeBtn: closeBtn,
                    shadeClose: shadeClose,
                    skin: skin,
                    shade: 0.3,
                    content: FILE_DOM
                });
                //设定文件大小限制
                upload.render({
                    elem: '#test7'
                    , url: '/upload/'
                    , size: 60 //限制文件大小，单位 KB
                    , done: function (res) {
                        console.log(res)
                    }
                });
            }
        },
        //空值判断
        isEmptyObj: function (obj) {
            for (var key in obj) {
                if ({}.hasOwnProperty.call(obj, key)) return false;
            }
            return true;
        },
        // 检查参数
        checkParam: function (param) {
            if (!param.treeSpid && param.treeSpid != 0) {
                layer.msg('参数treeSpid不能为空', { icon: 5 });
                return false;
            }

            if (!param.treeColIndex && param.treeColIndex != 0) {
                layer.msg('参数treeColIndex不能为空', { icon: 5 });
                return false;
            }
            return true;
        },
        //判断是否为
        typeMatch: function (type, fielname) {
            //获取文件名后缀名
            var ext = null;
            var name = fielname.toLowerCase();
            var i = name.lastIndexOf(".");
            if (i > -1) {
                var ext = name.substring(i);
            }
            //判断Array中是否包含某个值
            for (var i = 0; i < type.length; i++) {
                if (type[i] === ext)
                    return true;
            }
            return false;
        }
    };

    layui.link(layui.cache.base + 'fileManager/fileManager.css');


    $('body').on('click', '.refresh', function () {
        var dom = fileManager.render({
            refresh: true,
            url: setParam.url,
        });
        console.log("TCL: dom", dom)
        $('.layui-layer-content').html(dom);
    });
    // 给图标列绑定事件
    $('body').on('click', '.treeTable .treeTable-icon', function () {
        var treeLinkage = $(this).parents('.treeTable').attr('treeLinkage');
        if ('true' == treeLinkage) {
            treetable.toggleRows($(this), true);
        } else {
            treetable.toggleRows($(this), false);
        }
    });
    exports('fileManager', fileManager);
});
