$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});




function loadplaylist(id,page){
    page = Number(page);
    pagecr = 'pagelist'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page , id } ,
        url: '/services/loadplaylist',
        success: function (result){
            if (result.html !=''){
                $('#playlistpage').empty();
                $('#playlistpage').append(result.html);
                pagerm =  document.getElementById('pagelist0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}


function loadsong(id,page){
    page = Number(page);
    pagecr = 'pagesong'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page , id } ,
        url: '/services/loadsong',
        success: function (result){
            if (result.html !=''){
                $('#songpage').empty();
                $('#songpage').append(result.html);
                pagerm =  document.getElementById('pagesong0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}


function loadplaylistcate(idmenu,idcate,page){
    page = Number(page);
    pagecr = 'pagelist'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page ,  idmenu , idcate } ,
        url: '/services/loadplaylist_cate',
        success: function (result){
            if (result.html !=''){
                $('#playlistpage').empty();
                $('#playlistpage').append(result.html);
                pagerm =  document.getElementById('pagelist0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}


function loadsongcate(idmenu,idcate,page){
    page = Number(page);
    pagecr = 'pagesong'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page , idmenu , idcate } ,
        url: '/services/loadsong_cate',
        success: function (result){
            if (result.html !=''){
                $('#songpage').empty();
                $('#songpage').append(result.html);
                pagerm =  document.getElementById('pagesong0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}



function loadplaylist_search(page,key){
    page = Number(page);
    pagecr = 'pagelist'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page , key } ,
        url: '/services/loadplaylist_search',
        success: function (result){
            if (result.html !=''){
                $('#search_playlist').empty();
                $('#search_playlist').append(result.html);
                pagerm =  document.getElementById('pagelist0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}

function loadsong_search(page,key){
    page = Number(page);
    pagecr = 'pagesong'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page , key } ,
        url: '/services/loadsong_search',
        success: function (result){
            if (result.html !=''){
                $('#search_song').empty();
                $('#search_song').append(result.html);
                pagerm =  document.getElementById('pagesong0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}


function loadsinger_search(page,key){
    page = Number(page);
    pagecr = 'pagesinger'+page;
    $.ajax({
        type: 'POST',
        datatype: 'JSON',
        data: { page , key } ,
        url: '/services/loadsinger_search',
        success: function (result){
            if (result.html !=''){
                $('#search_singer').empty();
                $('#search_singer').append(result.html);
                pagerm =  document.getElementById('pagesinger0');
                pagecurent = document.getElementById(pagecr);
                pagerm.classList.remove('active');
                pagecurent.className = pagecurent.className.replace('',"active");
            }else{
                alert('xay ra loi');
            }
        }
    })
}


