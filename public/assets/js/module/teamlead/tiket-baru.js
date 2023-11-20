let daftarTechnical = null;

$(document).ready(function () {

  var table1 = $('#listTicket').DataTable({
    "ajax": {
      "url": "/api/teamlead-tiket-waiting-list/" + group_id,
      "type": "GET",
      "dataSrc": "" // This tells DataTables to use the raw array
    },
    order: [[0, 'asc']],
    columns: [{
      data: "nomor_tiket"
    },
    {
      className: 'text-center',
      data: "tipe_tiket"
    },
    {
      data: "created_by"
    },
    {
      data: null,
      render: function (data, type, row) {
        return `
                      <div class:text-center>
                          <p>--TO BE DETERMINED--</p>
                      </div>
                    `;
      }
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
      render: function (data, type, row, meta) {
        return type === 'display' && data == null ? "-" : data;
      }
    },
    {
      data: "judul_tiket"
    },
    {
      data: null,
      orderable: false,
      render: function (data, type, row) {
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
                                        <button type="button" id="assignModalBtn" class="dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#assignModal"
                                            data-id="${row.id}" data-ticket-number="${row.nomor_tiket}">
                                            Assign
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
      }
    }
    ],
    lengthChange: true,
    // ordering: true,
    buttons: ['copy', 'excel', 'pdf', 'colvis']
  });

  table1.buttons().container().appendTo('#listTicket_wrapper .col-md-6:eq(0)');


  $('#assignModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idTiket = button.data('id');
    var nomor_tiket = button.data('ticket-number');

    getTechnical(idTiket);

    console.log(nomor_tiket);

    $('#id_tiket').attr('value', idTiket);
    $('#nomor_tiket').text(nomor_tiket);

  });

  $('#assignGroupBtn').click(function () {
    $nik = nik_user;
    $id_tiket = $('#id_tiket').val();
    $id_teknisi = $('#list_teknisi').val();

    $.ajax({
      url: "/api/tiket-assign-technical",
      method: "POST",
      dataType: "json",
      data: {
        nik: $nik,
        id_tiket: $id_tiket,
        id_technical: $id_teknisi,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        $('#assignModal').modal('toggle');
        table1.ajax.reload();
      }
    })
  });

  function getTechnical(id) {
    if (daftarTechnical === null) {
      // If the list is not already fetched, make an API call
      $.ajax({
        url: "/api/technical-list/" + id,
        method: "GET",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          daftarTechnical = data;

          populateDropdowns();
        }
      })
    } else {
      // If the list is already fetched, populate the dropdowns
      populateDropdowns();
    }
  }

  function populateDropdowns() {
    const dropdowns = $('.dropdownGrup');

    dropdowns.each(function () {
      const dropdown = $(this);
      daftarTechnical.forEach(listTechnical => {
        const option = $('<option></option>').attr('value', listTechnical.nik_member).text(
          listTechnical.nama_member);
        dropdown.append(option);
      });
    });
  }

});