<?php
/**
 * Register custom meta boxes for Portfolio and Testimonial post types using native WordPress methods.
 */

// Function to add meta boxes
function arash_add_custom_meta_boxes() {
    // Meta box for Portfolio
    add_meta_box(
        'portfolio_meta_box', // ID
        'فیلدهای نمونه‌کار', // Title
        'arash_portfolio_meta_box_callback', // Callback
        'portfolio', // Post type
        'normal', // Context
        'high' // Priority
    );

    // Meta box for Testimonial
    add_meta_box(
        'testimonial_meta_box', // ID
        'فیلدهای نظرات مشتریان', // Title
        'arash_testimonial_meta_box_callback', // Callback
        'testimonial', // Post type
        'normal', // Context
        'high' // Priority
    );

    // Meta box for WooCommerce Products
    add_meta_box(
        'product_type_meta_box', // ID
        'نوع محصول', // Title
        'arash_product_type_meta_box_callback', // Callback
        'product', // Post type
        'side', // Context
        'high' // Priority
    );

    // Meta box for Course Fields
    add_meta_box(
        'course_fields_meta_box', // ID
        'اطلاعات دوره آموزشی', // Title
        'arash_course_fields_meta_box_callback', // Callback
        'product', // Post type
        'normal', // Context
        'high' // Priority
    );
}
add_action('add_meta_boxes', 'arash_add_custom_meta_boxes');

// Enqueue custom styles for admin panel
function arash_enqueue_admin_styles() {
    // Check if we are on the portfolio, testimonial, or product edit screen
    $screen = get_current_screen();
    if ($screen->post_type === 'portfolio' || $screen->post_type === 'testimonial' || $screen->post_type === 'product') {
        ?>
        <style type="text/css">
            /* Styles for Portfolio Technologies */
            .technologies-checkboxes {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 10px;
                max-height: 300px; /* Optional: Add scroll if too many */
                overflow-y: auto;
                padding: 10px;
                border: 1px solid #ddd;
                background-color: #f9f9f9;
                border-radius: 4px;
            }
            .technologies-checkboxes label {
                display: block;
                margin: 0;
                padding: 5px;
                cursor: pointer;
            }
            .technologies-checkboxes input[type="checkbox"] {
                margin-right: 5px;
            }
            .technologies-checkboxes label:hover {
                background-color: #eee;
            }

            /* Styles for Testimonial Fields */
            .testimonial-fields {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                padding: 10px;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .testimonial-fields .full-width {
                grid-column: span 2;
            }
            .testimonial-fields label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .testimonial-fields input[type="text"],
            .testimonial-fields input[type="number"],
            .testimonial-fields input[type="url"] {
                width: 100%;
                padding: 5px;
                box-sizing: border-box;
            }
            .testimonial-fields .image-field {
                display: flex;
                flex-direction: column;
            }
            .testimonial-fields .image-field input[type="text"] {
                margin-bottom: 10px;
            }
            .testimonial-fields .checkbox-field label {
                font-weight: normal;
            }

            /* Styles for Product Type Fields */
            .product-type-field {
                padding: 15px;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .product-type-field label {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
                cursor: pointer;
                padding: 8px;
                border-radius: 4px;
                transition: background-color 0.2s;
            }
            .product-type-field label:hover {
                background-color: #eee;
            }
            .product-type-field input[type="radio"] {
                margin-left: 8px;
            }

            /* Styles for Course Fields */
            .course-fields {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                padding: 15px;
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .course-fields .full-width {
                grid-column: span 2;
            }
            .course-fields label {
                display: block;
                font-weight: bold;
                margin-bottom: 8px;
                color: #23282d;
            }
            .course-fields input[type="text"],
            .course-fields input[type="number"] {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 14px;
            }
            .course-fields .image-field {
                display: flex;
                flex-direction: column;
            }
            .course-fields .image-field input[type="text"] {
                margin-bottom: 10px;
            }
            .course-fields .image-field .button {
                align-self: flex-start;
                margin-bottom: 10px;
            }
            .course-fields .image-preview {
                max-width: 100px;
                height: auto;
                border-radius: 50%;
                border: 2px solid #ddd;
            }
            .course-fields .help-text {
                font-size: 12px;
                color: #666;
                margin-top: 5px;
                font-style: italic;
            }
        </style>
        <?php
    }
}
add_action('admin_print_styles', 'arash_enqueue_admin_styles');

// Callback to display Portfolio meta box fields
function arash_portfolio_meta_box_callback($post) {
    // Nonce for security
    wp_nonce_field('arash_portfolio_meta_box_nonce', 'arash_portfolio_nonce');

    // Get existing values
    $project_image = get_post_meta($post->ID, '_project_image', true);
    $project_url = get_post_meta($post->ID, '_project_url', true);
    $project_technologies = get_post_meta($post->ID, '_project_technologies', true);
    if (!is_array($project_technologies)) {
        $project_technologies = array();
    }

    // Project Image
    ?>
    <p>
        <label for="project_image">تصویر پروژه</label><br>
        <input type="text" id="project_image" name="project_image" value="<?php echo esc_attr($project_image); ?>" size="50" />
        <input type="button" id="project_image_button" class="button" value="آپلود تصویر" />
        <?php if ($project_image): ?>
            <br><img src="<?php echo esc_url($project_image); ?>" style="max-width: 300px; height: auto;" />
        <?php endif; ?>
    </p>

    <script>
        jQuery(document).ready(function($) {
            var project_image_uploader;
            $('#project_image_button').click(function(e) {
                e.preventDefault();
                if (project_image_uploader) {
                    project_image_uploader.open();
                    return;
                }
                project_image_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'انتخاب تصویر پروژه',
                    button: { text: 'انتخاب تصویر' },
                    multiple: false
                });
                project_image_uploader.on('select', function() {
                    var attachment = project_image_uploader.state().get('selection').first().toJSON();
                    $('#project_image').val(attachment.url);
                    $('#project_image').after('<br><img src="' + attachment.url + '" style="max-width: 300px; height: auto;" />');
                });
                project_image_uploader.open();
            });
        });
    </script>

    <p>
        <label for="project_url">لینک پروژه</label><br>
        <input type="url" id="project_url" name="project_url" value="<?php echo esc_attr($project_url); ?>" size="50" />
    </p>

    <p>
        <label>تکنولوژی‌های استفاده شده</label><br>
        <div class="technologies-checkboxes">
            <?php
            $technologies = array(
                'figma' => 'Figma',
                'wordpress' => 'WordPress',
                'github' => 'GitHub',
                'woocommerce' => 'WooCommerce',
                'jetengine' => 'Jet Engine',
                'react' => 'React',
                'vue' => 'Vue.js',
                'angular' => 'Angular',
                'javascript' => 'JavaScript',
                'php' => 'PHP',
                'mysql' => 'MySQL',
                'html' => 'HTML',
                'css' => 'CSS',
                'sass' => 'Sass',
                'bootstrap' => 'Bootstrap',
                'tailwind' => 'Tailwind CSS',
                'laravel' => 'Laravel',
                'nodejs' => 'Node.js',
                'python' => 'Python',
                'photoshop' => 'Photoshop',
                'illustrator' => 'Illustrator',
                'xd' => 'Adobe XD',
            );

            foreach ($technologies as $key => $label) {
                $checked = in_array($key, $project_technologies) ? 'checked' : '';
                echo '<label><input type="checkbox" name="project_technologies[]" value="' . esc_attr($key) . '" ' . $checked . '> ' . esc_html($label) . '</label>';
            }
            ?>
        </div>
    </p>
    <?php
}

// Callback to display Testimonial meta box fields
function arash_testimonial_meta_box_callback($post) {
    // Nonce for security
    wp_nonce_field('arash_testimonial_meta_box_nonce', 'arash_testimonial_nonce');

    // Get existing values
    $client_name = get_post_meta($post->ID, '_client_name', true);
    $client_position = get_post_meta($post->ID, '_client_position', true);
    $client_company = get_post_meta($post->ID, '_client_company', true);
    $client_avatar = get_post_meta($post->ID, '_client_avatar', true);
    $testimonial_rating = get_post_meta($post->ID, '_testimonial_rating', true);
    $project_name = get_post_meta($post->ID, '_project_name', true);
    $testimonial_featured = get_post_meta($post->ID, '_testimonial_featured', true);

    ?>
    <div class="testimonial-fields">
        <div>
            <label for="client_name">نام مشتری</label>
            <input type="text" id="client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" required />
        </div>

        <div>
            <label for="client_position">سمت/شغل مشتری</label>
            <input type="text" id="client_position" name="client_position" value="<?php echo esc_attr($client_position); ?>" />
        </div>

        <div>
            <label for="client_company">شرکت/سازمان</label>
            <input type="text" id="client_company" name="client_company" value="<?php echo esc_attr($client_company); ?>" />
        </div>

        <div class="image-field">
            <label for="client_avatar">تصویر مشتری</label>
            <input type="text" id="client_avatar" name="client_avatar" value="<?php echo esc_attr($client_avatar); ?>" />
            <input type="button" id="client_avatar_button" class="button" value="آپلود تصویر" />
            <?php if ($client_avatar): ?>
                <br><img src="<?php echo esc_url($client_avatar); ?>" style="max-width: 150px; height: auto;" />
            <?php endif; ?>
        </div>

        <div>
            <label for="testimonial_rating">امتیاز (از ۵)</label>
            <input type="number" id="testimonial_rating" name="testimonial_rating" value="<?php echo esc_attr($testimonial_rating ? $testimonial_rating : 5); ?>" min="1" max="5" />
        </div>

        <div>
            <label for="project_name">نام پروژه</label>
            <input type="text" id="project_name" name="project_name" value="<?php echo esc_attr($project_name); ?>" />
        </div>

        <div class="checkbox-field full-width">
            <input type="checkbox" id="testimonial_featured" name="testimonial_featured" value="1" <?php checked(1, $testimonial_featured); ?> />
            <label for="testimonial_featured">نظر ویژه (این نظر در صفحه اصلی نمایش داده شود؟)</label>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            var client_avatar_uploader;
            $('#client_avatar_button').click(function(e) {
                e.preventDefault();
                if (client_avatar_uploader) {
                    client_avatar_uploader.open();
                    return;
                }
                client_avatar_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'انتخاب تصویر مشتری',
                    button: { text: 'انتخاب تصویر' },
                    multiple: false
                });
                client_avatar_uploader.on('select', function() {
                    var attachment = client_avatar_uploader.state().get('selection').first().toJSON();
                    $('#client_avatar').val(attachment.url);
                    $('#client_avatar').after('<br><img src="' + attachment.url + '" style="max-width: 150px; height: auto;" />');
                });
                client_avatar_uploader.open();
            });
        });
    </script>
    <?php
}

// Callback to display Product Type meta box fields
function arash_product_type_meta_box_callback($post) {
    // Nonce for security
    wp_nonce_field('arash_product_type_meta_box_nonce', 'arash_product_type_nonce');

    // Get existing value
    $product_type = get_post_meta($post->ID, '_product_type', true);
    if (empty($product_type)) {
        $product_type = 'course'; // Default to course
    }

    ?>
    <div style="padding: 10px;">
        <p>
            <label style="display: block; margin-bottom: 10px; font-weight: bold;">این محصول چه نوعی است؟</label>
        </p>
        
        <p style="margin-bottom: 15px;">
            <label style="display: flex; align-items: center; margin-bottom: 8px; cursor: pointer;">
                <input type="radio" name="product_type" value="course" <?php checked('course', $product_type); ?> style="margin-left: 8px;" />
                <span>دوره آموزشی</span>
            </label>
        </p>
        
        <p style="margin-bottom: 15px;">
            <label style="display: flex; align-items: center; margin-bottom: 8px; cursor: pointer;">
                <input type="radio" name="product_type" value="news" <?php checked('news', $product_type); ?> style="margin-left: 8px;" />
                <span>محصول دیجیتال</span>
            </label>
        </p>
        
        <div style="background: #f0f0f1; padding: 10px; border-radius: 4px; font-size: 12px; color: #646970;">
            <strong>راهنما:</strong><br>
            • دوره آموزشی: محصولات قابل دانلود که شامل ویدیو، فایل و محتوای آموزشی هستند<br>
            • محصول دیجیتال: محصولات قابل دانلود دیجیتال
        </div>
    </div>
    <?php
}

// Callback to display Course Fields meta box
function arash_course_fields_meta_box_callback($post) {
    // Nonce for security
    wp_nonce_field('arash_course_fields_meta_box_nonce', 'arash_course_fields_nonce');

    // Get existing values
    $course_chapters = get_post_meta($post->ID, '_course_chapters', true);
    $course_duration = get_post_meta($post->ID, '_course_duration', true);
    $course_instructor = get_post_meta($post->ID, '_course_instructor', true);
    $course_instructor_avatar = get_post_meta($post->ID, '_course_instructor_avatar', true);
    $product_type = get_post_meta($post->ID, '_product_type', true);

    ?>
    <div class="course-fields" id="course-fields-container" style="<?php echo ($product_type !== 'course') ? 'display: none;' : ''; ?>">
        <div>
            <label for="course_chapters">تعداد فصل‌ها</label>
            <input type="number" id="course_chapters" name="course_chapters" value="<?php echo esc_attr($course_chapters); ?>" min="1" max="100" />
            <div class="help-text">تعداد فصل‌های موجود در دوره</div>
        </div>

        <div>
            <label for="course_duration">مدت زمان دوره (ساعت)</label>
            <input type="number" id="course_duration" name="course_duration" value="<?php echo esc_attr($course_duration); ?>" min="1" max="1000" />
            <div class="help-text">مدت زمان کل دوره به ساعت</div>
        </div>

        <div class="full-width">
            <label for="course_instructor">نام مدرس</label>
            <input type="text" id="course_instructor" name="course_instructor" value="<?php echo esc_attr($course_instructor); ?>" />
            <div class="help-text">نام کامل مدرس دوره</div>
        </div>

        <div class="full-width">
            <label for="course_instructor_avatar">عکس مدرس</label>
            <div class="image-field">
                <input type="text" id="course_instructor_avatar" name="course_instructor_avatar" value="<?php echo esc_attr($course_instructor_avatar); ?>" />
                <input type="button" id="course_instructor_avatar_button" class="button" value="انتخاب عکس" />
                <?php if ($course_instructor_avatar): ?>
                    <img src="<?php echo esc_url($course_instructor_avatar); ?>" class="image-preview" />
                <?php endif; ?>
            </div>
            <div class="help-text">عکس پروفایل مدرس (ترجیحاً مربعی)</div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            // Media uploader for instructor avatar
            var instructor_avatar_uploader;
            $('#course_instructor_avatar_button').click(function(e) {
                e.preventDefault();
                if (instructor_avatar_uploader) {
                    instructor_avatar_uploader.open();
                    return;
                }
                instructor_avatar_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'انتخاب عکس مدرس',
                    button: { text: 'انتخاب عکس' },
                    multiple: false
                });
                instructor_avatar_uploader.on('select', function() {
                    var attachment = instructor_avatar_uploader.state().get('selection').first().toJSON();
                    $('#course_instructor_avatar').val(attachment.url);
                    $('.image-preview').remove();
                    $('#course_instructor_avatar_button').after('<img src="' + attachment.url + '" class="image-preview" />');
                });
                instructor_avatar_uploader.open();
            });

            // Show/hide course fields based on product type
            function toggleCourseFields() {
                var productType = $('input[name="product_type"]:checked').val();
                if (productType === 'course') {
                    $('#course-fields-container').show();
                } else {
                    $('#course-fields-container').hide();
                }
            }

            // Initial check
            toggleCourseFields();

            // Listen for product type changes
            $('input[name="product_type"]').change(function() {
                toggleCourseFields();
            });
        });
    </script>
    <?php
}

// Function to save Portfolio meta data
function arash_save_portfolio_meta($post_id) {
    // Check nonce
    if (!isset($_POST['arash_portfolio_nonce']) || !wp_verify_nonce($_POST['arash_portfolio_nonce'], 'arash_portfolio_meta_box_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    if (isset($_POST['project_image'])) {
        update_post_meta($post_id, '_project_image', esc_url_raw($_POST['project_image']));
    }

    if (isset($_POST['project_url'])) {
        update_post_meta($post_id, '_project_url', esc_url_raw($_POST['project_url']));
    }

    if (isset($_POST['project_technologies'])) {
        update_post_meta($post_id, '_project_technologies', array_map('sanitize_text_field', $_POST['project_technologies']));
    } else {
        delete_post_meta($post_id, '_project_technologies');
    }
}
add_action('save_post_portfolio', 'arash_save_portfolio_meta');

// Function to save Testimonial meta data
function arash_save_testimonial_meta($post_id) {
    // Check nonce
    if (!isset($_POST['arash_testimonial_nonce']) || !wp_verify_nonce($_POST['arash_testimonial_nonce'], 'arash_testimonial_meta_box_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    if (isset($_POST['client_name'])) {
        update_post_meta($post_id, '_client_name', sanitize_text_field($_POST['client_name']));
    }

    if (isset($_POST['client_position'])) {
        update_post_meta($post_id, '_client_position', sanitize_text_field($_POST['client_position']));
    }

    if (isset($_POST['client_company'])) {
        update_post_meta($post_id, '_client_company', sanitize_text_field($_POST['client_company']));
    }

    if (isset($_POST['client_avatar'])) {
        update_post_meta($post_id, '_client_avatar', esc_url_raw($_POST['client_avatar']));
    }

    if (isset($_POST['testimonial_rating'])) {
        $rating = intval($_POST['testimonial_rating']);
        if ($rating >= 1 && $rating <= 5) {
            update_post_meta($post_id, '_testimonial_rating', $rating);
        }
    }

    if (isset($_POST['project_name'])) {
        update_post_meta($post_id, '_project_name', sanitize_text_field($_POST['project_name']));
    }

    $featured = isset($_POST['testimonial_featured']) ? 1 : 0;
    update_post_meta($post_id, '_testimonial_featured', $featured);
}
add_action('save_post_testimonial', 'arash_save_testimonial_meta');

// Function to save Product Type meta data
function arash_save_product_type_meta($post_id) {
    // Check nonce for product type
    if (!isset($_POST['arash_product_type_nonce']) || !wp_verify_nonce($_POST['arash_product_type_nonce'], 'arash_product_type_meta_box_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save product type
    if (isset($_POST['product_type'])) {
        $product_type = sanitize_text_field($_POST['product_type']);
        if (in_array($product_type, array('course', 'news'))) {
            update_post_meta($post_id, '_product_type', $product_type);
        }
    }
}
add_action('save_post_product', 'arash_save_product_type_meta');

// Function to save Course Fields meta data
function arash_save_course_fields_meta($post_id) {
    // Check nonce for course fields
    if (!isset($_POST['arash_course_fields_nonce']) || !wp_verify_nonce($_POST['arash_course_fields_nonce'], 'arash_course_fields_meta_box_nonce')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Only save course fields if product type is 'course'
    $product_type = isset($_POST['product_type']) ? sanitize_text_field($_POST['product_type']) : get_post_meta($post_id, '_product_type', true);
    
    if ($product_type === 'course') {
        // Save course chapters
        if (isset($_POST['course_chapters'])) {
            $chapters = intval($_POST['course_chapters']);
            if ($chapters > 0) {
                update_post_meta($post_id, '_course_chapters', $chapters);
            }
        }

        // Save course duration
        if (isset($_POST['course_duration'])) {
            $duration = intval($_POST['course_duration']);
            if ($duration > 0) {
                update_post_meta($post_id, '_course_duration', $duration);
            }
        }

        // Save course instructor
        if (isset($_POST['course_instructor'])) {
            update_post_meta($post_id, '_course_instructor', sanitize_text_field($_POST['course_instructor']));
        }

        // Save course instructor avatar
        if (isset($_POST['course_instructor_avatar'])) {
            update_post_meta($post_id, '_course_instructor_avatar', esc_url_raw($_POST['course_instructor_avatar']));
        }
    } else {
        // If product type is not 'course', remove course-related meta
        delete_post_meta($post_id, '_course_chapters');
        delete_post_meta($post_id, '_course_duration');
        delete_post_meta($post_id, '_course_instructor');
        delete_post_meta($post_id, '_course_instructor_avatar');
    }
}
add_action('save_post_product', 'arash_save_course_fields_meta');