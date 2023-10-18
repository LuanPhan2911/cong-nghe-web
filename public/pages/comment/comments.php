<div class="comments">
    <div class="comments-body"></div>
    <div class="btn btn-primary" id="load_more">Đọc tiếp</div>
</div>
<?php
require_once __DIR__ . '/../report/report_form.php'
?>
<script>
    $(function() {



        let page = 1;
        let commentsHtml = [];
        let reported_type = "",
            reported_id = "";
        const urlParams = new URLSearchParams(window.location.search);

        function renderComments(data) {
            return data.map(item => {
                return `<div class="card mb-3 pt-3 shadow " style="min-height: 170px;">
                                             <div class="row g-0">
                                                  <div class="col-3 d-flex flex-column align-items-center my-3">
                                                      <img src="./assets/images/${item['user_avatar']||'users/default.webp'}" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;">
                                                      <div class="text-primary text-center mt-2 text-capitalize" style="font-size: 14px;">${item['user_name']}</div>
                                                 </div>
                                            <div class="col-9">
                                                <div class="card-body">
                                                    <div class="badge bg-secondary position-absolute top-0 end-0 m-1">${moment(item['created_at']).fromNow()} </div>
                                                        <a href="review.php?id=${item['story_id']}" class="text-decoration-none">${item['story_name']}</a>
                                                        <div class="line-clamp-3 text_comment" style="font-size: 14px;"> ${item['content']}</div>
                                                        <button class="read_more border-0 text-primary bg-transparent d-none">Đọc tiếp</button>
                                                        <button class="report-comment btn bg-transparent position-absolute bottom-0 end-0" data-type="comments" data-id="${item['id']}">
                                                        <i class="bi bi-flag-fill text-primary"></i>
                                                        </button>
                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
            })
        }
        fetchComments();

        function fetchComments() {
            $('#load_more').html(
                `<span class="spinner-border spinner-border-sm" aria-hidden="true">
                </span><span role="status">Đang tải</span>`
            );
            $.ajax({
                type: "get",
                url: "pages/comment/get_comments.php",
                data: {
                    id: urlParams.get('id'),
                    page
                },
                success: function(response) {
                    if (response?.success) {
                        let {
                            data,
                            next_page
                        } = response.data;

                        page = next_page;
                        if (!page) {
                            $('#load_more').addClass('d-none');
                        }
                        if (data?.length > 0) {
                            let dataMap = renderComments(data);
                            commentsHtml = [...commentsHtml, ...dataMap];
                            $('.comments-body').html(commentsHtml);

                            $('.text_comment').each(function(_, item) {
                                let offsetHeight = $(item).outerHeight();
                                let scrollHeight = $(item).prop('scrollHeight');

                                if (offsetHeight < scrollHeight) {
                                    let readMoreBtn = $(this).siblings('.read_more');
                                    readMoreBtn.removeClass('d-none');
                                    readMoreBtn.click(function() {
                                        $(item).removeClass('line-clamp-3');
                                        readMoreBtn.addClass('d-none');
                                    })
                                }
                            })
                            $('.report-comment').click(function() {

                                reported_type = $(this).data('type');
                                reported_id = $(this).data('id');

                                $('#reported_type').val(reported_type);
                                $('#reported_id').val(reported_id);

                                $('.modal-title').text(`Báo cáo ${reported_type=='comments'?'bình luận': 'Review'}`)
                                $('#report-modal').modal('show');
                                $('#report-content').val('');


                            })


                        } else {
                            $('#load_more').addClass('d-none');
                            $(".comments-body").html(
                                `<div class="text-primary">Chưa có bình luận nào</div>`
                            );



                        }
                    }
                },
                complete: function() {
                    $('#load_more').html('Đọc tiếp');
                }
            });
        }

        $("#load_more").click(function() {
            if (page) {
                fetchComments();
            }
        })

    })
</script>