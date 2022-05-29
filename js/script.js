$(document).ready(function () {
  // menghilangkan tombol cari
  $("#tombol-cari").hide();

  //   live search

  $("#kataKunci").on("keyup", function () {
    // $("#container").load("ajax/sepatu.php?kataKunci=" + $("#kataKunci").val());
    $(".img").show();
    $.get("ajax/sepatu.php?kataKunci=" + $("#kataKunci").val(), function (data) {
      $("#container").html(data);
      $(".img").hide();
    });
  });
});

// contoh live search manual

// var kataKunci = document.getElementById("kataKunci");
// var tombolCari = document.getElementById("tombol-cari");
// var container = document.getElementById("container");

// kataKunci.addEventListener("keyup", function () {
//   var xhr = new XMLHttpRequest();

//   // mengecek kesiapan ajak
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       container.innerHTML = xhr.responseText;
//       console.log(kataKunci.value);
//     }
//   };

//   xhr.open("GET", "ajax/sepatu.php?kataKunci=" + kataKunci.value, true);
//   xhr.send();
// });
