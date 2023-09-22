<div class="comments">
    <div class="comments-body"></div>
    <div class="btn btn-primary" id="load_more">Đọc tiếp</div>
</div>
<div class="modal fade" tabindex="-1" id="report-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Báo cáo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3">
                        <label for="">Nội dung báo cáo</label>
                        <input type="text" name="content" id="report-content" class="form-control">
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button class="btn btn-primary px-5 d-block" type="submit">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {

        let page = 1;
        let commentsHtml = [];
        const urlParams = new URLSearchParams(window.location.search);
        fetchComments();

        function fetchComments() {
            $('#load_more').html(
                `<span class="spinner-border spinner-border-sm" aria-hidden="true">
                </span><span role="status">Đang tải</span>`
            );
            $.ajax({
                type: "get",
                url: "pages/get_comments.php",
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
                            dataMap =
                                data.map(item => {
                                    return `<div class="card mb-3 pt-3" style="min-height: 170px;">
                                             <div class="row g-0">
                                                  <div class="col-3 d-flex flex-column align-items-center my-3">
                                                      <img src="./assets/images/${item['user_avatar']||'users/default.webp'}" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;">
                                                      <div class="text-primary text-center" style="font-size: 14px;">${item['user_name']}</div>
                                                 </div>
                                            <div class="col-9">
                                                <div class="card-body">
                                                    <div class="badge bg-secondary position-absolute top-0 end-0 m-1">${moment(item['created_at']).fromNow()} </div>
                                                        <a href="review.php?id=${item['story_id']}" class="text-decoration-none" style="font-size: 14px;">${item['story_name']}</a>
                                                        <div class="line-clamp-3 text_comment"> ${item['content']}</div>
                                                        <button class="read_more border-0 text-primary bg-transparent d-none">Đọc tiếp</button>
                                                        <button class="report-comment btn btn-warning position-absolute bottom-0 end-0"
                                                         data-type="comments" data-id=${item['id']}
                                                         data-bs-toggle="modal" data-bs-target="#report-modal"
                                                         >
                                                             <i class="bi bi-flag"></i>
                                                        </button>
                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                })
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
                                let reported_type = $(this).data('type');
                                let reported_id = $(this).data('id');

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