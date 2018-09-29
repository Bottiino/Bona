$(function(){
    $(document).off("submit", "form#loginForm").on("submit", "form#loginForm", function(e){
        e.preventDefault();
        
        var formData = {
            password : $('input[name=password]').val(),
            username : $('input[name=username]').val()
        };
            
        $.ajax({
            type: "POST",
            url: "Processing/login.php",
            data: formData,
            success: function(data){
                if (data === 'success') {
                    window.location = 'index.php';
                } else {
                    $('section#error').show();
                    $('div#error').html(data);
                }
            },
            error: function(data){
                $('section#error').show();
                $('div#error').html(data);
            }
        });
    });     
    
    //$(document).off("submit", "form#regForm").on("submit", "form#regForm", function(e){
    $(document).on('submit','form#regForm',function(e){
        e.preventDefault();

        var sub = $(this).find('input#cbEmailSubscribe').prop('checked');

        var formData = new FormData($(this)[0]);
        formData.append("g-recaptcha", grecaptcha.getResponse());
        formData.set("cbEmailSubscribe", sub);
        
        $.ajax({
            type: "POST",
            url: "Processing/register.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                if (data === 'success') {
                    window.location = 'index.php';
                } else{
                    $('section#error').show();
                    $('div#error').html(data);
                }
            },
            error: function(data){
                $('section#error').show();
                $('div#error').html(data);
            }
        });
    });
    
    $(document).off("submit", "form#postForm").on("submit", "form#postForm", function(e){
        e.preventDefault();
        
        var formData = {
            postTopic : $('input[name=postTopic]').val(),
            postTitle : $('input[name=postTitle]').val(),
            postText : $('input[name=postText]').val(),
            feedback : $('input[name=feedback]:checked').val()
        };        
            
        $.ajax({
            type: "POST",
            url: "Processing/post.php",
            data: formData,
            success: function(data){
                if (data === 'success') {                    
                    window.location = 'index.php';                    
                }
                else {
                    $('section#error').show();
                    $('div#error').html(data);
                }
            },
            error: function(data){
                $('section#error').show();
                $('div#error').html(data);
            }            
        });        
    }); 
    
    $(document).off("submit", "form#commentForm").on("submit", "form#commentForm", function(e){
        e.preventDefault();
        
        var formData = {
            commentText : $('textarea[name=commentText]').val(),
            postID : $('input[name=postID]').val()
        };        
        $.ajax({
            type: "POST",
            url: "Processing/comment.php",
            data: formData,
            success: function(data){
                if (data === 'success') {
                    $('div#error').hide();
                    document.getElementById("commentText").value = "";
                    location.reload();
                    
                }                
                else if(data === "Your text contains some prohibated words!"){
                    $('section#error').show();
                    $('div#error').html(data);
                } 
                else{
                    window.location = 'loginForm.php?' + data;
                }
            },
            error: function(data){
                $('section#error').show();
                $('div#error').html(data);
            }            
        });    
    });
    
    $(document).off("submit", "form#searchForm").on("submit", "form#searchForm", function(e){
        e.preventDefault();
        
        var formData = {
            username : $('input[name=username]').val(),
            tag : $('input[name=tag]').val(),
            keyword : $('input[name=keyword]').val()
        };        
            
        SearchByValues(formData);
    });
    
    $(document).off("click", "a.like").on("click", "a.like", function(e){
        e.preventDefault();
        
        var postID = $(this).closest('form.likeForm').find('input[name=postID]').val();
        
        $.ajax({
            type: "POST",
            url: "Processing/like.php",
            data: {postID: postID},
            success: function(data){
                if (data === 'success') {
                    location.reload();
                }
                else{
                    window.location = 'loginForm.php?' + data;
                }
            },
            error: function(data){
                $('section#error').show();
                $('div#error').html(data);
            }            
        });        
    });    
    
    $(document).off("click", "a.dislike").on("click", "a.dislike", function(e){
        e.preventDefault();
        
        var postID = $(this).closest('form.likeForm').find('input[name=postID]').val();
        
        $.ajax({
            type: "POST",
            url: "Processing/dislike.php",
            data: {postID: postID},
            success: function(data){
                
                if (data === 'success') {
                    location.reload();
                }
                else if(data === 'error'){
                    $('div#error').html('Thank you for subscribing!');
                }
                else{                    
                    window.location = 'loginForm.php?' + data;
                }
            },
            error: function(data){
                alert(data);
                $('section#error').show();
                $('div#error').html(data);
            }            
        });        
    });            
    
    $(document).off("submit", "form#subscribe").on("submit", "form#subscribe", function(e){
        e.preventDefault();
        
        var email = $('input[name=email]').val();
            
        $.ajax({
            type: "POST",
            url: "Processing/subscribe.php",
            data: {email: email},
            success: function(data){
                if (data === 'success') {
                    $('section#error').show();
                    $('div#error').html('Thank you for subscribing!');
                    document.getElementById("commentText").value = "";
                } else {
                    $('section#error').show();
                    $('div#error').html(data);
                }
            },
            error: function(data){
                $('section#error').show();
                $('div#error').html(data);
            }
        });
    });  
    
    $(document).off('click', 'a.tag').on('click', 'a.tag', function(e){
        e.preventDefault();
        
        window.location = 'searchForm.php?username=&tag=' + $(this).text() + '&keyword=';
        
        $('section#searchForm').hide();
    });
    
    $(document).off('click', 'a.user').on('click', 'a.user', function(e){
        e.preventDefault();
        
        window.location = 'searchForm.php?username=' + $(this).text() + '&tag=&keyword=';
        
        $('section#searchForm').hide();
    });
    
    $(document).ready(function($) {
        $('.capital').keyup(function(event) {
            var textBox = event.target;
            var start = textBox.selectionStart;
            var end = textBox.selectionEnd;
            textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1);
            textBox.setSelectionRange(start, end);
        });
    });
    
    $(document).off("change", "input#cbTermsConditions").on("change", "input#cbTermsConditions", function(e){
        if ($(this).prop('checked')) {
            $('button#form-submit').removeClass('btnDisabled').prop('disabled', false);
        } else {
            $('button#form-submit').addClass('btnDisabled').prop('disabled', true);
        }
    });  
});

function SearchByValues(formData)
{
    $.ajax({
        type: "POST",
        url: "Processing/search.php",
        data: formData,
        dataType: 'json',
        success: function(data){                
            $('div#postContainer').html('<div class="row"></div>');
            if (data.length > 0) {
                for(var i = 0; i < data.length; i++)
                {
                    var post = data[i];
                    $('div#postContainer div.row').append(
                        '<div class="col-lg-4 col-md-6">' +
                            '<div class="card h-100">' +
                                '<div class="single-post post-style-1">' +
                                    '<div class="blog-image">' +
                                        '<img src="bg/' + post.imageNum + '.jpg" alt="Blog Image" />' +
                                    '</div>' +
                                        '<a id="avatar" class="avatar" href="postInfo.php?postID=' + post.postID + '">' +
                                            '<img src="Avatars/' + post.userID + '.png" alt="Profile Image">' + 
                                        '</a>' +
                                    '<div class="blog-info">' +
                                        '<h4 class="title">' +
                                            '<a id="avatar" href="postInfo.php?postID=' + post.postID + '">' +
                                                '<b>' + post.postTitle + '</b>' +
                                            '</a>' +
                                        '</h4>' +
                                        '<form class="likeForm">' +                                            
                                            '<ul class="post-footer">' +
                                                '<input type="hidden" name="postID" value="<?Php echo $postID ?>">' +
                                                '<li><a href="#" class="like"><i class="ion-heart"></i>' + post.upvote + '</a></li>' +
                         (post.feedback === '1' ? '<li><a href="postInfo.php?postID=' + post.postID + '"><i class="ion-chatbubble"></i></a></li>' : '<li><a><i class="ion-android-lock"></a></i></li>') +
                                                '<li><a href="#" class="dislike"><i class="ion-heart-broken"></i>' + post.downvote + '</a></li>' +
                                            '</ul>' +
                                        '</form>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>');
                }                
                $('div#postContainer').append('<a class="load-more-btn" href="#"><b>LOAD MORE</b></a>');
            }
        },
        error: function(data){
            $('section#error').show();
            $('div#error').html(data);
        }            
    });  
}