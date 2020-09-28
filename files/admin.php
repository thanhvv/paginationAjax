<?php
add_action( 'admin_menu', 'paginationajaxmenu' );
add_action( 'admin_init', 'pagination_settings_init' );

function paginationajaxmenu(  ) {

    add_options_page( 'GG Pagination', 'GG Pagination', 'manage_options', 'pagination', 'pagination_options_page' );

}

function pagination_settings_init(  ) {

    register_setting( 'pluginPagination', 'pagination_settings' );

    add_settings_section(
        'breaking_pluginPage_section',
        __( 'Settings:', 'paginationgg' ),
        'pagination_settings_section_callback',
        'pluginPagination'
    );

    add_settings_section(
        'pagination_settings_section_info',
        __( 'Settings:', 'paginationgg' ),
        'pagination_settings_section_info',
        'pluginPagination'
    );

    add_settings_field(
        'pagination_checkbx_css',
        __( 'Gỡ bỏ css mặc định, sử dụng css tự định nghĩa', 'paginationgg' ),
        'pagination_checkbox',
        'pluginPagination',
        'breaking_pluginPage_section'
    );

}

function pagination_checkbox(  ) 
{
    $options = get_option( 'pagination_settings' );
    ?>
    <input type='checkbox' name='pagination_settings[pagination_checkbx_css]' <?php checked( (int)$options, 1 ); ?> value='1'>
    <?php
}

function pagination_settings_section_callback() 
{
    echo '<p class="breaking_info">' . __( 'Phân trang Ajax cho wordpress sử dụng shortcode.', 'paginationgg' ) . '</p>';
}

function pagination_settings_section_info() 
{
    echo '<div class="paginationgg-info">';
    echo '<p><strong>Hướng dẫn sử dụng Shortcodes:</strong><br /><em>' . __( '[paginationajax post_type = post per_page = 5]' ) . '</em></p>';
    echo '</div>';
}

function pagination_options_page() 
{ ?>
<style>
    .form-table th {min-width: 280px;}
    p.breaking_info {background: chocolate;padding: 1em;color: #fff;}
    h2 {display: none;}
    .paginationgg-info {background:rgba(212, 105, 6, 0.1);padding: 1em;}
</style>
<form action='options.php' method='post' style="background-color: #fff;padding: 1em 2em;margin: 20px 20px 20px 0; box-shadow: 0 0 1px #000;">
<h1>Pagination</h1>
<?php
    settings_fields( 'pluginPagination' );
    do_settings_sections( 'pluginPagination' );
    submit_button();
?>
</form>
<?php
} 
?>