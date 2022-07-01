$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success:function (result){
                if(result.error === true){
                    return false;
                }else {
                    return true
                }
            }
        })
}




function change_active(active,url){
    // console.log(url);
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { active },
        url: url,
        success:function (result){
            if(result.error === true){
            }else {
                // alert('Xóa thành công');
                // location.reload();
                if(result.active==1){
                    var parent_id= 'parent_active_'+result.id;
                    var id='menu-no-'+result.id;
                    var child = document.getElementById(id);
                    child.parentNode.removeChild(child);
                    var replace="<span id='menu-yes-"+result.id+"' class='btn btn-success btn-xs' onclick=change_active("+ result.active +",'"+url+"')>Yes</span>";
                    document.getElementById(parent_id).innerHTML=replace;
                }else {
                    var id='menu-yes-'+result.id;
                    var parent_id= 'parent_active_'+result.id;
                    var parent= document.getElementById(parent_id);
                    var child = document.getElementById(id);
                    child.parentNode.removeChild(child);
                    var replace="<span id='menu-no-"+result.id + "' class='btn btn-danger btn-xs' onclick=change_active("+ result.active +",'"+ url +"')>No</span>";
                    parent.innerHTML=replace;
                }
            }
        }
    })
}
//upload file

$('#upload').change(function (){
   const form =new FormData();
   form.append('avatar',$(this)[0].files[0]);
   $.ajax({
       processData: false,
       contentType: false,
       type: 'POST',
       datatype: 'JSON',
       data: form,
       url: '/admin/upload/service',
       success: function (results){
           if(results.error === false){
               $('#avatar_show').html('<a href=" ' + results.url + '" target="_blank">' +
                   '<img src="' + results.url + '" width="100px"></a>');
               // $('#img_show').html('<audio controls href=" ' + results.url + '" target="_blank">' +
               //         '<source src="' + results.url + '" type="audio/mpeg"></audio>');
               $('#file').val(results.url);
           }else {
               alert('Tải hình bị lỗi');
           }
       }
   })
});




//upload filethumb

$('#upload_thumb').change(function (){
    const form =new FormData();
    form.append('thumb',$(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        datatype: 'JSON',
        data:form,
        url: '/admin/upload_thumb/services',
        success: function (results){
            if(results.error == false){
                $('#thumb_show').html('<a href=" ' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a>');
                // $('#img_show').html('<audio controls href=" ' + results.url + '" target="_blank">' +
                //         '<source src="' + results.url + '" type="audio/mpeg"></audio>');
                $('#thumb').val(results.url);
            }else {
                alert('Tải file bị lỗi');
            }
        }
    })
});

//upload filesong
$('#upload_song').change(function (){
    const form =new FormData();
    form.append('file_song',$(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        datatype: 'JSON',
        data:form,
        url: '/admin/upload_song/services',
        success: function (results){
            if(results.error == false){
     /*           $('#song_show').html('<a href=" ' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a>');*/
                $('#song_show').html('<audio controls href=" ' + results.url + '" target="_blank">' +
                        '<source src="' + results.url + '" type="audio/mpeg"></audio>');
                $('#file_song').val(results.url);
            }else {
                alert('Tải file bị lỗi');
            }
        }
    })
});


