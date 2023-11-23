<table id="ticket-display" class="table table-striped">
    <thead class="fs-5 fw-bolder text-light" style="background-color: rgb(12, 12, 151)">
        <tr align="middle" valign="middle">
            <th class="text-center">Nomor</th>
            <th class="text-center">Tipe Tiket</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Subkategori</th>
            <th class="text-center">Item kategori</th>
            <th class="text-center">Judul</th>
            <th class="text-center">Status Tiket</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@section('script-bottom')
    <script>
        var nik_user = {!! json_encode($user->nik) !!};

        $(document).ready(function() {
            var table1 = $('#ticket-display').DataTable({
                "ajax": {
                    "url": "/api/created-tiket-list/" + nik_user,
                    "type": "GET",
                    "dataSrc": "" // This tells DataTables to use the raw array
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: "nomor_tiket"
                    },
                    {
                        className: 'text-center',
                        data: "tipe_tiket"
                    },
                    {
                        className: 'text-start',
                        data: "kategori_tiket"
                    },
                    {
                        className: 'text-start',
                        data: "subkategori_tiket"
                    },
                    {
                        data: "item_kategori_tiket",
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return type === 'display' && data == null ? "-" : data;
                        }
                    },
                    {
                        data: "judul_tiket"
                    },
                    {
                        data: "status_tiket"
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                    <div class="dropdown">
                                        <div class="flex-shrink-0 text-center">
                                            <div class="dropdown align-self-start">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded font-size-24 text-dark"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="/ticket/detail/${row.id}">
                                                        Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                        }
                    }
                ],
                lengthChange: true,
                scrollCollapse: true,
                scrollX: true,
                // ordering: true,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table1.buttons().container().appendTo('#ticket-display_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
