var urlPrefix = window.location.protocol + '//' + window.location.host;
var page = window.location.pathname.split('/')[1].split('?')[0];

var root_dir = '/';

if(page == "room-select") {
  $(document).ready(function () {
    $('form[name="room-select"] select[name="campus"]').on('change', function () {
      if (this.value == "") {
        $('form[name="room-select"] select[name="building"]').val('').attr('disabled', '');
        $('form[name="room-select"] select[name="room"]').val('').attr('disabled', '');
        $('form[name="room-select"] input[name="submit"]').attr('disabled', '');
      } else {
        $('form[name="room-select"] select[name="building"]').removeAttr('disabled');
      }
    });
    $('form[name="room-select"] select[name="building"]').on('change', function () {
      if (this.value == "") {
        $('form[name="room-select"] select[name="room"]').val('').attr('disabled', '');
      } else {
        $('form[name="room-select"] select[name="room"]').removeAttr('disabled');
      }
    });
    $('form[name="room-select"] select[name="room"]').on('change', function () {
      if (this.value == "") {
        $('form[name="room-select"] input[name="submit"]').attr('disabled', '');
      } else {
        $('form[name="room-select"] input[name="submit"]').removeAttr('disabled', '');
      }
    });
  });
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
} else if(page == "walkthrough") {

}

$(document).ready(
  function() {
    $('.remOnLoad').remove();
    $('[data-task="note-edit"]').on('click', function() { $('#note-edit').modal('show'); });
  }
);