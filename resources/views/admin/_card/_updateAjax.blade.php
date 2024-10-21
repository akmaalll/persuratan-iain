<script type="text/javascript">
    $(document).ready(function() {

        // proses update data
        const submitButtonUpdate = document.getElementById('kt_modal_new_target_update');
        submitButtonUpdate.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {
                    if (status == 'Valid') {
                        // Show loading indication
                        submitButtonUpdate.setAttribute('data-kt-indicator', 'on');
                        submitButtonUpdate.disabled = true;
                        let formData = new FormData(kt_modal_new_target_form);
                        console.log(kt_modal_new_target_form);
                        console.log(formData);
                        let id = $('#formId').val();
                        if (window.editor) {
                            const editorContent = window.editor.getData();

                            formData.set('uraian', editorContent);
                            console.log('Added editor content to form data');
                        } else {
                            console.warn('CKEditor not found');
                        }
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: formData,
                            url: '{{ url("admin/$title") }}/' + id,
                            type: "POST",
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                console.log('data');
                                if (data == 'konfirmasi password salah') {
                                    toastr.error("Konfirmasi password salah!");
                                    submitButtonUpdate.removeAttribute(
                                        'data-kt-indicator');
                                    submitButtonUpdate.disabled = false;
                                } else {
                                    toastr.success("Successful update data!");
                                    setTimeout(() => {
                                        window.location.replace(
                                            "{{ route($title . '.index') }}"
                                        );
                                    }, 750);
                                }

                            },
                            error: function(data) {
                                submitButtonUpdate.removeAttribute(
                                    'data-kt-indicator');
                                submitButtonUpdate.disabled = false;
                                toastr.error("Failed to update data!");
                            }
                        });
                    }
                });
            }
        });

    });
</script>
