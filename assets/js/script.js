document.addEventListener("DOMContentLoaded", function () {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
        }
      });
    },
    {
      threshold: 0.2,
    }
  );

  const section = document.querySelector(".scroll-fade");
  if (section) {
    observer.observe(section);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
        }
      });
    },
    {
      threshold: 0.2,
    }
  );

  // Target all elements with scroll-slide-right class
  const slideRightElements = document.querySelectorAll(".scroll-slide-right");
  slideRightElements.forEach((el) => observer.observe(el));
});

document.querySelectorAll(".account-dropdown").forEach((dropdown) => {
  dropdown.addEventListener("mouseenter", () => {
    dropdown.querySelector(".dropdown-menu").classList.add("show");
  });
  dropdown.addEventListener("mouseleave", () => {
    dropdown.querySelector(".dropdown-menu").classList.remove("show");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const registerModal = document.getElementById("registerModal");
  const modalContent = document.getElementById("registerModalContent");

  registerModal.addEventListener("show.bs.modal", function () {
    // Load signup.php content via AJAX
    fetch("signup.php")
      .then((response) => response.text())
      .then((data) => {
        modalContent.innerHTML = data;
      });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const passwordField = document.getElementById("passwordField");
  const togglePassword = document.getElementById("togglePassword");

  togglePassword.addEventListener("click", function () {
    const icon = this.querySelector("i");
    if (passwordField.type === "password") {
      passwordField.type = "text";
      icon.classList.remove("bi-eye-fill");
      icon.classList.add("bi-eye-slash");
    } else {
      passwordField.type = "password";
      icon.classList.remove("bi-eye-slash");
      icon.classList.add("bi-eye-fill");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const registerModal = document.getElementById("registerModal");

  if (registerModal) {
    registerModal.addEventListener("hidden.bs.modal", function () {
      const form = registerModal.querySelector("form");
      if (form) form.reset(); // Reset all input fields
    });
  }
  const passwordField = document.getElementById("passwordField");
  const togglePasswordIcon = document.querySelector("#togglePassword i");

  registerModal.addEventListener("hidden.bs.modal", function () {
    if (passwordField) passwordField.type = "password";
    if (togglePasswordIcon) {
      togglePasswordIcon.classList.remove("bi-eye-slash");
      togglePasswordIcon.classList.add("bi-eye-fill");
    }
  });
});

function toggleLoginPassword() {
  const passField = document.getElementById("loginPassword");
  if (passField.type === "password") {
    passField.type = "text";
  } else {
    passField.type = "password";
  }
}

document.querySelectorAll(".product-card").forEach((card) => {
  const ratingBox = card.querySelector(".rating-box");

  card.addEventListener("mouseenter", () => {
    ratingBox.style.display = "flex";
  });

  card.addEventListener("mouseleave", () => {
    ratingBox.style.display = "none";
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form"); // Your form element
  const emailInput = document.getElementById("email");
  const emailError = document.getElementById("emailError");

  form.addEventListener("submit", function (e) {
    const emailValue = emailInput.value.trim();
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

    if (!emailPattern.test(emailValue)) {
      e.preventDefault(); // stop form submission
      emailError.style.display = "block";
    } else {
      emailError.style.display = "none";
    }
  });
});

function toggleMenu(id) {
  const menu = document.getElementById(id);
  menu.style.display = menu.style.display === "block" ? "none" : "block";
}
window.toggleMenu = toggleMenu; // allows onclick="toggleMenu('watchMenu')" to work

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registerForm");
  const passwordField = document.getElementById("passwordField");
  const confirmField = document.getElementById("confirm_pass");
  const warning = document.getElementById("passwordWarning");

  if (form) {
    form.addEventListener("submit", function (e) {
      if (passwordField.value !== confirmField.value) {
        e.preventDefault();
        warning.style.display = "block";
      } else {
        warning.style.display = "none";
      }
    });
  }
});

function togglePassword(id) {
  const field = document.getElementById(id);
  field.type = field.type === "password" ? "text" : "password";
}

document.addEventListener("DOMContentLoaded", function () {
  const userTab = document.getElementById("user-tab");
  const adminTab = document.getElementById("admin-tab");

  userTab.addEventListener("click", function () {
    // Clear Admin form fields
    document.querySelector("#adminLogin form").reset();
  });

  adminTab.addEventListener("click", function () {
    // Clear User form fields
    document.querySelector("#userLogin form").reset();
  });
});

function togglePassword(inputId, iconSpan) {
  let input = document.getElementById(inputId);
  let icon = iconSpan.querySelector("i");

  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("bi-eye-fill");
    icon.classList.add("bi-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye-fill");
  }
}

function showInsertForm() {
  document.getElementById("insertFormContainer").style.display = "block";
  document.getElementById("dashboardSection").style.display = "none";
  document.getElementById("dashboardFooter").style.display = "none";
  document.getElementById("watchTableContainer").style.display = "none";
}

function editWatch(id) {
  $.ajax({
    url: "get_watch.php", // PHP file to fetch watch data
    type: "GET",
    data: { id: id },
    dataType: "json",
    success: function (data) {
      $("#watch_id").val(data.id);
      $("#watch_title").val(data.title);
      $("#watch_description").val(data.description);
      $("#watch_price").val(data.price);
      $("#current_image").attr("src", "../uploads/" + data.image);

      // Show modal
      var myModal = new bootstrap.Modal(
        document.getElementById("editWatchModal")
      );
      myModal.show();
    },
  });
}

$("#editWatchForm").on("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);

  $.ajax({
    url: "update_watch.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      if (response.status == "201") {
        // Update row in table dynamically
        let id = response.data.id;

        // Find the row with this ID
        let row = $("tr").filter(function () {
          return $(this).find("td:first").text() == id;
        });

        if (row.length) {
          let newImageUrl =
            "../uploads/" + response.data.image + "?t=" + new Date().getTime();
          row.find(".watch-image").attr("src", newImageUrl);
          // row.find("td:eq(1) img").attr("src", "../uploads/" + response.data.image); // update image
          row.find("td:eq(2)").text(response.data.title); // update title
          row.find("td:eq(3)").text(response.data.description); // update description
          row.find("td:eq(4) span").text("$" + response.data.price); // update price
        }

        // Close modal
        $("#editWatchModal").modal("hide");

        Swal.fire({
          title: "Success!",
          text: "Watch Updated Successfully.",
          icon: "success",
          confirmButtonText: "OK",
        });
      } else {
        Swal.fire({
          title: "Error!",
          text: response.message || "Something went wrong.",
          icon: "error",
        });
      }
    },
  });
});
$(document).ready(function () {
  let deleteId = null;

  // Open modal and store ID
  $(document).on("click", ".delete-btn", function () {
    deleteId = $(this).data("id");
    $("#deleteModal").modal("show");
  });

  // Confirm delete
  $("#confirmDelete").click(function () {
    if (deleteId) {
      $.ajax({
        url: "delete_watch.php",
        type: "POST",
        data: { id: deleteId },
        success: function (response) {
          $("#deleteModal").modal("hide");
          if (response.trim() === "success") {
            // Remove row smoothly without reload
            $("#row-" + deleteId).fadeOut(500, function () {
              $(this).remove();
            });

            Swal.fire({
              icon: "success",
              title: "Deleted!",
              text: "Watch deleted successfully.",
              confirmButtonText: "OK",
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Failed to delete watch.",
            });
          }
        },
      });
    }
  });
});

$(document).ready(function () {
  $("#insertWatchForm").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
      url: "insert_watch.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response); // debug
        let res = JSON.parse(response);

        if (res.status === "success") {
          Swal.fire({
            title: "Success!",
            text: "Watch Added Successfully.",
            icon: "success",
            confirmButtonText: "OK"
          }).then(() => {
            $("#insertWatchForm")[0].reset();
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: res.message,
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", error);
      }
    });
  });
});
