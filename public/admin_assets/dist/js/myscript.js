$(document).ready(function(){
    $(function () {
	    $(".textarea").wysihtml5();
	});

    $("#btnAdd").click(function() {
        $("#a").append('<div class="con"><input type="text" id="Text1" class="" name="properties[]" value="" />' + '<input type="button" class="btnRemove" id="btn-Remove" value="Remove"/></div>');
      });

      $('body').on('click','.btnRemove',function() {
        $(this).parent('div.con').remove()
      });


});
function FormatNumber(obj) {
    var strvalue;
    if (eval(obj))
        strvalue = eval(obj).value;
    else
        strvalue = obj; 
    var num;
    num = strvalue.toString().replace(/\$|\,/g,'');

    if(isNaN(num))
    num = "";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    num = Math.floor(num/100).toString();
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
    num = num.substring(0,num.length-(4*i+3))+','+
    num.substring(num.length-(4*i+3));
    //return (((sign)?'':'-') + num);
    eval(obj).value = (((sign)?'':'-') + num);
}
function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
   return false;
   return true;
}

$(document).ready( function ( e ){
    $('input#txtName').keyup(function(event) {
		var title, slug;
	
        title = $(this).val();

        slug = title.toLowerCase();

        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        slug = slug.replace(/ /gi, "-");
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        
        $('input#txtAlias').val(slug);
	});
});

$(document).ready(function(){
    $('#addImages').click(function(){
        $('#insert').append('<div class="form-group"><input type="file" name="fEditDetail[]"></div>');
    });
});


$('.alert_thongbao').delay(3000).slideUp();
$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });
});
// send email
$(document).ready(function(){
    $('#addFile').click(function(){
        $('#insertBtnFile').append('<div class="form-group"><input type="file" name="inpFile[]"></div>');
    });
});

$(document).ready(function(){
    $('#chkAll').change(function(event){
        var checkAll = $('#chkAll:checked').length > 0;

        if (checkAll) {
            $('input[name="chkEmail[]"]').prop('checked', true);
        }else{
            $('input[name="chkEmail[]"]').prop('checked', false);
        }
    });
});
$(document).ready(function(){

});

$(document).ready(function(){
    $('a#del_img').on('click', function(){
        var url =  homeUrl() + "/backend/product/delimg/";
        var _token = $("form[name='frmEditProduct']").find("input[name='_token']").val();
        var idImg = $(this).parent().find("img").attr("idImg");
        var img = $(this).parent().find("img").attr("src");
        var rid = $(this).parent().find("img").attr("id");
        
        $.ajax({
            url: url + idImg,
            type: 'GET',
            cache: false,
            data: {"_token":_token,"idImg":idImg,"urlImg":img},
            success: function(data){
                if (data == 'OK') {
                    $('#'+rid).remove();
                }else{
                    alert('Error ! Please contact admin !');
                }
            }
        });
    });    




    $('a#del_img_news').on('click', function(){
        var url =  homeUrl() + "/backend/news/delimg/";
        var _token = $("form[name='frmEditNews']").find("input[name='_token']").val();
        var idImg = $(this).parent().find("img").attr("idImg");
        var img = $(this).parent().find("img").attr("src");
        var rid = $(this).parent().find("img").attr("id");
        // alert(rid);
        $.ajax({
            url: url + idImg,
            type: 'GET',
            cache: false,
            data: {"_token":_token,"idImg":idImg,"urlImg":img},
            success: function(data){
                if (data == 'OK') {
                    $('#'+rid).remove();
                }else{
                    alert('Error ! Please contact admin !');
                }
            }
        });
    });


});
tinymce.init({
    selector: 'textarea#txtContent',
    
    height: 350,
    width:"100%",
    content_style: ".mce-content-body {font-size:13pt;font-family:Arial;}",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern imagetools code fullscreen"
    ],
    toolbar1: "undo redo bold italic underline strikethrough cut copy paste| alignleft aligncenter alignright alignjustify bullist numlist outdent indent blockquote searchreplace | styleselect formatselect fontselect fontsizeselect ",
    toolbar2: "table | hr removeformat | subscript superscript | charmap emoticons ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft | link unlink anchor image media | insertdatetime preview | forecolor backcolor print fullscreen code ",
    image_advtab: true,
    menubar: false,
    toolbar_items_size: 'small',

    relative_urls: false, 
    remove_script_host : false,
    filemanager_title:"Media Manager",  
    external_filemanager_path: homeUrl() + "/file/",
    external_plugins: { "filemanager" : homeUrl() + "/file/plugin.min.js"},
});