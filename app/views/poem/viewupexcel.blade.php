@extends('layouts.adIndex')
@section('title')
	上传excel表格（是导入伴奏的表格）
@stop
@section('search')

@stop
@section('crumbs')
	上传excel表格（是导入伴奏的表格）
@stop
@section('content')
	<script type="text/javascript" src="<?php echo asset('js/plupload/plupload.full.min.js');?>"></script>
	<h1>上传excel表格（是导入伴奏的表格）</h1>
	<div id="filelist">浏览器没有 Flash, Silverlight or HTML5 的支持.</div>
	<br />
	<div id="container">
	    <a id="pickfiles" href="javascript:;">[选择excel表格]</a> 
	    <a id="uploadfiles" href="javascript:;">[上传excel表格]</a>
	</div>
	<br />
	<pre id="console"></pre>
<script type="text/javascript">
// Custom example logic
var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass an id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : '<?php echo url('/admin/adminViewUpExcel');?>',
	flash_swf_url : '<?php echo asset('js/plupload/Moxie.swf');?>',
	silverlight_xap_url : '<?php echo asset('js/plupload/Moxie.xap');?>',
	
	filters : {
		max_file_size : '5mb',
		mime_types: [
 			{title : "xls files", extensions : "xls"},
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';
			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},
		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},
		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},
		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		},
		FileUploaded:function(up,file,result){ 
			if(result.response != null){
				alert(result.response); 
			}
		}
	}
});

uploader.init();

</script>
@stop

