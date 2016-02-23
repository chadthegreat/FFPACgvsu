var urlPrefix = window.location.protocol + '//' + window.location.host;
var page = window.location.pathname.split('/')[1].split('?')[0];

var root_dir = '/';

var validateselection = function (form) {
  if (form.campus.value == "") {
    alert("Please select a campus");
    return false;
  }
  if (form.building.value == "") {
    alert("Please select a building");
    return false;
  }
  if (form.room.value == "") {
    alert("Please select a room");
    return false;
  }
  return true;
};

var populate_dropdown = function(selector, data) {
  $(selector).find("option:gt(0)").remove();
  $.each(data, function() {
    $(selector).append($('<option />').attr('value', this.value).text(this.label));
  });
};

var loadcampus = function () {
  var url = urlPrefix + root_dir + 'Application/ajax/get.php';
  var data = { func: 'getCampuss'};
  jQuery.ajax({
    url: url, data: data, type: "GET", dataType: "json",
    success: function(data) {
      populate_dropdown('select[name="campus"]', data);
    },
    error: function( xhr, status, errorThrown ) {
      Error_Output(xhr, status, errorThrown);
    }
  });
};

var loadbuilding = function (campus) {
  var url = urlPrefix + root_dir + 'Application/ajax/get.php';
  var data = { func: 'getBuildings', parm: campus };
  jQuery.ajax({
    url: url, data: data, type: "GET", dataType: "json",
    success: function(data) {
      populate_dropdown('select[name="building"]', data);
    },
    error: function( xhr, status, errorThrown ) {
      Error_Output(xhr, status, errorThrown);
    }
  });
};

var loadroom = function (building) {
  var url = urlPrefix + root_dir + 'Application/ajax/get.php';
  var data = { func: 'getRooms', parm: building };
  jQuery.ajax({
    url: url, data: data, type: "GET", dataType: "json",
    success: function(data) {
      populate_dropdown('select[name="room"]', data);
    },
    error: function( xhr, status, errorThrown ) {
      Error_Output(xhr, status, errorThrown);
    }
  });
};

var loadcomplaint = function (room) {
  var url = urlPrefix + root_dir + 'Application/ajax/get.php';
  var data = { func: 'getComplaints', parm: room };
  jQuery.ajax({
    url: url, data: data, type: "GET", dataType: "html",
    success: function(data) {
      $('#complaints').html(data);
    },
    error: function( xhr, status, errorThrown ) {
      Error_Output(xhr, status, errorThrown);
    }
  });
};

var postcomplaint = function (room, complaint) {
  var url = urlPrefix + root_dir + 'Application/ajax/post.php';
  var data = { func: 'insertComplaint', parm: { room: room, complaint: complaint } };
  jQuery.ajax({
    url: url, data: data, type: "POST", dataType: "html",
    success: function(data) {
      loadcomplaint(room);
    },
    error: function( xhr, status, errorThrown ) {
      Error_Output(xhr, status, errorThrown);
    }
  });
};

$(document).ready(
  function() {
    $('form[name="room-select"] select[name="campus"]').on('change', function () {
      if (this.value == "") {
        $('form[name="room-select"] select[name="building"]').val('').attr('disabled', '');
      } else {
        loadbuilding(this.value);
        $('form[name="room-select"] select[name="building"]').removeAttr('disabled');
      }
      $('form[name="room-select"] select[name="room"]').val('').attr('disabled', '');
      $('form[name="room-select"] input[name="submit"]').attr('disabled', '');
    });
    $('form[name="room-select"] select[name="building"]').on('change', function () {
      if (this.value == "") {
        $('form[name="room-select"] select[name="room"]').val('').attr('disabled', '');
      } else {
        loadroom(this.value);
        $('form[name="room-select"] select[name="room"]').removeAttr('disabled');
      }
    });
    $('form[name="room-select"] select[name="room"]').on('change', function () {
      $('#complaints').html('');
      if (this.value == "") {
        $('form[name="room-select"] input[name="submit"]').attr('disabled', '');
      } else {
        $('form[name="room-select"] input[name="submit"]').removeAttr('disabled', '');
        if($('#complaints').length > 0) {
          loadcomplaint(this.value);
        }
      }
    });
    $('#NewComplaint').on('click', function(event) {
      var room = $('select[name="room"]').val();
      var complaint = $('#newcomplainttext').val();
      postcomplaint(room, complaint);
      $('#newcomplainttext').val('');
    });
    $('.remOnLoad').remove();
  }
);