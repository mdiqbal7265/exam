$(document).ready(function() {
  // Summmernote
  $("#summernote").summernote();
  $(".summernote").summernote();
  // ckeditor
  CKEDITOR.plugins.addExternal(
    "ckeditor_wiris",
    "https://www.wiris.net/demo/plugins/ckeditor/",
    "plugin.js"
  );

  var editor_config = {
    extraPlugins: "ckeditor_wiris",
    height: 50,
    toolbar: [
      {
        name: "basicstyles",
        items: ["Bold", "Italic", "Strike", "-", "RemoveFormat"]
      },
      {
        name: "insert",
        items: ["Image"]
      },
      {
        name: "wiris",
        items: [
          "ckeditor_wiris_formulaEditor",
          "ckeditor_wiris_CAS",
          "ckeditor_wiris_formulaEditorChemistry"
        ]
      },
      { name: "tools", items: ["Maximize"] }
    ]
  };
  // Question
  CKEDITOR.replace("question", editor_config);
  CKEDITOR.replace("option1", editor_config);
  CKEDITOR.replace("option2", editor_config);
  CKEDITOR.replace("option3", editor_config);
  CKEDITOR.replace("option4", editor_config);
  CKEDITOR.replace("hints", editor_config);
  CKEDITOR.replace("answer", editor_config);

  //
  datatable("#question_table");
  datatable("#result_table");

  // Data table
  $("#example1")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    })
    .buttons()
    .container()
    .appendTo("#example1_wrapper .col-md-6:eq(0)");
  // Toast Variable
  var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000
  });

  //   Swal Bootstrap btn
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger"
    },
    buttonsStyling: true
  });

  // Read Url Function
  function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
      var fileReader = new FileReader();
      fileReader.onload = function(event) {
        $(".preview").html(
          '<img src="' +
            event.target.result +
            '" width="100" class="img-fluid img-thumbnail" height="auto"/>'
        );
      };
      fileReader.readAsDataURL(fileInput.files[0]);
    }
  }

  // Function of Datatable
  function datatable(id) {
    $(id)
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        retrieve: true,
        paging: true,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      })
      .buttons()
      .container()
      .appendTo(id + "_wrapper .col-md-6:eq(0)");
  }

  // Delete Data Function
  function deleteData(action, id, fetchFunction) {
    swalWithBootstrapButtons
      .fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
      })
      .then(result => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "../lib/admin.php",
            data: { action: action, id: id },
            success: function(response) {
              // console.log(response);
              swalWithBootstrapButtons.fire(
                "Deleted!",
                "Your data has been deleted.",
                "success"
              );
              fetchFunction();
            }
          });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            "Cancelled",
            "Your data is safe :)",
            "error"
          );
        }
      });
  }

  /************************************************************************************************************** */

  // Admin Logout
  $("#logout").click(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "admin_logout" },
      success: function(response) {
        if (response == "logout") {
          Toast.fire({
            icon: "success",
            title: "Logout Successfully...!"
          });
          setTimeout(() => {
            window.location = "index.php";
          }, 2000);
        }
      }
    });
  });

  // Fetch Student List
  fetchStudent();
  function fetchStudent() {
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "fetchStudent" },
      success: function(response) {
        $("#student_table tbody").html(response);
        datatable("#student_table");
      }
    });
  }

  // Fetch Category List
  fetchCategory();
  function fetchCategory() {
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "fetchCategory" },
      success: function(response) {
        $("#category_table tbody").html(response);
        datatable("#category_table");
      }
    });
  }

  // Add Category
  $("#cat_photo").change(function() {
    imagePreview(this);
  });
  $("#add-category-form").submit(function(e) {
    e.preventDefault();
    $("#add-category-btn").val("Please Wait...");
    if (
      $("#cat_name").val() == "" ||
      $("#cat_status").val() == "" ||
      $("#cat_photo").val() == "" ||
      $("#exam_fees").val() == ""
    ) {
      Toast.fire({
        icon: "warning",
        title: "Every Field Must be required!"
      });
    } else {
      $.ajax({
        type: "POST",
        url: "../lib/admin.php",
        processData: false,
        contentType: false,
        cache: false,
        data: new FormData(this),
        success: function(response) {
          $("#add-category-btn").val("Insert");
          if (response == "insert") {
            $("#add-category-form")[0].reset();
            $("#add-category-modal").modal("hide");
            Toast.fire({
              icon: "success",
              title: "Category Added Successfully!"
            });
          } else if (response == "not_image") {
            Toast.fire({
              icon: "warning",
              title: "Image type must be jpg,jpeg,png!"
            });
          } else if (response == "file_size") {
            Toast.fire({
              icon: "warning",
              title: "Image Should be less tha or equal 5 mb!"
            });
          } else {
            Toast.fire({
              icon: "error",
              title: response
            });
          }
          fetchCategory();
          console.log(response);
        }
      });
    }
  });

  // Edit Category
  $("body").on("click", ".editCat", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POSt",
      url: "../lib/admin.php",
      data: { action: "editCat", id: id },
      success: function(response) {
        data = JSON.parse(response);
        $("#id").val(data.id);
        $("#edit_cat_name").val(data.cat_name);
        $("#edit_exam_fees").val(data.exam_fees);
        $('#edit_cat_status option[value="' + data.cat_status + '"]').prop(
          "selected",
          true
        );
        $("#old_image").val(data.photo);
        $(".preview").html(
          '<img src="../assets/img/' +
            data.photo +
            '" width="100" height="auto"/>'
        );
        console.log(data);
      }
    });
  });

  // Update Category
  $("#edit_cat_photo").change(function() {
    imagePreview(this);
  });
  $("#edit-category-form").submit(function(e) {
    e.preventDefault();
    $("#edit-category-btn").val("Please Wait...");
    if (
      $("#edit_cat_name").val() == "" ||
      $("#edit_cat_status").val() == "" ||
      $("#edit_exam_fees").val() == ""
    ) {
      Toast.fire({
        icon: "warning",
        title: "Every Field Must be required!"
      });
    } else {
      $.ajax({
        type: "POST",
        url: "../lib/admin.php",
        processData: false,
        contentType: false,
        cache: false,
        data: new FormData(this),
        success: function(response) {
          $("#edit-category-btn").val("Update");
          if (response == "updated") {
            $("#edit-category-form")[0].reset();
            $("#edit-category-modal").modal("hide");
            Toast.fire({
              icon: "success",
              title: "Category Updated Successfully!"
            });
          } else if (response == "not_image") {
            Toast.fire({
              icon: "warning",
              title: "Image type must be jpg,jpeg,png!"
            });
          } else if (response == "file_size") {
            Toast.fire({
              icon: "warning",
              title: "Image Should be less tha or equal 5 mb!"
            });
          } else {
            Toast.fire({
              icon: "error",
              title: response
            });
          }
          fetchCategory();
          console.log(response);
        }
      });
    }
  });

  // Delete Category
  $("body").on("click", ".dltCat", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    deleteData("dltCat", id, fetchCategory);
  });

  // Add Description
  $("body").on("click", ".addDetail", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "fetch_detail", id: id },
      success: function(response) {
        data = JSON.parse(response);
        $("#details_id").val(data.id);
        $("#summernote").summernote("editor.pasteHTML", data.description);
        console.log(data);
      }
    });
  });

  $("#add-description-btn").click(function(e) {
    e.preventDefault();
    $("#add-description-btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: $("#add-description-form").serialize() + "&action=add_detail",
      success: function(response) {
        $("#add-description-btn").val("Add");
        $("#add-description-form")[0].reset();
        $("#add-description-modal").modal("hide");
        if (response == "added") {
          Toast.fire({
            icon: "success",
            title: "Details Added Or Updated Successfully!"
          });
        } else {
          Toast.fire({
            icon: "error",
            title: response
          });
        }
      }
    });
  });

  // Add Syllabus
  $("body").on("click", ".uploadSyllabus", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $("#syllabus_id").val(id);
  });

  $("#add-syllabus-form").submit(function(e) {
    e.preventDefault();
    $("#add-syllabus-btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function(response) {
        $("#add-syllabus-btn").val("Add");
        if (response == "insert") {
          $("#add-syllabus-form")[0].reset();
          $("#add-syllabus-modal").modal("hide");
          Toast.fire({
            icon: "success",
            title: "syllabus Added Successfully!"
          });
        } else if (response == "not_file") {
          Toast.fire({
            icon: "warning",
            title: "File Type Must be pdf!"
          });
        } else if (response == "file_size") {
          Toast.fire({
            icon: "warning",
            title: "Image Should be less tha or equal 5 mb!"
          });
        } else {
          Toast.fire({
            icon: "error",
            title: response
          });
        }
        fetchCategory();
      }
    });
  });

  // Fetch Enroll Student List
  fetchEnrollStudent();
  function fetchEnrollStudent() {
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "fetchEnrollStudent" },
      success: function(response) {
        $("#enroll_student_table tbody").html(response);
        datatable("#enroll_student_table");
      }
    });
  }

  // Accept Enroll
  $("body").on("click", ".acceptBtn", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "acceptEnroll", id: id },
      success: function(response) {
        Toast.fire({
          icon: "success",
          title: "Payment Accepted Successfully!"
        });
        fetchEnrollStudent();
      }
    });
  });

  // Decline Enroll
  $("body").on("click", ".declineBtn", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "declineEnroll", id: id },
      success: function(response) {
        Toast.fire({
          icon: "success",
          title: "Payment Declined Successfully!"
        });
        fetchEnrollStudent();
      }
    });
  });

  // Fetch Exam
  fetchExam();
  function fetchExam() {
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "fetchExam" },
      success: function(response) {
        $("#exam_table tbody").html(response);
        datatable("#exam_table");
      }
    });
  }

  // Add Exam
  $("#add-exam-btn").click(function(e) {
    e.preventDefault();
    $("#add-exam-btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: $("#add-exam-form").serialize() + "&action=add_exam",
      success: function(response) {
        $("#add-exam-btn").val("Add");
        $("#add-exam-form")[0].reset();
        $("#add-exam-modal").modal("hide");
        if (response == "added") {
          Toast.fire({
            icon: "success",
            title: "Exam Added Successfully!"
          });
        } else {
          Toast.fire({
            icon: "error",
            title: response
          });
        }
        fetchExam();
      }
    });
  });

  // Edit Exam
  $("body").on("click", ".editExam", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $.ajax({
      type: "POSt",
      url: "../lib/admin.php",
      data: { action: "editExam", id: id },
      success: function(response) {
        data = JSON.parse(response);
        $("#id").val(data.id);
        $("#edit_title").val(data.title);
        $("#edit_exam_duration").val(data.duration);
        $('#edit_exam_cat option[value="' + data.cat_id + '"]').prop(
          "selected",
          true
        );
        $('#edit_exam_status option[value="' + data.status + '"]').prop(
          "selected",
          true
        );
        $('#edit_exam_type option[value="' + data.type + '"]').prop(
          "selected",
          true
        );
        $("#edit_total_marks").val(data.total_marks);
        $("#edit_total_question").val(data.total_question);
        $("#edit_negative_marks").val(data.negetive_marks);
        $("#edit_pass_marks").val(data.pass_parcentage);
        $("#edit_exam_started").val(data.exam_started);
        $("#edit_exam_end").val(data.exam_end);
        $("#edit_description").summernote("editor.pasteHTML", data.description);
      }
    });
  });

  // Update Exam
  $("#edit-exam-btn").click(function(e) {
    e.preventDefault();
    $("#edit-exam-btn").val("Please Wait...");
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: $("#edit-exam-form").serialize() + "&action=edit_exam",
      success: function(response) {
        $("#edit-exam-btn").val("Update");
        $("#edit-exam-form")[0].reset();
        $("#edit-exam-modal").modal("hide");
        if (response == "update") {
          Toast.fire({
            icon: "success",
            title: "Exam Updated Successfully!"
          });
        } else {
          Toast.fire({
            icon: "error",
            title: response
          });
        }
        fetchExam();
        console.log(response);
      }
    });
  });

  // Delete Exam
  $("body").on("click", ".dltExam", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    deleteData("dltExam", id, fetchExam);
  });

  // Add Question Id Set
  $("body").on("click", ".addQuestion", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    $("#exam_id").val(id);
  });

  // Add Question
  $("#add-question-btn").click(function(e) {
    e.preventDefault();
    $("#add-question-btn").val("Please Wait...");
    var question = CKEDITOR.instances["question"].getData();
    var option1 = CKEDITOR.instances["option1"].getData();
    var option2 = CKEDITOR.instances["option2"].getData();
    var option3 = CKEDITOR.instances["option3"].getData();
    var option4 = CKEDITOR.instances["option4"].getData();
    var hints = CKEDITOR.instances["hints"].getData();
    var answer = CKEDITOR.instances["answer"].getData();
    var correct_option = $("#correct_option").val();
    var id = $("#exam_id").val();
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: {
        question: question,
        option1: option1,
        option2: option2,
        option3: option3,
        option4: option4,
        hints: hints,
        answer: answer,
        correct_option: correct_option,
        id: id,
        action: "add_question"
      },
      success: function(response) {
        $("#add-question-btn").val("Add");
        $("#add-question-form")[0].reset();
        $("#add-question-modal").modal("hide");
        if (response == "added") {
          Toast.fire({
            icon: "success",
            title: "Question Added Successfully!"
          });
        } else if (response == "most_question") {
          Toast.fire({
            icon: "error",
            title: "You cannot add More question that total question"
          });
        } else {
          Toast.fire({
            icon: "error",
            title: response
          });
        }
        fetchExam();
        // console.log(response);
      }
    });
  });

  // Delete Question
  $("body").on("click", ".dltQuestion", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    deleteData("dltQuestion", id, fetchExam);
    setTimeout(() => {
      location.reload(true);
    }, 2000);
  });

  // Fetch Free Exam Student List
  fetchFreeExamStudent();
  function fetchFreeExamStudent() {
    $.ajax({
      type: "POST",
      url: "../lib/admin.php",
      data: { action: "fetchFreeExamStudent" },
      success: function(response) {
        $("#free_exam_student_table tbody").html(response);
        datatable("#free_exam_student_table");
      }
    });
  }

  // Delete Free Exam Student
  $("body").on("click", ".dltFreeRegisterStudent", function(e) {
    e.preventDefault();
    id = $(this).attr("id");
    deleteData("dltFreeRegisterStudent", id, fetchFreeExamStudent);
  });

  /**************** End ***************/
});
