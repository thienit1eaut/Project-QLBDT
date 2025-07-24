var SOTHER = (function () {
  const initToastrConfig = () => {
    if ($.isEmptyObject(toastr.options)) {
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: true,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
    }

    // Chỉ hiển thị nếu tồn tại biến toàn cục
    if (typeof typeNotify !== 'undefined' && typeNotify && typeof messageNotify !== 'undefined' && messageNotify) {
      toastr[typeNotify](messageNotify);
    }
  };

  return {
    _: () => {
      initToastrConfig();
    }
  };
})();

const ALERT_TOASTR = (() => {
  const handleResponse = (json, options = {}) => {
    toastr.clear();

    const isSuccess = json.code === 200;
    const message = json.message || 'Có lỗi xảy ra.';
    const messageType = isSuccess ? "success" : "error";

    toastr[messageType](message);

    if (isSuccess) {
      if (options.reload) {
        setTimeout(() => window.location.reload(), options.delay || 2000);
      }

      if (options.redirectUrl) {
        setTimeout(() => {
          window.location.href = options.redirectUrl;
        }, options.delay || 2000);
      }
    }
  };

  return {
    handleResponse
  };
})();

window.addEventListener("DOMContentLoaded", () => {
  SOTHER._();

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  $('#form-submit-1').on('submit', function (e) {
    e.preventDefault();

    const $form = $(this);
    const formData = new FormData(this);

    $.ajax({
      url: $form.attr('action'),
      type: $form.attr('method'),
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.url && response.url !== '') {
          ALERT_TOASTR.handleResponse(response, { redirectUrl: response.url });
        } else {
          ALERT_TOASTR.handleResponse(response, { reload: true });
        }
      },
      error: function (xhr) {
        const jsonError = xhr.responseJSON || { message: 'Lỗi không xác định.' };
        toastr.error(jsonError.message);
      }
    });
  });
});
