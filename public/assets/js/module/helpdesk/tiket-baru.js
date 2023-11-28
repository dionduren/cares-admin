let daftarGrup = null;
// let detailTiket = null;

$(document).ready(function () {

  $('.table-responsive').responsiveTable({});

  getGrup();

  var table1 = $('#listTicket').DataTable({
    "ajax": {
      "url": "/api/helpdesk-tiket-submitted",
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
    // scrollCollapse: true,
    // scrollX: true,
    // ordering: true,
    buttons: ['copy', 'excel', 'pdf', 'colvis']
  });

  table1.buttons().container().appendTo('#listTicket_wrapper .col-md-6:eq(0)');


  $('#assignModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var idTiket = button.data('id');
    var nomor_tiket = button.data('ticket-number');

    console.log(nomor_tiket);

    $('#id_tiket').attr('value', idTiket);
    $('#nomor_tiket').text(nomor_tiket);

    getTicketInfo(idTiket);
  });

  $('#tingkat_urgensi, #tingkat_dampak').change(calculatePriority);
  $('#tingkat_urgensi, #tingkat_dampak, #jenis_tiket').change(getSLAtype);

  // $('#grup_teknisi').change(function() {
  //     // $leader = $this.data('data-leader');
  //     $leader = $(this).find(':selected').data('leader')
  //     if ($leader == null) {
  //         $('#leader_teknisi').val("Belum ada Leader");
  //     } else {
  //         $('#leader_teknisi').val($leader);
  //     }
  // });

  $('#assignGroupBtn').click(function () {
    $nik = nik_user;
    $id_tiket = $('#id_tiket').val();
    $tipe_tiket = $('#jenis_tiket').val();
    $tingkat_urgensi = $('#tingkat_urgensi').val();
    $tingkat_dampak = $('#tingkat_dampak').val();
    $tingkat_prioritas = $('#tingkat_prioritas').val();
    $tipe_sla = $('#tipe_sla').val();
    $id_group = $('#grup_teknisi').find(':selected').val();
    $assigned_group = $('#grup_teknisi').find(':selected').text();

    $.ajax({
      url: "/api/tiket-assign-group",
      method: "POST",
      dataType: "json",
      data: {
        nik: $nik,
        id_tiket: $id_tiket,
        tipe_tiket: $tipe_tiket,
        tingkat_urgensi: $tingkat_urgensi,
        tingkat_dampak: $tingkat_dampak,
        tingkat_prioritas: $tingkat_prioritas,
        tipe_sla: $tipe_sla,
        id_group: $id_group,
        assigned_group: $assigned_group,
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

  function getGrup() {
    if (daftarGrup === null) {
      // If the list is not already fetched, make an API call
      $.ajax({
        url: "/api/technical-group-list",
        method: "GET",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          daftarGrup = data;

          populateDropdowns();
        }
      })
    } else {
      // If the list is already fetched, populate the dropdowns
      populateDropdowns();
    }
  }

  function getTicketInfo(id_tiket) {
    $.ajax({
      url: "/api/tiket-detail/" + id_tiket,
      method: "GET",
      dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        $('#jenis_tiket').val(data.tipe_tiket);
        $('#tingkat_urgensi').val(data.level_urgensi);
        $('#tingkat_dampak').val(data.level_dampak);

        calculatePriority();
        getSLAtype();
        // detailTiket = data;
        // console.log('daftar data tiket = ');
        // console.log(data);
        // console.log(detailTiket);
      }
    })
  }

  function populateDropdowns() {
    const dropdowns = $('.dropdownGrup');

    dropdowns.each(function () {
      const dropdown = $(this);
      daftarGrup.forEach(grupTeknis => {
        const option = $('<option></option>').attr('value', grupTeknis.id).text(
          grupTeknis.nama_group);
        // const option = $('<option></option>').attr('value', grupTeknis.id).text(
        //     grupTeknis.nama_group).attr('data-leader', grupTeknis
        //     .nama_team_lead);
        dropdown.append(option);
      });
    });
  }

  function calculatePriority() {
    var urgency = $('#tingkat_urgensi option:selected').text();
    var impact = $('#tingkat_dampak option:selected').text();

    var priorityMatrix = {
      'HIGH': {
        'HIGH': 'Critical',
        'MEDIUM': 'High',
        'LOW': 'Medium'
      },
      'MEDIUM': {
        'HIGH': 'High',
        'MEDIUM': 'Medium',
        'LOW': 'Low'
      },
      'LOW': {
        'HIGH': 'Medium',
        'MEDIUM': 'Low',
        'LOW': 'Low'
      }
    };

    // Determine the priority text based on the matrix
    var priorityText = priorityMatrix[urgency][impact];

    // Set the value in the readonly input field
    $('#tingkat_prioritas').val(priorityText);
  }

  function getSLAtype() {
    var tipe_tiket = $('#jenis_tiket').val();
    var tipe_sla = $('#tingkat_prioritas').val();

    $.ajax({
      url: "/api/helpdesk-get-sla",
      method: "GET",
      dataType: "json",
      data: {
        tipe_tiket: tipe_tiket,
        tipe_sla: tipe_sla,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (data) {
        $('#tipe_sla').val(data.nama_sla);
      }
    })
  }
});