/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$(document).ready(function() {
    $('#createPostForm').on('submit', function(e) {
        e.preventDefault();
        
        const $form = $(this);
        const $submitBtn = $('#submitPost');
        const $spinner = $submitBtn.find('.spinner-border');
        const formData = new FormData(this);
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').empty();
        
        $submitBtn.prop('disabled', true);
        $spinner.removeClass('d-none');
        
        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#createPostModal').modal('hide');
                    $form[0].reset();
                    
                    // Show success message
                    toastr.success('Post created successfully!');
                    
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error('Failed to create post: ' + response.message);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                
                if (xhr.status === 422 && response.errors) {
                    // Validation errors
                    $.each(response.errors, function(field, messages) {
                        const $field = $(`[name="${field}"]`);
                        $field.addClass('is-invalid');
                        $field.next('.invalid-feedback').text(messages[0]);
                    });
                } else {
                    toastr.error('Failed to create post: ' + (response.message || 'Unknown error'));
                }
            },
            complete: function() {
                $submitBtn.prop('disabled', false);
                $spinner.addClass('d-none');
            }
        });
    });
    
    $('#createPostModal').on('hidden.bs.modal', function() {
        $('#createPostForm')[0].reset();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').empty();
    });
    
    $('#imageUrl').on('change', function() {
        const file = this.files[0];
        const $field = $(this);
        const $feedback = $field.next().next('.invalid-feedback');
        
        if (file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
            const maxSize = 10 * 1024 * 1024;
            
            if (!allowedTypes.includes(file.type)) {
                $field.addClass('is-invalid');
                $feedback.text('Please select a valid image file (JPG, PNG, SVG)');
                return;
            }
            
            if (file.size > maxSize) {
                $field.addClass('is-invalid');
                $feedback.text('File size must be less than 10MB');
                return;
            }
            
            $field.removeClass('is-invalid');
            $feedback.empty();
        }
    });
});


