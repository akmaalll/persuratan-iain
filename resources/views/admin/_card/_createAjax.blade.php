<script type="text/javascript">
    $(document).ready(function() {

        // proses save data
        const submitButton = document.getElementById('kt_modal_new_target_save');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        let formData = new FormData(kt_modal_new_target_form);
                        if (window.editor) {
                            const editorContent = window.editor.getData();

                            formData.set('uraian', editorContent);
                        } else {
                            console.warn('CKEditor not found');
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: formData,
                            url: "{{ route($title . '.store') }}",
                            type: "POST",
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                toastr.success("Successful save data!");
                                setTimeout(() => {
                                    window.location.replace(
                                        "{{ route($title . '.index') }}"
                                    );
                                }, 750);
                            },
                            error: function(data) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                toastr.error("Failed to save data!");
                            }
                        });
                    }
                });
            }
        });

    });
</script>
