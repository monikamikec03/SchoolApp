$("select[name='grupa_podataka'], select[name='sortiranje']").on(
  "change",
  function () {
    let grupa_podataka = $("select[name='grupa_podataka']").val();
    let sortiranje = $("select[name='sortiranje']").val();
    if (grupa_podataka.length == 0 || sortiranje.length == 0) {
        return;
    }
    else {
        $.ajax({
        url: "ajax.php",
        type: "post",
        data: {
            grupa_podataka: grupa_podataka,
            sortiranje: sortiranje,
        },

        success: function (response) {
            $("tbody").html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        },
        });
        
    }
  }
);
