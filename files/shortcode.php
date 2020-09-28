<?php
// Tạo paginationajax Shortcode

add_shortcode('paginationajax', 'gg_pagination_ajax');
function gg_pagination_ajax($atts) {
    global $post;
    ob_start();

// định nghĩa thuộc tính và giá trị mặc định
    extract(shortcode_atts(array('post_type' => 'post', 'per_page' => 3), $atts));

// định nghĩa tham số truy vấn cơ bản dựa trên thuộc tính đã cung cấp
?>
<div class="col-md-12 content">
    <div class = "inner-box content no-right-margin darkviolet">
        <script type="text/javascript">
        (function($) {
            var posttype = '<?php echo $atts['post_type']; ?>';
            var per_page = '<?php echo $atts['per_page']; ?>';
            // This is required for AJAX to work on our page
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            // alert(listid);
            function cvf_load_all_posts(page){
                // Start the transition
                // $(".cvf_pag_loading").fadeIn().css('background','#ccc');
                $('.loading').show();

                // Data to receive from our server
                // the value in 'action' is the key that will be identified by the 'wp_ajax_' hook 
                var data = {
                    page: page,
                    action: "demo-pagination-load-posts",
                    posttype: posttype ? posttype : 'post',
                    per_page: per_page ? per_page : 3
                };

                // Send the data
                $.post(ajaxurl, data, function(response) {
                    // If successful Append the data into our html container
                    $(".cvf_universal_container").append(response);
                    // End the transition
                    // $(".cvf_pag_loading").css({'background':'none', 'transition':'all 1s ease-out'});
                    $('.loading').hide();
                });
            }

            // Load page 1 as the default
            cvf_load_all_posts(1);

            // Handle the clicks
            jQuery(document.body).on('click', '.cvf_universal_container .cvf-universal-pagination li.active', function(){
                var page = $(this).attr('p');
                $('.cvf_universal_container').empty();
                cvf_load_all_posts(page);
            });

          })(jQuery);
        </script>
        <div class="cvf_pag_loading">
            <div class="cvf_universal_container">
                <div class="cvf-universal-content"></div>
            </div>
        </div>
        <img class="loading" src="https://media3.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif?cid=ecf05e47snh0z1osi2lwtvewfje5bsqo2hocbu013fnhy73j&rid=giphy.gif" />
    </div>      
</div>
<?php
    $myvariable = ob_get_clean();
        return $myvariable;
}
?>