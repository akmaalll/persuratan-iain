<script type="text/javascript">
    $(document).ready(function() {
        loadpage('', 5);
        var $pagination = $('.twbs-pagination');
        var defaultOpts = {
            totalPages: 1,
            prev: '&#8672;',
            next: '&#8674;',
            first: '&#8676;',
            last: '&#8677;',
        };
        $pagination.twbsPagination(defaultOpts);

        function loaddata(page, search, per_page) {
            $.ajax({
                url: '{{ route($title . '.data') }}',
                data: {
                    "page": page,
                    "search": search,
                    "per_page": per_page
                },
                type: "GET",
                datatype: "json",
                success: function(data) {
                    $(".datatables").html(data.html);
                }
            });
        }

        function loadpage(search, per_page) {
            $.ajax({
                url: '{{ route($title . '.data') }}',
                data: {
                    "search": search,
                    "per_page": per_page
                },
                type: "GET",
                datatype: "json",
                success: function(response) {
                    if ($pagination.data("twbs-pagination")) {
                        $pagination.twbsPagination('destroy');
                        $(".datatables").html('<tr><td colspan="4">Data not found</td></tr>');
                    }
                    $pagination.twbsPagination($.extend({}, defaultOpts, {
                        startPage: 1,
                        totalPages: response.total_page,
                        visiblePages: 8,
                        prev: '&#8672;',
                        next: '&#8674;',
                        first: '&#8676;',
                        last: '&#8677;',
                        onPageClick: function(event, page) {
                            if (page == 1) {
                                var to = 1;
                            } else {
                                var to = page * per_page - (per_page - 1);
                            }
                            if (page == response.total_page) {
                                var end = response.total_data;
                            } else {
                                var end = page * per_page;
                            }
                            $('#contentx').text('Showing ' + to + ' to ' + end +
                                ' of ' +
                                response.total_data + ' entries');
                            loaddata(page, search, per_page);
                        }
                    }));
                }
            });
        }

        // filter search and pagination
        $("#perPage").on('keyup change', function(event) {
            let per_page = $('#perPage').val();
            loadpage('', per_page);
        });

        $('body').on('click', '.searchData', function() {
            let search = $('#pencarian').val();
            let per_page = $('#perPage').val();
            loadpage(search, per_page);
        });
        
        // proses delete data
        $('body').on('click', '.deleteData', function() {
            var id = $(this).data("id");
            Swal.fire({
                title: "Are you sure to Delete?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: '{{ url("admin/$title") }}/' + id,
                        success: function(data) {
                            loadpage('', 5);
                            toastr.success("Successful delete data!");
                        },
                        error: function(data) {
                            toastr.error("Failed delete data!");
                        }
                    });
                }
            });
        });


    });
</script>
